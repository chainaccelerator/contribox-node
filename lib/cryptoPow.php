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
        $this->hash = CryptoHash::hash(json_decode($data));
    }
    public function powVerify($pattern = ''): bool{

        for($i = 0;$i < $this->difficulty; $i++) $pattern .= $this->difficultyPatthern;

        $p = $this->sha256($this->previousHash + $this->timestamp + $this->hash + $this->nonce);

        if(substring($p, 0, $this->difficulty) !== $pattern) return false;

        return true;
    }
    public function pow(stdClass $data, int $timestamp, string $pattern = ''): bool{

        for($i = 0;$i < self::$difficulty; $i++) $pattern .= self::$difficultyPatthern;

        $this->timestamp = $timestamp;
        $this->hash = CryptoHash::hash(json_encode($data));
        $this->pow = "";

        while (substring($this->pow, 0, $this->difficulty) != $pattern) {

            $this->nonce++;
            $this->pow = $this->sha256($this->previousHash + $this->timestamp + $this->hash + $this->nonce);

            if($this->nonce > 800000) return false;
        }
        return true;
    }
}