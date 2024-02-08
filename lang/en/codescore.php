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
 * Plugin strings are defined here.
 *
 * @package     mod_codescore
 * @category    string
 * @copyright   2024 Devlion <info@devlion.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['missingidandcmid'] = 'Missing id and cmid';
$string['modulename'] = 'Codescore';
$string['modulename_help'] = 'Codescore helps teacher grade the student\'s code using AI';
$string['timing'] = 'Timing';
$string['codescoreopenclose'] = 'Open and close dates';
$string['codescoreopenclose_help'] = 'Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.';
$string['codescoreopen'] = 'Open the activity';
$string['codescoreclose'] = 'Close the activity';
$string['codescoreclose_help'] = 'Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.';

$string['modulenameplural'] = 'Codescore\'s';
$string['newmodulesettings'] = 'Settings';
$string['nonewmodules'] = 'No new modules';
$string['pluginadministration'] = 'Codescore plugin administration';
$string['pluginname'] = 'Code Score';
$string['task'] = 'Write task';
$string['codescorefieldset'] = 'Fieldset';
$string['codescoresettings'] = 'Settings';
$string['codescorename'] = 'Title';
$string['codescorename_help'] = 'Help';
$string['privacy:metadata'] = 'Code Score does not store any personal data';
$string['view'] = 'View';
$string['grading'] = 'Grading options';
$string['syntaxgrade'] = 'Grade for syntax';
$string['syntaxgrade_help'] = "Maximum grade for student's code syntax correctness";
$string['correctoutput'] = 'Grade for correct output';
$string['correctoutput_help'] = "Maximum grade for student's code output/function output";
$string['correctsolution'] = 'Grade for correct solution';
$string['correctsolution_help'] = "Maximum grade for student's code optimization/patterns";
$string['allcases'] = 'Grade for covering all cases';
$string['allcases_help'] = "Maximum grade for student's code covering all cases (e.g function works properly with any set of parameters)";
$string['programminglang'] = 'Select programming language';
$string['autograde'] = 'Set automatic grade by AI';
$string['alowedlanguages'] = 'Select languages that will be used';
$string['multiattempts'] = 'Multiple attempts';
$string['python'] = 'Python';
$string['filltask'] = 'Please provide task description';
$string['selectlang'] = 'Please select language';
$string['yes'] = 'Yes';
$string['no'] = 'No';

// Admin settings
$string['apikey'] = 'API Key';
$string['apikeyexplain'] = 'Insert an API key for GPT-4';
$string['apiurl'] = 'API URL';
$string['apiurlexplain'] = 'Insert an API URL for GPT-4';

// View
$string['viewreportsbtn'] = 'View reports';
$string['taskview'] = 'The task is:';
$string['submissionstatus'] = 'Submission status: ';
$string['submitted'] = 'submitted';
$string['notsubmitted'] = 'not submitted';
$string['yoursubmissions'] = 'Your attempt: ';

// Reports
$string['studentsreports'] = "Student's reports:";
$string['noreports'] = "No reports yet";
$string['deleteBtnText'] = 'Delete attempts';
$string['areyousure'] = 'Are you sure you want to delete attempts?';
$string['irreversible'] = 'This action will be irreversible';

// Attempt
$string['taskheader'] = 'The task is:';

// Attempts table
$string['tablename'] = "Name";
$string['startedat'] = "Started at";
$string['tablenotes'] = "Notes";
$string['syntaxgradetable'] = "Syntax grade";
$string['outputgradetable'] = "Output grade";
$string['problemgradetable'] = "Problem grade";
$string['casesgradetable'] = "All cases coverage grade";
$string['tableaigrade'] = "AI grade";
$string['tableteachergrade'] = "Teacher grade";

// Report
$string['taskoverview'] = 'Task overview';
$string['reportlang'] = 'Programming language: ';
$string['taskreport'] = 'Task: ';
$string['maxgradesyntax'] = 'Max grade for syntax: ';
$string['maxrightoutput'] = 'Max grade for right output: ';
$string['maxproblemsolution'] = 'Max grade for problem solution: ';
$string['maxcovering'] = 'Max grade for covering all cases: ';
$string['reportname'] = 'report';
$string['reportgrade'] = 'Grade: ';
$string['aigradereport'] = 'AI grade: ';
$string['syntaxreport'] = 'Syntax grade: ';
$string['outputreport'] = 'Output grade: ';
$string['problemreport'] = 'Problem solving grade: ';
$string['casesreport'] = 'All cases coverage grade: ';
$string['notesreport'] = 'Notes: ';
$string['codediffreport'] = 'Code diff: ';
$string['studentcodereport'] = "Student's code";
$string['correctcodereport'] = 'Corrected code';
$string['reportgradebtn'] = 'Grade';
