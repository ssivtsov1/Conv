<?php
namespace app\models;
class Ccon_soap{
    public $params,$proc;

    function __construct($hSoap,$lSoap,$pSoap){
//        GLOBAL $hSoap,$lSoap,$pSoap;
        $this->hSoap = $hSoap;
        $this->lSoap = $lSoap;
        $this->pSoap = $pSoap;
    }

    function soap_blina($params,$proc){
        $result='';
        $this->params = $params;
        $this->proc = $proc;
        $context = stream_context_create(array(     'ssl' => array(         'verify_peer' => false,         'verify_peer_name' => false,         'allow_self_signed' => true     ) ));
        $client = new \SoapClient($this->hSoap,array('login' => $this->lSoap,'password' => $this->pSoap,'soap_version' => SOAP_1_2,'encoding' => 'UTF-8','trace' => true,
//            'cache_wsdl' => WSDL_CACHE_NONE,
//            'verify_peer' => false,
//            'verify_peer_name' =>false,
//            'allow_self_signed' => true,
//            "exception" => 0,

            ));

        try{
            $result = $client->__soapCall($this->proc, array($this->params));

        }
        catch(Exception $e){
            echo($client->__getLastResponse());
            echo PHP_EOL;
            echo($client->__getLastRequest());
        }
        return $result;
    }
}

