<?php

class ApiPeer {

    public string $host = '';
    public string $ip = '';
    public int $ping = 0;
    public bool $data = false;
    public bool $certOnMainchain = false;
    public bool $block = false;
    public CryptoHash $hash;
}