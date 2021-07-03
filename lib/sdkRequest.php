<?php

class SdkRequest {

    public static $timeout = 10800;

    public int $timestamp = 0;
    public CryptoPow $pow;
    public CryptoSig $sig;

    public function init(stdClass $data, stdClass $route):bool{

        $this->timestamp = time();

        if(($this->timestamp - $data->request->timestamp) > self::$timeout) {

            SdkReceived::$message = 'timeout';
            SdkReceived::$code =  504;
            return false;
        }

        $pow = new CryptoPow($route, $data->request->timestamp);
        echo CryptoHash::hash('toto');
        if($pow->powVerify($data->request->pow->hash, $data->request->pow->nonce) === false) {

            return false;
        }
        $pow->nonce = $data->request->pow->nonce;
        $pow->pow = $data->request->pow->pow;
        $pow->previousHash = $data->request->pow->previousHash;
        $this->pow = $pow;

        $sig = new CryptoSig($data->request->sig->address, $data->request->sig->signature);

        if($sig->verif() === false) return false;

        $this->sig = $sig;

        return true;
    }
}