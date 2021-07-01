<?php

class SdkReceived {

    public static int $code = 0;
    public static string $message = '';

    public static array $peerList = [];
    public static SdkRequest $request;
    public static string $route;
    public static SdkReceiveValidation $validation;

    public stdClass $conf;

    public static function run():void {

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData);
        Conf::$env = $data->route->env;
        $r = new SdkReceived();
        $r->conf = json_decode(file_get_contents('../' . Conf::$env . '/conf/contribox/conf.json'));

        SdkReceived::peerListMerge($data->peerList);

        $r::$request = new SdkRequest($data, $data->route);

        if ($r::$request == false) $r->err();

        $r::$route = json_encode($data->route);

        if ($r::$route === false) $r->err();

        $r::$validation = new SdkReceiveValidation($data->validation, $r::$route);

        if ($r::$validation == false) $r->err();
        if ($r::$validation->ask() === false) $r->err();

        $r->send();
    }
    public static function peerListMerge(array $list):bool{

        $hashList = [];

        foreach(self::$peerList as $k => $peer){

            $peer->hash = '';
            $hash = CrypoHash::hash(json_encode($peer));
            self::$peerList[$k]->hash = $hash;
            $hashList[$hash] = $hash;
        }
        foreach($list as $k => $peer){

            $peer->hash = '';
            $hash = CrypoHash::hash(json_encode($peer));
            $peer->hash = $hash;

            if(isset($hashList[$hash]) === false) self::$peerList[] = $peer;
        }
        file_put_contents('../' . Conf::$env . '/conf/peerList.json', json_encore(self::$peerList));

        return true;
    }
    public function getApiPublicKey(){

    }
    public function getApiPrivKey(){

    }
    public function err():void {

        self::send(self::$code, self::$message, false);
    }
    public function send(bool $state = true):void {

        header('Content-Type: application/json');

        $pow = new CryptoPow($this->data, mktime());
        $pow->pow();

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

