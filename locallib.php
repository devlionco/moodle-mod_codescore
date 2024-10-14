<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package     mod_codescore
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once("$CFG->libdir/filelib.php");
require_once("$CFG->libdir/resourcelib.php");
require_once("$CFG->dirroot/mod/page/lib.php");

/**
 * Save a new attempt, or update an existing one for a user.
 *
 * @param stdClass $data
 * @return int The ID of the new or updated attempt.
 */
function codescore_save_attempt($data) {
    global $DB, $USER;

    $attempts = $DB->get_records_sql(
        "SELECT *
           FROM {codescore_attempts}
       ORDER BY attempt desc",
        [
            'userid' => $USER->id,
            'codescore' => $data->cmid,
        ]
    );

    $lastattempt = 0;
    if ($attempts) {
        foreach ($attempts as $attempt) {
            $attemptnum = intval($attempt->attempt);
            if ($attemptnum > $lastattempt) {
                $lastattempt = $attemptnum;
            }
        }
    }

    $data->codescore = $data->cmid;
    $data->userid = $USER->id;
    $data->studentnotes = $data->notes;
    $data->attempt = $lastattempt + 1;
    $data->state = 'inprogress';
    $data->timefinish = time();
    $data->grade = 0;
    $data->correctedcode = '';
    $data->output = '';
    $data->gradednotificationsenttime = 0;

    $result = $DB->insert_record('codescore_attempts', $data, true);
    $params = [
        'relateduserid' => $USER->id,
        'context' => context_module::instance($data->cmid),
        'objectid' => context_module::instance($data->cmid)->id,
    ];

    $event = \mod_codescore\event\attempt_submit::create($params);
    $event->trigger();

    return $result;
}

/**
 * Save a grade for an attempt.
 *
 * @param stdClass $data The data that has been submitted, including the id of the attempt and the grade.
 * @return bool True if the grade has been successfully saved.
 */
function codescore_set_grade_attempt(stdClass $data) {
    global $DB;

    $attempts = $DB->update_record('codescore_attempts', [
        'id' => $data->id,
        'timegraded' => time(),
        'grade' => $data->grade,
    ]);
    return $attempts;
}

/**
 * Queue up an adhoc task to check an attempt.
 *
 * @param int $id The id of the attempt.
 * @return void
 */
function codescore_exec_adhoc($id) {
    global $DB;

    $attempt = $DB->get_record('codescore_attempts', ['id' => $id]);

    $task = new \mod_codescore\task\check_attempt;
    $task->set_custom_data($attempt);
    \core\task\manager::queue_adhoc_task($task, true);
    $task = new \tool_monitor\task\check_subscriptions();
    $task->execute();
}

/**
 * Get the attempts for a user.
 *
 * @param int $codescore The id of the codescore.
 * @param int|null $userid The id of the user to get attempts for. Defaults to the current user.
 * @return stdClass[] The attempts.
 */
function codescore_get_user_attempts($codescore, $userid = null) {
    global $DB, $USER;

    $userid = $userid ?? $USER->id;

    $attempts = $DB->get_records('codescore_attempts',
        ['userid' => $userid, 'codescore' => $codescore]
    );

    return $attempts;
}

/**
 * Get the attempts for a codescore.
 *
 * @param int $codescore The id of the codescore.
 * @return stdClass[] The attempts. If the user is not a teacher, an empty array will be returned.
 */
function codescore_get_attempts($codescore) {
    global $DB;

    $context = context_module::instance($codescore);
    $isteacher = has_capability('mod/quiz:addinstance', $context);
    if ($isteacher) {
        $attempts = $DB->get_records('codescore_attempts',
            ['codescore' => $codescore]
        );
        return $attempts;
    }
    return [];
}
