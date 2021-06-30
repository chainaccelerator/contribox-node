<?php

class CryptoPow {

    public static int $difficulty = 4;
    public static string $difficultyPatthern = 'd';

    public string $hash = '';
    public int $nonce = 0;
    public string $pow = '';
    public string $previousHash = '';
    public int $timestamp = 0;

    public function __construct(stdClass $data, int $timestamp){

        $this->timestamp = $timestamp;
        $this->hash = CryptoHash::hash(json_encode($data));
    }
    public function powVerify($pattern = ''): bool{

        for($i = 0;$i < self::$difficulty; $i++) $pattern .=  self::$difficultyPatthern;

        $p = CryptoHash::hash($this->previousHash.$this->timestamp.$this->hash.$this->nonce);

        if(substr($p, 0, self::$difficulty) !== $pattern) {

            SdkReceived::$message = 'bad pow';
            SdkReceived::$code =  505;
            return false;
        }
        return true;
    }
    public function pow(stdClass $data, int $timestamp, string $pattern = ''): bool{

        for($i = 0;$i < self::$difficulty; $i++) $pattern .= self::$difficultyPatthern;

        $this->timestamp = $timestamp;
        $this->hash = CryptoHash::hash(json_encode($data));
        $this->pow = "";

        while (substr($this->pow, 0, self::$difficulty) != $pattern) {

            $this->nonce++;
            $this->pow =  CryptoHash::hash($this->previousHash.$this->timestamp.$this->hash.$this->nonce);

            if($this->nonce > 800000) {

                SdkReceived::$message = 'pow fail';
                SdkReceived::$code =  506;
                return false;
            }
        }
        return true;
    }
}