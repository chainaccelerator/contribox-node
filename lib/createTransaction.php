<?php

class CreateTransaction {

    public string $hashPrevious = '';
    public int $orderSequence = 0;
    public CryptoHash $hash;
    public Template $templateValidation;
    public Template $template;
    public Asset $asset;
}