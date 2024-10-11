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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot."/lib/filelib.php");

/**
 * Class gptx_prompt
 *
 * This class handles the interaction with the CodeScore API to send prompts
 * and retrieve feedback based on the user's code submission. It constructs
 * the necessary data payload, sends it to the API, and processes the response.
 *
 * @package     mod_codescore
 * @copyright   2024 Devlion <info@devlion.co>
 * @author      Vladyslav Braun <vlad@devlion.co>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class gptx_prompt {
    /**
     * gptx_prompt constructor.
     *
     * Initializes the gptx_prompt instance with the provided attempt data.
     *
     * @param stdClass $data The data related to the user's attempt, including code, task, and programming language.
     */
    public function __construct($data) {
        $this->attemptData = $data;
    }

    /**
     * Sends the prompt to the CodeScore API and returns the feedback message.
     *
     * @param object $codescore An object containing information about the code score attempt.
     * @return string The feedback message returned from the API.
     */
    public function sendprompt($codescore) {
        $response = $this->sendrequest($codescore);
        return json_decode($response)->message;
    }

    /**
     * Prepares and sends the request to the CodeScore API.
     *
     * Constructs the data payload including the user's code, programming language,
     * task information, and rubrics. It also handles the API configuration
     * such as the URL and API key.
     *
     * @param object $codescore An object containing information about the code score attempt.
     * @return string The raw JSON response from the API.
     */
    private function sendrequest($codescore) {
        global $DB;

        $config = get_config('mod_codescore');
        $key = $config->apikey;
        $url = $config->apiurl;

        if ($url === '' || $url === null) {
            $url = 'https://apireprot.learnapp.io/LionAI/index.php';
        }

        if ($key === '' || $key === null) {
            $key = '78943f4e0d975b797de17bc980ee402037d6d2a3';
        }

        $correctedata = new stdClass();
        $correctedata->solution = $this->attemptData->code;
        $correctedata->lang = $codescore->programminglang;
        $correctedata->task = $codescore->task;

        $rubricsprompt = 'An object with grades. Object should be called \'grades\'. In this object should be these variables: \n';

        $modulerubrics = json_decode($codescore->rubricsobject, true);
        $newrubrics = [];

        foreach ($modulerubrics as $modulekey => $value) {
            array_push($newrubrics, [
                'name' => $value['name'],
                'enabled' => $value['enabled'],
                'maxgrade' => $value['maxgrade'],
                'grade' => '',
                'prompt' => $config->{'rubric' . strval(intval($modulekey) + 1) . 'prompt'},
            ]);
        }

        $attempt = $DB->get_record('codescore_attempts', ['id' => $this->attemptData->id]);
        $attempt->rubricsobject = json_encode($newrubrics);
        $DB->update_record('codescore_attempts', $attempt);

        $updatedattempt = $DB->get_record('codescore_attempts', ['id' => $this->attemptData->id]);
        $updatedrubrics = json_decode($updatedattempt->rubricsobject, true);

        foreach ($updatedrubrics as $arrkey => $value) {
            $preparedstring = strval(intval($arrkey) + 1) . " - " . $value['prompt'] . ', from 0 to ' . strval($value['maxgrade']) .
                ', variable should be named rubric' . $arrkey . 'grade. \n';
            $rubricsprompt .= $preparedstring;
        }
        $correctedata->rubrics = $rubricsprompt;

        $correctedata->feedbacklang = get_string_manager()->get_list_of_translations()[$codescore->feedbacklang];

        $curldata = [
            'token' => $key,
            'data' => json_encode($correctedata),
            'id' => '124',
            'action' => 'CodeScore',
        ];

        $curl = new \curl();
        $jsonresult = $curl->post($url, $curldata);
        return $jsonresult;
    }
}
