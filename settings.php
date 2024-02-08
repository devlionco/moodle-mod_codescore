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
 * Plugin administration pages are defined here.
 *
 * @package     mod_codescore
 * @category    admin
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_admin\local\externalpage\accesscallback;
use core_reportbuilder\permission;

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    if ($ADMIN->fulltree) {
        require_once("$CFG->libdir/resourcelib.php");
        $langs = array(
            '0' => 'Javascript',
            '1' => 'C++',
            '2' => 'Python',
            '3' => 'Java',
            '4' => 'GO',
            '5' => 'C#',
            '6' => 'PHP',
            '7' => 'HTML',
            '8' => 'Typescript',
            '9' => 'Visual Basic',
            '10' => 'Ruby',
            '11' => 'SQL',
            '12' => 'Assembly',
        );
        $settings->add(new admin_setting_configpasswordunmask('codescore/apikey',
                get_string('apikey', 'mod_codescore'), get_string('apikeyexplain', 'mod_codescore'), '78943f4e0d975b797de17bc980ee402037d6d2a3', PARAM_TEXT));
        $settings->add(new admin_setting_configtext('codescore/apiurl',
                get_string('apiurl', 'mod_codescore'), get_string('apiurlexplain', 'mod_codescore'), 'https://apireprot.learnapp.io/LionAI/index.php', PARAM_TEXT));
        $settings->add(new admin_setting_configmultiselect('codescore/alowedlanguages',
                get_string('alowedlanguages', 'mod_codescore'), null,
                array('0', '1', '2', '3', '4', '5', '6', '7'), $langs));
    }
}
