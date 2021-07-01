<?php

class Node{

    public string $selfchain = '';
    public string $hostIp = '';
    public string $externalIp = '';
    public string $addressType = '';
    public string $rpcUser = '';
    public string $rprPassword = '';
    public string $rpcBind = '';
    public string $rpcPort = '';
    public string $env = '';
    public int $nodeInstance = 0;
    public int $walletInstance = 0;
    public string $peggedAsset = '';

    public static function construct_from_file(string $file, string $selfchain): Node{

        $c2 = file_get_contents($file);
        $c2 = json_decode($c2);
        $peer = new Node();

        $peer->selfchain = $selfchain;
        $peer->hostIp = $c2->HOST_IP;
        $peer->externalIp = $c2->EXTERNAL_IP;
        $peer->addressType = $c2->ADDRESS_TYPE;
        $peer->rpcUser = $c2->ELEMENTS_RPC_USER_VAL;
        $peer->rprPassword = $c2->ELEMENTS_RPC_PASSWORD_VAL;
        $peer->rpcBind = $c2->ELEMENTS_RPC_BIND_VAL;
        $peer->rpcPort = $c2->ELEMENTS_RPC_PORT_VAL;
        $peer->env = $c2->env;
        $peer->nodeInstance = (int)$c2->nodeInstance;
        $peer->walletInstance = (int)$c2->walletInstance;
        $peer->addressType = $c2->addressType;
        $peer->peggedAsset = $c2->peggedAsset;

        return $peer;
    }
}