<?php

use JetBrains\PhpStorm\Pure;

class CryptoHash {

    public static string $algo = 'sha256';
    public string $data = '';
    public string $hash = '';

    public function __construct(string $hash){

        $this->hash = $hash;
    }
    public function verif(string $data):bool{

        return (self::hash($data) === $this->hash);
    }
    public static function importFromJson(stdClass $json):CryptoHash{

        $hash = new CryptoHash('');
        $hash->data = $json->data;
        $hash->hash = $json->hash;

        return $hash;
    }
    #[Pure] public static function get(string $data):CryptoHash{

        $hash = new CryptoHash('');
        $hash->data = $data;
        $hash->hash = self::hash($data);

        return $hash;
    }
    public static function hash(string $data):string{

        return hash(self::$algo, $data);
    }
}
