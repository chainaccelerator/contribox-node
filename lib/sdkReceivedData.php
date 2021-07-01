<?php

class SdkReceivedData extends SdkReceived{

    public static int $code = 0;
    public static string $message = '';

    public static array $peerList = [];
    public static SdkRequest $request;

    public stdClass $conf;

    public static function run():void {

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData);
        Conf::$env = $data->route->env;
        $r = new SdkReceivedData();
        $r->conf = json_decode(file_get_contents('../' . Conf::$env . '/conf/contribox/conf.json'));

        SdkReceived::peerListMerge($data->peerList);

        /*
        $d->id = uniqid();
                $d->timestamp = time();
                $d->peerList = SdkReceived::$peerList;
                $d->version = 'v0';
                $d->method = 'dataPush';
                $d->data = $data;
                $d->pow = new CryptoPow($d->data, $d->timestamp);
                $d->pow->pow();
                $d->file = $file;
                $d->lasthash = $lasthash;
                $d->hashRoot = CryptoHash::hash($lasthash.$data);

        */

        $r->send();
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

