<?php

class SdkReceiveValidation {

    public static int $timeout = [];
    public array $txList = [];
    public array $signList = [];

    public function __construct(stdClass $data){

        $this->txList = $data->txList;
        $this->signList = $data->signList;
    }
    public function ask():bool{

        foreach($this->signList as $xpubHash) {

            $dir = '../'.Conf::$env.'/conf/data/contribox/contribution/'.$xpubHash;

            if(is_dir($dir) === false) mkdir($dir);

            $file = $dir.'/'.SdkReceived::$request->pow->hash.'.'.time();

            if(is_file($file) === false) {

                file_put_contents($file, SdkReceived::$route);
            }
        }
        foreach($this->txList as $tx) {

            foreach($tx->toXpubHashSig as $xpub) {

                $dir = '../' . Conf::$env . '/conf/data/contribox/reward/to/'.$xpub;

                if (is_dir($dir) === false) mkdir($dir);

                $file = $dir . '/' . SdkReceived::$request->pow->hash.'.'.time();

                if(is_file($file) === false) {

                    file_put_contents($file, json_encode($tx));
                }
            }
            foreach($tx->fromXpubHashSigList as $xpub) {

                $dir = '../' . Conf::$env . '/conf/data/contribox/reward/from/'.$xpub;

                if (is_dir($dir) === false) mkdir($dir);

                $file = $dir . '/' . SdkReceived::$request->pow->hash.'.'.time();

                if(is_file($file) === false) {

                    file_put_contents($file, json_encode($tx));
                }
            }
        }
        return true;
    }
    public function multicast(string $file, string $data){

        $file = '../' . Conf::$env . '/conf/data/contribox/lastHash.hash';
        $lasthash = file_get_contents($file);
        $res = array();

        foreach(SdkReceived::$peerList->apiData as $peer) {

            if($peer->connect !== '') {

                $url = $peer->connect;
                $d = new stdClass();
                $d->id = uniqid();
                $d->version = 'v0';
                $d->method = 'dataPush';
                $d->data = $data;
                $d->file = $file;
                $d->lasthash = $lasthash;
                $d->hashRoot = CryptoHash::hash($lasthash . $data);

                if($result->state === false) continue;

                if(isset($res[$result->result->data->hashRoot]) === false) $res[$result->result->data->hashRoot] = 0;

                $res[$result->result->data->hashRoot]++;


            }
            SdkReceived::$peerList = array_merge(SdkReceived::$peerList, $result->peerList);
            file_get_contents('../' . Conf::$env . '/conf/peerList.json', json_encore(SdkReceived::$peerList));
        }
        file_put_contents($file, max($res));
    }
}