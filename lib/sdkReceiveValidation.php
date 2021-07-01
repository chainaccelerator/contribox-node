<?php

class SdkReceiveValidation {

    public static int $timeout = 0;
    public array $txList = [];
    public array $signList = [];

    public function __construct(stdClass $data){

        $this->txList = $data->txList;
        $this->signList = $data->signList;
    }
    public function ask():bool{

        foreach($this->signList as $xpub) {

            $dir = '../'.Conf::$env.'/conf/data/contribox/contribution/'.$xpub;

            if(is_dir($dir) === false) mkdir($dir);

            $file = $dir.'/'.SdkReceived::$request->pow->hash.'.'.time();

            $this->multicast($file, SdkReceived::$route);
        }
        foreach($this->txList as $tx) {

            $tx->hash = SdkReceived::$request->pow->hash;

            foreach($tx->toXpubHashSig as $xpub) {

                $dir = '../' . Conf::$env . '/conf/data/contribox/reward/'.$xpub;

                if (is_dir($dir) === false) mkdir($dir);

                $file = $dir . '/' . SdkReceived::$request->pow->hash.'.'.time();

                $this->multicast($file, json_encode($tx));
            }
            foreach($tx->fromXpubHashSigList as $xpub) {

                $dir = '../' . Conf::$env . '/conf/data/contribox/reward/'.$xpub;

                if (is_dir($dir) === false) mkdir($dir);

                $file = $dir . '/' . SdkReceived::$request->pow->hash.'.'.time();

                $this->multicast($file, json_encode($tx));
            }
        }
        return true;
    }
    public function multicast(string $file, string $data){

        $file = '../' . Conf::$env . '/conf/data/lastHash.hash';
        $lasthash = file_get_contents($file);
        $res = array();

        foreach(SdkReceived::$peerList->apiData as $peer) {

            if($peer->connect !== '') {

                $url = $peer->connect;
                $d = new stdClass();
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

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($d));
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 1);

                $response = curl_exec($ch);

                if (curl_errno($ch)) {
                    echo curl_error($ch);
                    die();
                }

                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if($http_code == intval(200)){
                    echo "Ressource valide";
                }
                else{
                    echo "Ressource introuvable : " . $http_code;
                }

                if($result->state === false) continue;

                if(isset($res[$result->result->data->hashRoot]) === false) $res[$result->result->data->hashRoot] = 0;

                $res[$result->result->data->hashRoot]++;

                SdkReceived::peerListMerge($result->peerList);
            };
        }
        file_put_contents($file, max($res));
    }
}