<?php

class Conf {

    public static $env = 'regtest';

    public function __construct(string $env){

        self::$env = $env;
        ini_set("error_log", '../'.self::$env.'/log/contribox-node-php.log');
    }
}