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
 * Provides the steps to backup a codescore activity
 *
 * @package     mod_codescore
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_codescore_activity_structure_step extends backup_activity_structure_step {

    /**
     * Define the structure of the codescore activity.
     *
     * @return backup_structure_element
     */
    protected function define_structure() {
        $userinfo = $this->get_setting_value('userinfo');

        $codescore = new backup_nested_element('codescore', [
            'id',
        ], [
            'course', 'name', 'intro', 'task', 'introformat',
            'programminglang', 'gradingspec', 'rubricsobject', 'autograde',
            'showfeedback', 'feedbacklang', 'multiattempts', 'duedate', 'timecreated', 'timemodified',
            'timeopened', 'timeclosed',
        ]);
        $attempts = new backup_nested_element('attempts');

        $attempt = new backup_nested_element('attempt', [
            'id',
        ], [
            'codescore', 'userid', 'attempt',
            'state', 'timestart', 'timefinish', 'rubricsobject', 'timemodified',
            'timemodifiedoffline', 'timecheckstate', 'timegraded', 'code', 'studentnotes',
            'grade', 'aigrade', 'syntaxgrading', 'outputgrading',
            'problemsolutiongrading', 'allcasesgrading', 'correctedcode', 'feedback', 'output',
            'gradednotificationsenttime',
        ]);

        $codescore->add_child($attempts);
        $attempts->add_child($attempt);

        $codescore->set_source_table('codescore', ['id' => backup::VAR_ACTIVITYID]);
        $attempt->set_source_sql('
            SELECT *
              FROM {codescore_attempts}
             WHERE codescore = ?',
            [backup::VAR_PARENTID]);

        // All the rest of elements only happen if we are including user info.
        if ($userinfo) {
            $attempt->set_source_table('codescore_attempts', ['id' => '../../id']);
        }

        return $this->prepare_activity_structure($codescore);
    }
}
