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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot."/lib/filelib.php");

class GptxPrompt {
    private $result = '';

    public function __construct($data) {
        $this->attemptData = $data;
    }

    public function sendprompt($codescore) {
        $response = $this->sendrequest($codescore);
        $convertedresponse = json_decode(json_decode($response));
        return $convertedresponse->message;
    }

    private function sendrequest($codescore) {

        $config = get_config('codescore');
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
        $correctedata->syntaxgrade = $codescore->syntaxgrading;
        $correctedata->outputgrade = $codescore->outputgrading;
        $correctedata->solutiongrade = $codescore->problemsolutiongrading;
        $correctedata->allcasesgrade = $codescore->allcasesgrading;

        $curldata = array(
            'token' => $key,
            'data' => json_encode($correctedata),
            'id' => '124',
            'action' => 'CodeCheck',
        );

        $curl = new \curl();
        $jsonresult = $curl->post($url, $curldata);
        return $jsonresult;
    }
}
