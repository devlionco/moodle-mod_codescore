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

namespace mod_codescore\external;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');
require_once("$CFG->dirroot/mod/codescore/locallib.php");

use external_api;
use external_description;
use external_function_parameters;
use external_single_structure;
use external_value;

/**
 * Ajax service to get the reports.
 *
 * @package   mod_codescore
 * @category  external
 * @copyright 2024 Devlion <info@devlion.co>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class get_reports extends external_api {
    /**
     * Parameters of execute function.
     *
     * @param int $cmid Slot id to display
     * @return array
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters(
            [
                'cmid' => new external_value(PARAM_INT, '', VALUE_DEFAULT),
            ]
        );
    }

    /**
     * Get the reports.
     *
     * @param int $cmid Slot id to display.
     * @return array
     */
    public static function execute($cmid) {
        global $DB, $CFG, $COURSE;
        require_once($CFG->dirroot . '/mod/codescore/locallib.php');

        self::validate_parameters(self::execute_parameters(), [
            'cmid' => $cmid,
        ]);

        $context = \context_course::instance($COURSE->id);
        self::validate_context($context);


        $attempts = codescore_get_attempts($cmid);
        $data = new \stdClass();
        $data->attempts = array_values($attempts);

        foreach ($data->attempts as &$value) {
            $userid = $value->userid;
            $user = $DB->get_record('user', ['id' => $userid]);
            $name = fullname($user);
            $value->username = $name;
        }
        $data->title = get_string('studentsreports', 'mod_codescore');
        $data->candelete = has_capability('mod/codescore:addinstance', \context_system::instance());
        $data->hasattempts = $attempts ? true : false;

        return ['result' => 'event dispatched', 'data' => json_encode($data)];
    }

    /**
     * Define the webservice response.
     *
     * @return external_description
     */
    public static function execute_returns() {
        return new external_single_structure(
            [
                'result' => new external_value(PARAM_RAW, ''),
                'data' => new external_value(PARAM_RAW, ''),
            ]
        );
    }
}

