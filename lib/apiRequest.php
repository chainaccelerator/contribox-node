<?php

class ApiRequest {

    public static array $peerList = array();

    public int $timestamp = 0;
    public CryptoPow $pow;
    public CryptoSig $sig;

    public function __construct(stdClass $data){

        self::$peerList = array_merge(json_decode(file_get_contents($data->peerList)), self::$peerList);

        if(isset($data->timestamp) === false) {exit('No timestamp');} else $this->timestamp = $data->timestamp;
        if(isset($data->peerList) === false) {exit('No peerList');} else self::$peerList = array_merge($data->peerList, self::$peerList);

        if(isset($data->sig) === false) {exit('No sig');} else $this->sig = new CryptoSig($data->sig);

        $dataToHash = $this;
        unset($dataToHash->pow);
        if(isset($data->pow) === false) {exit('No pow');} else $this->pow = new CryptoPow($data->pow, $dataToHash);
    }
}