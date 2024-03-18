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

/**
 * Plugin upgrade steps are defined here.
 *
 * @package     mod_codescore
 * @category    upgrade
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/upgradelib.php');

/**
 * Execute mod_codescore upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_codescore_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    // For further information please read {@link https://docs.moodle.org/dev/Upgrade_API}.
    //
    // You will also have to create the db/install.xml file by using the XMLDB Editor.
    // Documentation for the XMLDB Editor can be found at {@link https://docs.moodle.org/dev/XMLDB_editor}.

    if ($oldversion < 2024022005) {
        $table = new xmldb_table('codescore_attempts');
        $field = new \xmldb_field('feedback', XMLDB_TYPE_TEXT, '10', null, null, null, null, null);
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
    }
    if ($oldversion < 2024022200) {
        $table = new xmldb_table('codescore');
        $field = new \xmldb_field('feedbacklang', XMLDB_TYPE_TEXT, '10', null, null, null, null, null);
        $field2 = new \xmldb_field('showfeedback', XMLDB_TYPE_INTEGER, '10', null, null, null, null, null);
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        if (!$dbman->field_exists($table, $field2)) {
            $dbman->add_field($table, $field2);
        }
    }
    if ($oldversion < 2024031301) {
        $table = new xmldb_table('codescore');
        $attempts = new xmldb_table('codescore_attempts');

        $rubric1maxgrade = new \xmldb_field('rubric1maxgrade', XMLDB_TYPE_TEXT, '10', null, null, null, null, null);
        $rubric2maxgrade = new \xmldb_field('rubric2maxgrade', XMLDB_TYPE_TEXT, '10', null, null, null, null, null);
        $rubric3maxgrade = new \xmldb_field('rubric3maxgrade', XMLDB_TYPE_TEXT, '10', null, null, null, null, null);
        $rubric4maxgrade = new \xmldb_field('rubric4maxgrade', XMLDB_TYPE_TEXT, '10', null, null, null, null, null);

        $rubric1name = new \xmldb_field('rubric1name', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);
        $rubric2name = new \xmldb_field('rubric2name', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);
        $rubric3name = new \xmldb_field('rubric3name', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);
        $rubric4name = new \xmldb_field('rubric4name', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);

        $rubric1grade = new \xmldb_field('rubric1grade', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);
        $rubric2grade = new \xmldb_field('rubric2grade', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);
        $rubric3grade = new \xmldb_field('rubric3grade', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);
        $rubric4grade = new \xmldb_field('rubric4grade', XMLDB_TYPE_TEXT, '20', null, null, null, null, null);

        $rubric1enabled = new \xmldb_field('rubric1enabled', XMLDB_TYPE_INTEGER, '1', null, null, null, null, null);
        $rubric2enabled = new \xmldb_field('rubric2enabled', XMLDB_TYPE_INTEGER, '1', null, null, null, null, null);
        $rubric3enabled = new \xmldb_field('rubric3enabled', XMLDB_TYPE_INTEGER, '1', null, null, null, null, null);
        $rubric4enabled = new \xmldb_field('rubric4enabled', XMLDB_TYPE_INTEGER, '1', null, null, null, null, null);

        $rubriccount = new \xmldb_field('rubriccount', XMLDB_TYPE_INTEGER, '1', null, null, null, null, null);

        if (!$dbman->field_exists($table, $rubric1maxgrade)) {
            $dbman->add_field($table, $rubric1maxgrade);
        }
        if (!$dbman->field_exists($table, $rubric2maxgrade)) {
            $dbman->add_field($table, $rubric2maxgrade);
        }
        if (!$dbman->field_exists($table, $rubric3maxgrade)) {
            $dbman->add_field($table, $rubric3maxgrade);
        }
        if (!$dbman->field_exists($table, $rubric4maxgrade)) {
            $dbman->add_field($table, $rubric4maxgrade);
        }

        if (!$dbman->field_exists($table, $rubric1enabled)) {
            $dbman->add_field($table, $rubric1enabled);
        }
        if (!$dbman->field_exists($table, $rubric2enabled)) {
            $dbman->add_field($table, $rubric2enabled);
        }
        if (!$dbman->field_exists($table, $rubric3enabled)) {
            $dbman->add_field($table, $rubric3enabled);
        }
        if (!$dbman->field_exists($table, $rubric4enabled)) {
            $dbman->add_field($table, $rubric4enabled);
        }

        if (!$dbman->field_exists($attempts, $rubric1grade)) {
            $dbman->add_field($attempts, $rubric1grade);
        }
        if (!$dbman->field_exists($attempts, $rubric2grade)) {
            $dbman->add_field($attempts, $rubric2grade);
        }
        if (!$dbman->field_exists($attempts, $rubric3grade)) {
            $dbman->add_field($attempts, $rubric3grade);
        }
        if (!$dbman->field_exists($attempts, $rubric4grade)) {
            $dbman->add_field($attempts, $rubric4grade);
        }

        if (!$dbman->field_exists($attempts, $rubric1name)) {
            $dbman->add_field($attempts, $rubric1name);
        }
        if (!$dbman->field_exists($attempts, $rubric2name)) {
            $dbman->add_field($attempts, $rubric2name);
        }
        if (!$dbman->field_exists($attempts, $rubric3name)) {
            $dbman->add_field($attempts, $rubric3name);
        }
        if (!$dbman->field_exists($attempts, $rubric4name)) {
            $dbman->add_field($attempts, $rubric4name);
        }

        if (!$dbman->field_exists($attempts, $rubric1enabled)) {
            $dbman->add_field($attempts, $rubric1enabled);
        }
        if (!$dbman->field_exists($attempts, $rubric2enabled)) {
            $dbman->add_field($attempts, $rubric2enabled);
        }
        if (!$dbman->field_exists($attempts, $rubric3enabled)) {
            $dbman->add_field($attempts, $rubric3enabled);
        }
        if (!$dbman->field_exists($attempts, $rubric4enabled)) {
            $dbman->add_field($attempts, $rubric4enabled);
        }

        if (!$dbman->field_exists($attempts, $rubriccount)) {
            $dbman->add_field($attempts, $rubriccount);
        }
    }

    return true;
}
