<?php

class Wallet{

    public string $selfchain = '';
    public string $wallet_name = '';
    public string $pubKey_name = '';
    public string $pubAddress = '';
    public string $pubKey = '';
    public string $rpcUser = '';
    public string $addressType = '';
    public string $rpcPassword = '';
    public string $rpcBind = '';
    public string $rpcPort = '';
    public string $env = '';
    public int $nodeInstance = 0;
    public int $walletInstance = 0;
    public string $chain = '';
    public string $apiBind = '';
    public string $api_port = '';

    public static function construct_from_file(string $file, string $selfchain): Wallet{

        $c2 = file_get_contents($file);
        $c2 = json_decode($c2);
        $peer = new Wallet();
        $peer->selfchain = $selfchain;
        $peer->wallet_name = $c2->wallet_name;
        $peer->pubKey_name = $c2->pubKey_name;
        $peer->pubAddress = $c2->pubAddress;
        $peer->pubKey = $c2->pubKey;
        $peer->addressType = $c2->addressType;
        $peer->rpcUser = $c2->rpcUser;
        $peer->rpcPassword = $c2->rpcPassword;
        $peer->rpcBind = $c2->rpcBind;
        $peer->rpcPort = $c2->rpcPort;
        $peer->env = $c2->env;
        $peer->nodeInstance = (int)$c2->nodeInstance;
        $peer->walletInstance = (int)$c2->walletInstance;
        $peer->addressType = $c2->addressType;
        $peer->chain = $c2->chain;
        $peer->apiBind = $c2->apiBind;
        $peer->api_port = $c2->apiPort;

        return $peer;
    }
}