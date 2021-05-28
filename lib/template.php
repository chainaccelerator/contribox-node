<?php

class Template {

    public array $sigList = array();
    public array $userList = array();
    public array $orgList = array();
    public CryptoHash $transactionHash;
    public Template $previous;
}