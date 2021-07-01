<?php

class SdkRequestRoute {

    public string $id = 'default';
    public string $version = '0.1';
    public string $env = 'regtest';
    public string $template = 'default';
    public SdkTransaction $transaction;

    public function __construct(stdClass $data){

        $this->template = $data->route->template;
        $this->id = $data->route->id;
        $this->version = $data->route->version;
        $this->env = $data->route->env;
        $this->transaction = new SdkTransaction($data->route->transaction->from, $data->route->transaction->to, $this->template, $data->route->transaction->amount, $data->route->transaction->proof, $data->route->transaction->user);
    }
}