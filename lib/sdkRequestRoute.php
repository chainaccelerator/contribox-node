<?php

class SdkRequestRoute {

    public string $id = 'default';
    public string $version = '0.1';
    public string $env = 'regtest';
    public string $template;
    public SdkTransaction $transaction;

    public function __construct(string $role = '', string $domain = '', string $domainSub = '', string $process = '', string $processStep = '', string $processStepAction = '', string $about = '', int $amount = 0, bool $blockSignature = false, bool $pegSignature = false, string $version = 'v0', bool $declareAddressFrom = false, bool $declareAddressTo = false, bool $proofEncryption = false, bool $userEncryption = false, array $form = [], array $to = [], string $template = '', string $proof = '{data: "", version: "v0"}', string $user = '{data: "", version: "v0"}'){

        $this->template = $template;
        $this->transaction = new SdkTransaction([], [], $template, $amount, $proof, $user);
    }
}