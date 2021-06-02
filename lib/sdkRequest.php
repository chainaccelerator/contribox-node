<?php

class SdkRequest {

    public int $timestamp = 0;
    public array $peerList = [];
    public SdkRequestPow $pow;
    public SdkRequestSig $sig;

    public function __construct(){

        $this->pow = new SdkRequestPow();
        $this->sig = new SdkRequestSig();
    }
}