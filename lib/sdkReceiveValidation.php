<?php

class SdkReceiveValidation {

    public static int $timeout = 10800;
    public array $txList = [];
    public array $signList = [];

    public function __construct(stdClass $data){

        $this->txList = $data->txList;
        $this->signList = $data->signList;
    }
    public function ask():bool{

        $file = SdkReceived::$request->pow->hash.'.'.time();

        foreach($this->signList as $xpub) {

            $res = $this->multicast($file, SdkReceived::$route, 'contribution', $xpub);

            if($res === false) return false;
        }
        foreach($this->txList as $tx) {

            $tx->hash = SdkReceived::$request->pow->hash;
            $data = json_encode($tx);
            $file2 = $file.'.'.CryptoHash::hash($data);

            foreach($tx->toXpubHashSig as $xpub) {

                $res = $this->multicast($file2, $data, 'reward', $xpub);

                if($res === false) return false;
            }
            foreach($tx->fromXpubHashSigList as $xpub) {

                $res = $this->multicast($file2, $data, 'reward', $xpub);

                if($res === false) return false;
            }
        }
        return true;
    }
    public function multicast(string $file, string $data, string $type, string $xpub):bool{

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
                $d->type = $type;
                $d->data = $data;
                $d->pow = new CryptoPow($d->data, $d->timestamp);
                $d->pow->pow();
                $d->file = $file;
                $d->xpub = $xpub;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($d));
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 1);

                $result = curl_exec($ch);

                if (curl_errno($ch)) continue;
                if ($result->status === false) continue;

                $pow = new CryptoPow($result->result->hash, $result->timestamp);

                if($pow->powVerify($result->pow->nonce) === false) continue;

                if (isset($res[$result->data->hash]) === false) $res[$result->data->hash] = 0;

                $res[$result->result->data->hash]++;

                SdkReceived::peerListMerge($result->peerList);
            };
        }
        $file = '../' . Conf::$env . '/conf/data/lastHash.hash';
        file_put_contents($file, max($res));

        return true;
    }
}