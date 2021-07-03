<?php

class SdkReceivedData extends SdkReceived{

    public static int $code = 0;
    public static string $message = '';
    public static array $peerList = [];

    public stdClass $conf;
    public stdClass $data;
    public string $hash = '';

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

        if($pow->powVerify($data->nonce) === false) {

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
        if(strstr('.', $data->xpub) ) {

            self::$code = 612;
            self::$message = 'Bad xpub';
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
        $this->hash = $hash;

        return true;
    }
    public function send(bool $state = true):void {

        header('Content-Type: application/json');

        $pow = new CryptoPow($this->hash, mktime());
        $pow->pow();

        echo '{
    "peerList": '.json_encode(self::$peerList).',
    "timestamp": '.time().',
    "version": "v0",
    "pow": '.$pow.',
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

