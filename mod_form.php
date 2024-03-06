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
 * The main mod_codescore configuration form.
 *
 * @package     mod_codescore
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * Module instance settings form.
 *
 * @package     mod_codescore
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_codescore_mod_form extends moodleform_mod {

    public static $datefieldoptions = array('optional' => true);

    /**
     * Defines forms elements
     */
    public function definition() {
        global $CFG;

        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are shown.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('name'), array('size' => '48'));
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $this->standard_intro_elements();
        $mform->addElement('textarea', 'task', get_string('task', 'codescore'));
        $mform->setType('task', PARAM_RAW);
        $mform->addRule('task', get_string('filltask', 'codescore'), 'required');

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

        $alowedlanguages = get_config('codescore')->alowedlanguages;
        $alowedlanguages = explode(',', $alowedlanguages);

        foreach ($langs as $key => $lang) {
            if (in_array($key, $alowedlanguages)) {
                $langoptions[$key] = $lang;
            }
        }

        $mform->addElement('select', 'programminglang', get_string('programminglang', 'codescore'), $langoptions);
        $mform->getElement('programminglang')->addOption('Select...', '13', array( 'disabled' => 'disabled' ));
        $mform->setDefault('programminglang', '13');

        $checkvalid = function ($val) {
            if ($val === '13') {
                return false;
            } else {
                return true;
            }
        };

        $mform->addRule('programminglang', get_string('selectlang', 'codescore'), 'callback', $checkvalid, 'server');

        $mform->addElement('header', 'timing', get_string('timing', 'codescore'));

        // Open and close dates.
        $mform->addElement('date_time_selector', 'timeopened', get_string('codescoreopen', 'codescore'),
                self::$datefieldoptions);
        $mform->setType('timeopened', PARAM_INT);
        $mform->addHelpButton('timeopened', 'codescoreclose', 'codescore');

        $mform->addElement('date_time_selector', 'timeclosed', get_string('codescoreclose', 'codescore'),
                self::$datefieldoptions);
        $mform->setType('timeclosed', PARAM_INT);
        // grading options
        $mform->addElement('header', 'gradingoptions', get_string('grading', 'codescore'));

        $mform->addElement('text', 'syntaxgrading', get_string('syntaxgrade', 'codescore'));
        $mform->setType('syntaxgrading', PARAM_INT);
        $mform->setDefault('syntaxgrading', 10);
        $mform->addHelpButton('syntaxgrading', 'syntaxgrade', 'codescore');

        $mform->addElement('text', 'outputgrading', get_string('correctoutput', 'codescore'));
        $mform->setType('outputgrading', PARAM_INT);
        $mform->setDefault('outputgrading', 60);
        $mform->addHelpButton('outputgrading', 'correctoutput', 'codescore');

        $mform->addElement('text', 'problemsolutiongrading', get_string('correctsolution', 'codescore'));
        $mform->setType('problemsolutiongrading', PARAM_INT);
        $mform->setDefault('problemsolutiongrading', 10);
        $mform->addHelpButton('problemsolutiongrading', 'correctsolution', 'codescore');

        $mform->addElement('text', 'allcasesgrading', get_string('allcases', 'codescore'));
        $mform->setType('allcasesgrading', PARAM_INT);
        $mform->setDefault('allcasesgrading', 20);
        $mform->addHelpButton('allcasesgrading', 'allcases', 'codescore');

        $checkgrading = function() {
            $mform = $this->_form;
            $syntaxvalue = (int)$mform->getElement('syntaxgrading')->_attributes['value'];
            $outputvalue = (int)$mform->getElement('outputgrading')->_attributes['value'];
            $solutionvalue = (int)$mform->getElement('problemsolutiongrading')->_attributes['value'];
            $casesvalue = (int)$mform->getElement('allcasesgrading')->_attributes['value'];
            if ($syntaxvalue + $outputvalue + $solutionvalue + $casesvalue !== 100) {
                return false;
            }
            return true;
        };

        $mform->addElement('advcheckbox', 'autograde', get_string('autograde', 'codescore'));
        $mform->setDefault('autograde', false);

        $mform->addElement('advcheckbox', 'showfeedback', get_string('showfeedback', 'codescore'));
        $mform->setDefault('showfeedback', true);

        $mform->addRule('allcasesgrading', 'Total sum of grades should be equal to 100', 'callback', $checkgrading, 'server');

        $mform->addElement('advcheckbox', 'multiattempts', get_string('multiattempts', 'codescore'));
        $mform->setDefault('multiattempts', true);

        $mform->addElement('select', 'feedbacklang', get_string('feedbacklang', 'codescore'), get_string_manager()->get_list_of_translations());
        $mform->setDefault('feedbacklang', $CFG->lang);

        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();

    }
}
