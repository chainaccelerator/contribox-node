<?php

class SdkReceivedData extends SdkReceived{

    public static int $code = 0;
    public static string $message = '';
    public static array $peerList = [];

    public stdClass $conf;
    public stdClass $data;

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

        $hash = '';

        foreach(blob('../' . Conf::$env . '/conf/contribox/contribution/*') as $f){

            $d = file_get_contents($f);
            $hash = CryptoHash::hash($hash.CryptoHash::hash($d));
        }
        foreach(blob('../' . Conf::$env . '/conf/contribox/reward/*') as $f){

            $d = file_get_contents($f);
            $hash = CryptoHash::hash($hash.CryptoHash::hash($d));
        }
        $file = '../' . Conf::$env . '/conf/data/lastHash.hash';
        $lastHash = file_get_contents($file);

        if($hash !== $lastHash) {

            self::$code = 610;
            self::$message = 'Hash error';
            $this->err();
        }
        if($data->type !== 'reward' && $data->type !== 'contribution') {

            self::$code = 611;
            self::$message = 'Bad type';
            $this->err();
        }
        $dir = '../'.Conf::$env.'/conf/data/contribox/'.$data->type.'/'.$data->xpub;

        if (is_dir($dir) === false) mkdir($dir);

        $file = $dir . '/'.$data->file;

        file_put_contents($file, $data->data);

        $hash = CryptoHash::hash($hash.CryptoHash::hash($data->data));
        $file = '../' . Conf::$env . '/conf/data/lastHash.hash';

        file_put_contents($file, $hash);

        $this->data = new stdClass();
        $this->data->lastHash = $hash;

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
        "status": '.$state.',
        "code": '.self::$code.',
        "message": "'.self::$message.'",
        "hash": "'.$this->hash.'",
    }
}';
        exit();
    }
}

