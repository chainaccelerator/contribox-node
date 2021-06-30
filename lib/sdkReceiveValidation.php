<?php

class SdkReceiveValidation {

    public array $txList = [];
    public array $signList = [];

    public function __construct(array $txList = [], array $signList = []){

        $this->txList = $txList;
        $this->signList = $signList;
    }
}