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

$string['adminheading'] = 'Rubrics';
$string['adminheadingexplain'] = 'Change grading rubrics';
$string['aifeedback'] = 'AI feedback:';
$string['aigradereport'] = 'AI grade: ';
$string['allcases'] = 'Grade for covering all cases';
$string['allcases_help'] = "Maximum grade for student's code covering all cases (e.g function works properly with any set of parameters)";
$string['alowedlanguages'] = 'Select languages that will be used';
$string['apikey'] = 'API Key';
$string['apikeyexplain'] = 'The key to access AI API. The free version allows you 10 prompt executions per week. To get the Pro version, contact us at <a href="mailto:info@devlion.co">info@devlion.co</a>';
$string['apiurl'] = 'API URL';
$string['apiurlexplain'] = 'The url to access AI API';
$string['areyousure'] = 'Are you sure you want to delete attempts?';
$string['autograde'] = 'Set automatic grade by AI';
$string['casesgradetable'] = "All cases coverage grade";
$string['casesreport'] = 'All cases coverage grade: ';
$string['checkall'] = 'Check all';
$string['codediffreport'] = 'Code diff: ';
$string['codescoreclose'] = 'Close the activity';
$string['codescoreclose_help'] = 'Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.';
$string['codescorefieldset'] = 'Fieldset';
$string['codescorename'] = 'Title';
$string['codescorename_help'] = 'Help';
$string['codescoreopen'] = 'Open the activity';
$string['codescoreopenclose'] = 'Open and close dates';
$string['codescoreopenclose_help'] = 'Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.';
$string['codescoresettings'] = 'Settings';
$string['correctcodereport'] = 'Corrected code';
$string['correctoutput'] = 'Grade for correct output';
$string['correctoutput_help'] = "Maximum grade for student's code output/function output";
$string['correctsolution'] = 'Grade for correct solution';
$string['correctsolution_help'] = "Maximum grade for student's code optimization/patterns";
$string['deleteBtnText'] = 'Delete attempts';
$string['feedbacklang'] = 'Language of feedback';
$string['filltask'] = 'Please provide task description';
$string['finishedstatus'] = "Finished";
$string['graded'] = 'Graded';
$string['gradestatus'] = 'Status:';
$string['gradewarn'] = 'Total sum of grades should be equal to 100';
$string['grading'] = 'Grading options';
$string['irreversible'] = 'This action will be irreversible';
$string['maxgrade'] = 'Maximum for';
$string['missingidandcmid'] = 'Missing id and cmid';
$string['modgradeswarn'] = 'Total sum of active grades should be equal to 100';
$string['modulename'] = 'Codescore';
$string['modulename_help'] = 'Codescore helps teacher grade the student\'s code using AI';
$string['modulenameplural'] = 'Codescore\'s';
$string['multiattempts'] = 'Multiple attempts';
$string['newmodulesettings'] = 'Settings';
$string['no'] = 'No';
$string['noinstances'] = 'There are no CodeScore instances';
$string['nonewmodules'] = 'No new modules';
$string['noreports'] = "No reports yet";
$string['notesplaceholder'] = 'You can write notes for teachers here';
$string['notesreport'] = 'Notes: ';
$string['notgraded'] = 'Not graded yet';
$string['notsubmitted'] = 'not submitted';
$string['outputgradetable'] = "Output grade";
$string['outputreport'] = 'Output grade: ';
$string['pendingstatus'] = "Pending";
$string['pluginadministration'] = 'Codescore plugin administration';
$string['pluginname'] = 'Code Score';
$string['privacy:metadata'] = 'Code Score does not store any personal data';
$string['privacy:metadata:codescore'] = 'This table contains info that is sent to API so it can give feedback about student\'s code';
$string['privacy:metadata:codescore:allcasesgrading'] = "Maximum grade for student's code covering all cases (e.g function works properly with any set of parameters)";
$string['privacy:metadata:codescore:outputgrading'] = "Maximum grade for student's code output/function output";
$string['privacy:metadata:codescore:problemsolutiongrading'] = "Maximum grade for student's code optimization/patterns";
$string['privacy:metadata:codescore:programminglang'] = 'Programming language that needs to be used in the instance';
$string['privacy:metadata:codescore:syntaxgrading'] = "Maximum grade for student's code syntax correctness";
$string['privacy:metadata:codescore:task'] = 'Coding task of the instance';
$string['privacy:metadata:codescore_attempts'] = 'This table contains info about user\'s attempts';
$string['privacy:metadata:codescore_attempts:attempt'] = 'Sequentially numbers of this student\'s attempts.';
$string['privacy:metadata:codescore_attempts:code'] = 'Code that was submitted in this attempt.';
$string['privacy:metadata:codescore_attempts:grade'] = 'Grade for this attempt.';
$string['privacy:metadata:codescore_attempts:studentnotes'] = 'Notes for this attempt.';
$string['privacy:metadata:codescore_attempts:timefinish'] = 'Time at which user finished attempt.';
$string['privacy:metadata:codescore_attempts:timegraded'] = 'Time at which user graded attempt.';
$string['privacy:metadata:codescore_attempts:timemodified'] = 'Time at which user modified attempt.';
$string['privacy:metadata:codescore_attempts:timemodifiedoffline'] = 'Time at which user modified attempt being offline.';
$string['privacy:metadata:codescore_attempts:timestart'] = 'Time at which user started attempt.';
$string['privacy:metadata:codescore_attempts:userid'] = 'The ID of the user that saved this report.';
$string['problemgradetable'] = "Problem solution grade";
$string['problemreport'] = 'Problem solving grade: ';
$string['programminglang'] = 'Select programming language';
$string['programminglangview'] = 'Programming language:';
$string['python'] = 'Python';
$string['regrade'] = 'Regrade attempts';
$string['reportgrade'] = 'Grade: ';
$string['reportgradebtn'] = 'Grade';
$string['reportlang'] = 'Programming language: ';
$string['reportname'] = 'report';
$string['rubric1prompt'] = 'Grade for student\'s code syntax';
$string['rubric2prompt'] = 'Grade for the output of the code';
$string['rubric3prompt'] = 'Grade for correct code solution';
$string['rubric4prompt'] = 'Grade for code covering all cases';
$string['rubricblock'] = 'Rubric';
$string['rubricname'] = 'Rubric name';
$string['rubricprompt'] = 'Rubric prompt';
$string['rubricscount'] = 'Number of rubrics';
$string['saveandexit'] = "Save and exit";
$string['selectlang'] = 'Please select language';
$string['showfeedback'] = 'Show AI feedback to students';
$string['startattempt'] = 'Start attempt';
$string['startedat'] = "Started at";
$string['statusattempt'] = "Status";
$string['studentcodereport'] = "Student's code";
$string['studentsreports'] = "Student's reports:";
$string['submissionstatus'] = 'Submission status: ';
$string['submitted'] = 'submitted';
$string['submittedstatus'] = "Submitted";
$string['syntaxgrade'] = 'Grade for syntax';
$string['syntaxgrade_help'] = "Maximum grade for student's code syntax correctness";
$string['syntaxgradetable'] = "Syntax grade";
$string['syntaxreport'] = 'Syntax grade: ';
$string['tableaigrade'] = "AI grade";
$string['tablename'] = "Name";
$string['tableteachergrade'] = "Final grade";
$string['task'] = 'Write task';
$string['taskheader'] = 'The task is:';
$string['taskoverview'] = 'Task overview';
$string['taskreport'] = 'Task: ';
$string['taskview'] = 'The task is:';
$string['timefinish'] = "Submitted at";
$string['timegraded'] = "Graded at";
$string['timing'] = 'Timing';
$string['unavaibleactivity'] = "This activity isn't available for now";
$string['view'] = 'View';
$string['viewdategraded'] = 'Date graded:';
$string['viewreportsbtn'] = 'View reports';
$string['waitingforgrade'] = 'Waiting for grade';
$string['yes'] = 'Yes';
$string['yoursubmissions'] = 'Your attempt: ';
