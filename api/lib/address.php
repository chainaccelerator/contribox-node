<?php

class Address{

    public string $address = '';
    public string $type = '';
    public string $wallet_name = '';
    public string $wallet_uri = '';
    public string $pubKey_name = '';
    public string $pubAddress = '';
    public string $pubKey = '';
    public string $prvKey = '';
    public string $rpcUser = '';
    public string $rpcPassword = '';
    public string $rpcBind = '';
    public string $rpcPort = '';
    public string $apiBind = '';
    public string $apiPort = '';
    public string $peggedAsset = '';
    public string $env = '';
    public int $nodeInstance = 0;
    public int $walletInstance = 0;
    public string $addressType = '';
    public string $chain = '';
    public string $wallet_nameBitcoin = '';
    public string $wallet_uriBitcoin = '';
    public string $pubAddressBitcoin = '';

    public function addressSet(string $address): void{

        $this->address = $address;
    }

    public function typeSet(string $type): void{

        $this->type = $type;
    }

    public function load(): bool{

        ini_set("error_log", '/var/www/contribox-node/' . Conf::$BC_ENV . '/log/api.log');
        $path = '../' . Conf::$BC_ENV . '/conf/e_' . $this->type . '_' . Conf::$BC_ENV . '_cli*';
        $files = glob($path);

        foreach ($files as $file) {

            $c = file_get_contents($file);
            $c = json_decode($c);

            if ($c->pubAddress === $this->address) {

                $this->wallet_name = $c->wallet_name;
                $this->wallet_uri = $c->wallet_uri;
                $this->pubKey_name = $c->pubKey_name;
                $this->pubAddress = $c->pubAddress;
                $this->pubKey = $c->pubKey;
                $this->prvKey = $c->prvKey;
                $this->rpcUser = $c->rpcUser;
                $this->rpcPassword = $c->rpcPassword;
                $this->rpcBind = $c->rpcBind;
                $this->rpcPort = $c->rpcPort;
                $this->apiBind = $c->apiBind;
                $this->apiPort = $c->apiPort;
                $this->peggedAsset = $c->peggedAsset;
                $this->env = $c->env;
                $this->nodeInstance = (int)$c->nodeInstance;
                $this->walletInstance = (int)$c->walletInstance;
                $this->addressType = $c->addressType;
                $this->chain = $c->chain;
                $this->wallet_nameBitcoin = $c->wallet_nameBitcoin;
                $this->wallet_uriBitcoin = $c->wallet_uriBitcoin;
                $this->pubAddressBitcoin = $c->pubAddressBitcoin;

                return true;
            }
        }
        return false;
    }
}
