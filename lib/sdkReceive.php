<?php

class SdkReceived {

    public static int $code = 0;
    public static string $message = '';

    public static array $peerList = [];
    public static SdkRequest $request;
    public static string $route = '';
    public static SdkReceiveValidation $validation;

    public stdClass $conf;
    public string $hash = '';

    public static function run():void {

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData);
        Conf::$env = $data->route->env;
        $r = new SdkReceived();
        $r->data = $data;
        $r->conf = json_decode(file_get_contents('../' . Conf::$env . '/conf/contribox/conf.json'));

        SdkReceived::peerListMerge($data->peerList);

        $r::$request = new SdkRequest();
        $res = $r::$request->init($data, $data->route);

        if ($res == false) $r->err();

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
            $hash = CryptoHash::hash(json_encode($peer));
            self::$peerList[$k]->hash = $hash;
            $hashList[$hash] = $hash;
        }
        foreach($list as $k => $peer){

            $peer->hash = '';
            $hash = CryptoHash::hash(json_encode($peer));
            $peer->hash = $hash;

            if(isset($hashList[$hash]) === false) self::$peerList[] = $peer;
        }
        file_put_contents('../' . Conf::$env . '/conf/peerList.json', json_encode(self::$peerList));

        return true;
    }
    public function getApiPublicKey(){

    }
    public function getApiPrivKey(){

    }
    public function err():void {

        self::send(false);
    }
    public function send(bool $state = true):void {

        header('Content-Type: application/json');
        error_log(self::$code.' '.self::$message);

        $time = time();
        $pow = new CryptoPow($this->data, $time);
        $pow->pow();

        if(get_class($this->data) === 'stdClass') $data = json_encode($this->data);
        else $data = $this->data;

        echo '{
  "peerList": '.json_encode(self::$peerList).',
  "request": {
    "timestamp": '.$time.',
    "pow": '.json_encode($pow).',
  },
  "route": '.json_encode(self::$route).',
  "result": {
    "status": '.$state.',
    "code": '.self::$code.',
    "message": "'.self::$message.'",
    "hash": "'.$this->hash.'",
    "data": '.$data.'
  }
}';
        exit();
    }
}

