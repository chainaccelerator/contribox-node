<?php

class CryptoSig {

    public string $sig = '';
    public string $publicAddress = '';
    public string $hdPath = '0/0';
    public int $range = 100;

    public function __construct(string $publicAddress, string $sig){

        $this->publicAddress = $publicAddress;
        $this->sig = $sig;
    }
    public function sig(){

    }
    public function verif():bool{

        $original_msg = crypto_sign_open($data->sig, $data->publicAddress);

        if ($original_msg === false)  {

            SdkReceived::$message = 'bad sig';
            SdkReceived::$code =  507;
            return false;
        }
        return true;
    }
}