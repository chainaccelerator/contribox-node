<?php

class SdkRequestRoute {

    public string $id = 'default';
    public string $version = '0.1';
    public string $env = 'regtest';
    public SdkTemplate $template;
    public SdkTransaction $transaction;

    public function __construct(string $role = '', string $domain = '', string $domainSub = '', string $process = '', string $processStep = '', string $processStepAction = '', string $about = '', int $amount = 0, bool $blockSignature = false, bool $pegSignature = false, string $version = 'v0', bool $declareAddressFrom = false, bool $declareAddressTo = false, bool $proofEncryption = false, bool $userEncryption = false, array $form = [], array $to = [], string $template = '', string $proof = '{data: "", version: "v0"}', string $user = '{data: "", version: "v0"}'){

        $this->template = new SdkTemplate($role, $domain, $domainSub, $process, $processStep, $processStepAction, $about, $amount, $blockSignature, $pegSignature, $version, $declareAddressFrom, $declareAddressTo, $proofEncryption, $userEncryption);
        $this->transaction = new SdkTransaction($form, $to, $template, $amount, $proof, $user);
    }
}