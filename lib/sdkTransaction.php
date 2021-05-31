<?php

class SdkTransaction {

    public int $amount = 0;
    public array $form = [];
    public array $to = [];
    public string $template = '';
    public string $proof = '{data: "", version: "v0"}';
    public string $user = '{data: "", version: "v0"}';
    public string $proofEncryptionKey = '';
    public string $userEncryptionKey = '';

    public function __construct(array $form = [], array $to = [], string $template = '', int $amount = 0, string $proof = '{data: "", version: "v0"}', string $user = '{data: "", version: "v0"}'){

        $this->form = $form;
        $this->to = $to;
        $this->template = $template;
        $this->amount = $amount;
        $this->proof = $proof;
        $this->user = $user;
    }

    public function conditionHtml(array $listFrom = array(), array $listTo = array()){

        $optionsFrom = sdkHtml::optionHtmlMultiple($listFrom);
        $optionsTo = sdkHtml::optionHtmlMultiple($listTo);

        return '<label for="From">From addresses</label> <select name="from" multiple>'.$optionsFrom.'</select><br><br>
            <label for="To">To addresses</label> <select name="to" multiple>'.$optionsTo.'</select><br><br>
            <label for="Template">Template</label> <select name="Template" id="Template"></select><br><br>
            <label for="amount">For</label> <input type="number" name="amount" min="0" value="'.$this->amount.'"> BTC<br><br>
            <label for="proof">Proof</label> <textarea name="proof">'.$this->proof.'</textarea><br><br>
            <label for="user">Proof encryption key</label> <input name="proofEncryptionKey" value="'.$this->proofEncryptionKey.'">
            <label for="user">User</label> <textarea name="user">'.$this->user.'</textarea><br><br>
            <label for="user">User encryption key</label> <input name="userEncryptionKey" value="'.$this->userEncryptionKey.'">';
    }
}