<?php

class SdkReceived {

    public static int $code = 0;
    public static string $message = '';

    public static array $peerList = [];
    public static SdkRequest $request;
    public static SdkRequestRoute $route;
    public static SdkReceiveValidation $validation;

    public stdClass $conf;

    public static function run():void {

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData);
        Conf::$env = $data->route->env;
        $r = new SdkReceived();
        $r->conf = json_decode(file_get_contents('../' . Conf::$env . '/conf/contribox/conf.json'));
        self::$peerList = array_merge(json_decode(file_get_contents('../' . Conf::$env . '/conf/peerList.json')), $data->peerList);
        $r->request = new SdkRequest($data, $data->route);

        if ($r->request === false) $r->err();

        $r->route = new SdkRequestRoute($data);

        if ($r->route === false) $r->err();

        $r->validation = new SdkReceiveValidation();

        if ($r->validation === false) $r->err();

        $r->send();
    }
    public function getApiPublicKey(){

    }
    public function getApiPrivKey(){

    }
    public function err():void {

        self::send($code, $message, false);
    }
    public function send(bool $state = true):void {

        header('Content-Type: application/json');

        $pow = new CryptoPow($this->data, mktime());
        $pow->pow($this->data, mktime());

        foreach(self::$peerList as $k => $v) {

            if($v->api->connect === $this->conf->IP_HOST) $publicAddress = $v->api->pubAddress;
        }
        $sig = new CryptoSig($publicAddress, '');
        $sig->sig();

        echo '{
  "peerList": '.json_encode(self::$peerList).',
  "request": {
    "timestamp": '.mktime().',
    "pow": '.json_encode($pow).',
    "sig": '.json_encode($sig).'
  },
  "route": '.json_encode($this->route).',
  "result": {
    "status": '.$state.',
    "code": '.$code.',
    "message": "'.$message.'",
    "hash": "'.$this->hash.'",
    "data": "'.json_encode($this->data).'"
  }
}';
        exit();
    }
}

