<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace mod_codescore\privacy;


// Privacy API implementation for the Code Score plugin.

// @package     mod_codescore
// @category    privacy
// @copyright   2024 Devlion <info@devlion.co>
// @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


use core_privacy\local\metadata\collection;

class provider implements \core_privacy\local\metadata\provider {
    public static function get_metadata(collection $collection): collection {

        // Here you will add more items into the collection.
        $collection->add_database_table('codescore_attempts', [
            'userid' => 'privacy:metadata:codescore_attempts:userid',
            'attempt' => 'privacy:metadata:codescore_attempts:attempt',
            'timestart' => 'privacy:metadata:codescore_attempts:timestart',
            'timefinish' => 'privacy:metadata:codescore_attempts:timefinish',
            'timemodified' => 'privacy:metadata:codescore_attempts:timemodified',
            'timemodifiedoffline' => 'privacy:metadata:codescore_attempts:timemodifiedoffline',
            'timegraded' => 'privacy:metadata:codescore_attempts:code',
            'studentnotes' => 'privacy:metadata:codescore_attempts:studentnotes',
            'grade' => 'privacy:metadata:codescore_attempts:grade',
        ], 'privacy:metadata:codescore_attempts');

        $collection->add_external_location_link('codescore', [
            'task' => 'privacy:metadata:codescore:task',
            'programminglang' => 'privacy:metadata:codescore:programminglang',
            'syntaxgrading' => 'privacy:metadata:codescore:syntaxgrading',
            'outputgrading' => 'privacy:metadata:codescore:outputgrading',
            'problemsolutiongrading' => 'privacy:metadata:codescore:problemsolutiongrading',
            'allcasesgrading' => 'privacy:metadata:codescore:allcasesgrading',
        ], 'privacy:metadata:codescore');

        return $collection;
    }
}
