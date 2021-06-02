<?php

class CryptoSig {

    public string $sig = '';
    public string $publicAddress = '';

    public function __construct(stdClass $data){

        if(isset($data->sig) === false) {exit('No sig');} else $this->sig = $data->sig;
        if(isset($data->publicAddress) === false) {exit('No publicAddress');} else $this->publicAddress = $data->publicAddress;

        if($this->verif() === false) exit('Bad sig');
    }
    public function verif():bool{

        return true;
    }
}