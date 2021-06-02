<?php

class CryptoPow {

    public static int $difficulty = 4;
    public static string $difficultyPatthern = 'c';

    public CryptoHash $hash;
    public int $nonce = 0;

    public function __construct(stdClass $data, bool|stdClass $dataToHash = false){

        if(isset($data->nonce) === false) {exit('No nonce');} else $this->nonce = $data->nonce;

        if(isset($data->difficulty ) === false) {exit('No difficulty');} elseif(self::$difficulty !== $this->difficulty) exit('Bad difficulty');
        if(isset($data->difficultyPatthern ) === false) {exit('No difficultyPathern');} elseif(self::$ddifficultyPatthern !== $this->difficultyPatthern) exit('Bad difficultyPatthern');

        if(isset($data->hash) === false) {exit('No hash');} else $this->hash = new CryptoHash($data->hash);
        if($dataToHash !== false && $this->hash->verif(json_encode($dataToHash)) === false) exit('Bad Hash');
    }
}