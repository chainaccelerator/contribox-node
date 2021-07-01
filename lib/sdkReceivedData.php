<?php

class SdkReceivedData extends SdkReceived{

    public static int $code = 0;
    public static string $message = '';
    public static array $peerList = [];

    public stdClass $conf;

    public static function run():void {

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData);
        Conf::$env = $data->route->env;
        $r = new SdkReceivedData();
        $r->conf = json_decode(file_get_contents('../' . Conf::$env . '/conf/contribox/conf.json'));

        SdkReceived::peerListMerge($data->peerList);

        if((time() - $data->timestamp) > SdkRequest::$timeout){

            SdkReceived::$message = 'timeout';
            SdkReceived::$code =  605;
            $r->err();
        }
        if($data->version !== SdkRequestRoute::$version) {

            SdkReceived::$message = 'bad version';
            SdkReceived::$code =  606;
            $r->err();
        }
        $pow = new CryptoPow($data->data, $data->timestamp);

        if($pow->powVerify($pow->nonce) === false) {

            SdkReceived::$message = 'bad nonce';
            SdkReceived::$code =  607;
            $r->err();
        }
        switch ($data->method) {

            case 'dataPush':

                $r->dataPush($data);
                break;
            default:

                SdkReceived::$message = 'bad method';
                SdkReceived::$code =  607;
                $r->err();
                break;
        }
        $r->send();
    }
    public function dataPush(stdClass $data):bool{

        $data->data;
        $data->file;
        $data->lasthash;
        $data->hashRoot;

        return true;
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
    "timestamp": '.time().',
    "peerList": '.json_encode(self::$peerList).',
    "version": "v0",
    "result": {
        "state": '.$state.',
        "result": {
            "data": ""
        }
    }
}';
        exit();
    }
}

