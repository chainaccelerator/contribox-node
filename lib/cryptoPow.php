<?php

class CryptoPow {

    public static int $difficultyDefault = 4;
    public static string $difficultyPatthernDefault = 'd';

    public int $difficulty = 4;
    public string $difficultyPatthern = 'd';

    public string $hash = '';
    public int $nonce = 0;
    public string $pow = '';
    public string $previousHash = '';
    public int $timestamp = 0;

    public function __construct(stdClass $data, int $timestamp){

        $this->timestamp = $timestamp;
        $this->hash = CryptoHash::hash(json_encode($data));
    }
    public function powVerify(int $nonce, $pattern = ''): bool{

        for($i = 0;$i < $this->difficulty; $i++) $pattern .=  $this->difficultyPatthern;

        $p = CryptoHash::hash($this->previousHash.$this->timestamp.$this->hash.$nonce);

        if(substr($p, 0, $this->difficulty) !== $pattern) {

            SdkReceived::$message = 'bad pow';
            SdkReceived::$code =  505;
            return false;
        }
        return true;
    }
    public function pow(string $pattern = ''): bool{

        for($i = 0;$i < $this->difficulty; $i++) $pattern .= $this->difficultyPatthern;

        $this->timestamp = $this->timestamp;
        $this->pow = '';

        while (substr($this->pow, 0, $this->difficulty) != $pattern) {

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