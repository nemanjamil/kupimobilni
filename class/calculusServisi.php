<?php

class calculusServisi extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;

    }


    public function posaljiPodatkeCalc($url, $postParametri=false)
    {


        $ch = curl_init($url);
        //curl_setopt($ch, CURLOPT_HEADER, 0); // default je 0
        //curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        // curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

        if ($postParametri) {
            curl_setopt($ch,CURLOPT_POST,count($postParametri));
            curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($postParametri)); // http_build_query
        }
        $response = curl_exec($ch);

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($httpStatus == 404){
            echo '404';
        }
        if($httpStatus == 302){
            echo '302';
        }

        if (empty($response)) {
            $val = 'Curl error: ' . curl_error($ch);
        } else {
            $val = $response;
        }

        curl_close($ch);
        return $val;

    }


}