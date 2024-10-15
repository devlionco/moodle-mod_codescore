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

namespace mod_codescore;
use stdClass;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/codescore/locallib.php');

/**
 * Class basic_test
 *
 * @package    mod_codescore
 * @copyright  2024 Devlion <info@devlion.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers \mod_codescore
 */
final class basic_test extends \advanced_testcase {
    /**
     * Test that creating a codescore activity works.
     *
     * @return void
     */
    public function test_create_activity(): void {
        global $DB;
        $this->resetAfterTest(true);
        $DB->delete_records('codescore');
        $course = $this->getDataGenerator()->create_course();
        $this->getDataGenerator()->create_module('codescore', ['course' => $course->id]);
        $this->assertEquals(1, $DB->count_records('codescore', []));
    }
    /**
     * Test that deleting a codescore activity works.
     *
     * @return void
     */
    public function test_delete_activity(): void {
        global $DB;
        $this->resetAfterTest(true);
        $course = $this->getDataGenerator()->create_course();
        $this->getDataGenerator()->create_module('codescore', ['course' => $course->id]);
        $this->assertEquals(1, $DB->count_records('codescore', []));
        $DB->delete_records('codescore');
        $this->assertEmpty($DB->get_records('codescore'));
    }
    /**
     * Test that saving an attempt works.
     *
     * @return void
     */
    public function test_submit_attempt(): void {
        global $DB;
        $this->resetAfterTest(true);
        $DB->delete_records('codescore');
        $course = $this->getDataGenerator()->create_course();
        $cm = $this->getDataGenerator()->create_module('codescore', ['course' => $course->id]);
        $data = new stdClass;
        $data->code = 'code';
        $data->notes = 'notes';
        $data->cmid = $cm->cmid;
        $data->sesskey = '9iw8sPuL8W';
        $data->timestart = 1707728466;
        codescore_save_attempt($data);
        $this->assertEquals(1, $DB->count_records('codescore_attempts', []));
    }
}
