<?php

class URLHandler {

    public $URL = null;
    public $ResultArray = array();
    private $Links = array();

    function URLHandler() {
        include_once('CurlRequestHandler.php');
    }

    function setLinks($url) {
        $ObjCurlRequestHandler = new CurlRequestHandler();

        $ObjCurlRequestHandler->SetUrl($url);
        $ObjCurlRequestHandler->SendRequest();

        preg_match_all('|<a.*?href="(.*?)"|', $ObjCurlRequestHandler->GetResult(), $result);
        $this->Links = $result[1];
        $ObjCurlRequestHandler->Close();
        return $this->Links;
    }

    function setResultArray() {

        foreach ($this->Links as $item) {
            $start = microtime();
            $start = explode(" ", $start);
            $start = $start[1] + $start[0];
            $this->ResultArray[][0] = $item;
            $ObjCurlRequestHandler = new CurlRequestHandler;
            $ObjCurlRequestHandler->SetUrl($item);
            $ObjCurlRequestHandler->SendRequest();
            $this->ResultArray[][1] = preg_match_all('/<img[^>]+>/i', $ObjCurlRequestHandler->GetResult());
            $ObjCurlRequestHandler->Close();
            $end = microtime();
            $end = explode(" ", $end);
            $end = $end[1] + $end[0];
            $this->ResultArray[][2] = $end - $start;
        }
        return $this->ResultArray;
    }

}

?>	
