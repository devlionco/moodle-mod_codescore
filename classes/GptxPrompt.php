<?php
require_once($CFG->dirroot."/lib/filelib.php");

class GptxPrompt {
    private $result = '';

    public function __construct($data) {
        $this->attemptData = $data;
    }

    public function sendPrompt($codescore) {
        $response = $this->sendRequest($codescore);
        $convertedResponse = json_decode(json_decode($response));
        return $convertedResponse->message;
    }

    private function sendRequest($codescore) {

        $config = get_config('codescore');
        $key = $config->apikey;
        $url = $config->apiurl;

        if($url === '' || $url === null) {
            $url = 'https://apireprot.learnapp.io/LionAI/index.php';
        }

        if($key === '' || $key === null) {
            $key = '78943f4e0d975b797de17bc980ee402037d6d2a3';
        }

        $correctedData = new stdClass();
        $correctedData->solution = $this->attemptData->code;
        $correctedData->lang = $codescore->programminglang;
        $correctedData->task = $codescore->task;
        $correctedData->syntaxgrade = $codescore->syntaxgrading;
        $correctedData->outputgrade = $codescore->outputgrading;
        $correctedData->solutiongrade = $codescore->problemsolutiongrading;
        $correctedData->allcasesgrade = $codescore->allcasesgrading;

        $curldata = array(
            'token' => $key,
            'data' => json_encode($correctedData),
            'id' => '124',
            'action' => 'CodeCheck',
        );

        $curl = new \curl();
        $jsonresult = $curl->post($url, $curldata);
        return $jsonresult;
    }
}