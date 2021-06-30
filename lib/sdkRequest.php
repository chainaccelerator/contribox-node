<?php

class SdkRequest {

    public static $timeout = 10800;

    public int $timestamp = 0;
    public SdkRequestPow $pow;
    public SdkRequestSig $sig;

    public function __construct(stdClass $data){

        $this->timestamp = time();

        if(($this->timestamp - $data->request->timestamp) > self::$timeout) {

            SdkReceived::$message = 'timeout';
            SdkReceived::$code =  504;
            return false;
        }
        $pow = new CryptoPow($data->request->route, $data->request->timestamp);

        if($pow->hash !== $data->request->hash) {

            SdkReceived::$message = 'bad hash';
            SdkReceived::$code =  504;
            return false;
        }
        $pow->nonce = $data->request->pow->nonce;
        $pow->pow = $data->request->pow->pow;
        $pow->previousHash = $data->request->pow->previousHash;

        if($pow->powVerify() === false) return false;

        $sig = new CryptoSig($data->request->sig->address, $data->request->sig->signature);

        if($sig->verif() === false) return false;
    }
}