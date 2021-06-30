<?php

class Conf {

    public static $env = 'regtest';
    public stdClass $context;
    public string $htmlScript = '';

    public function __construct(string $env){

        self::$env = $env;
        ini_set("error_log", '../'.self::$env.'/log/contribox-node-php.log');
    }
    public function conditionHtml():string {

        $this->htmlScript = '
function Conf(){

    this.env = ' . self::$env . ';
    this.context = ' . json_encode($this->context) . '; 
}
';
        $c = get_class($this);
        file_put_contents('js/' . $c . '.js', $this->htmlScript);
        return '';
    }
}