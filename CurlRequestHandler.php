<?php

class CurlRequestHandler {

    private $Url;
    private $RequestArgs;
    private $PostData;
    private $ResultData;
    public $Status = true;
    public $Error = null;
    private $CurlObject;

    function CurlRequestHandler() {
        $this->RequestArgs = null;
        $this->PostData = array();
        $this->CurlObject = curl_init();
    }

    public function setUrl($UrlPassed) {
        $this->Url = $UrlPassed;
    }

    public function setRequestArgs($Argument, $Value) {
        $this->RequestArgs .= $Argument . '=' . $Value . '&';
    }

    public function resetRequestArgs() {
        $this->RequestArgs = null;
    }

    public function setPostData($Data) {
        $this->PostData[] = $Data;
    }

    public function sendRequest() {

        $SetOptArray = array(CURLOPT_POST => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_HTTPHEADER => $this->PostData, CURLOPT_URL => $this->Url);
        @curl_setopt_array($this->CurlObject, $SetOptArray);
        $this->ResultData = @curl_exec($this->CurlObject);
    }

    public function getResult() {
        return $this->ResultData;
    }

    public function close() {
        if ($this->CurlObject) {
            @curl_close($this->CurlObject);
        }
    }

}

?>
