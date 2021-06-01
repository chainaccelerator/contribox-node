<?php

class SdkTransaction {

    public int $amount = 0;
    public array $from = [];
    public array $to = [];
    public string $template = '';
    public string $proof = '{data: "", version: "v0"}';
    public string $user = '{data: "", version: "v0"}';
    public string $proofEncryptionKey = '';
    public string $userEncryptionKey = '';
    public array $htmlFieldsId = array();
    public string $htmlScript = '';

    public function __construct(array $from = [], array $to = [], string $template = '', int $amount = 0, string $proof = '{data: "", version: "v0"}', string $user = '{data: "", version: "v0"}'){

        $this->from = $from;
        $this->to = $to;
        $this->template = $template;
        $this->amount = $amount;
        $this->proof = $proof;
        $this->user = $user;
    }

    public function conditionHtml(array $listFrom = array(), array $listTo = array()){

        $optionsFrom = sdkHtml::optionHtmlMultiple($listFrom);
        $optionsTo = sdkHtml::optionHtmlMultiple($listTo);
        $this->htmlFieldsId = [
            'from',
            'to',
            'template',
            'amount',
            'proof',
            'proofEncryptionKey',
            'user',
            'userEncryptionKey'
        ];
        $function = '';
        $function1 = '';
        $function2 = '';

        foreach($this->htmlFieldsId as $id){

            $function .= 'this.'.$id.' = document.getElementsByName("'.$id.'")[0].value;'."\n";
            $function1 .= $id.' = '.json_encode($this->$id).', ';
            $function2 .= 'this.'.$id.' = '.$id.';'."\n";
        }
        $this->htmlScript = 'function Transaction('.substr($function1, 0,-2).'){

            '.$function2.'
}
Transaction.prototype.getDataFromForm = function () {

    '.$function.'
}
';

        return '
<label for="from">From addresses</label> <select name="from" multiple>'.$optionsFrom.'</select><br><br>
<label for="to">To addresses</label> <select name="to" multiple>'.$optionsTo.'</select><br><br>
<label for="template">Template</label> <select name="template" id="Template"></select><br><br>
<label for="amount">For</label> <input type="number" name="amount" min="0" value="'.$this->amount.'"> BTC<br><br>
<label for="proof">Proof</label> <textarea name="proof">'.$this->proof.'</textarea><br><br>
<label for="proofEncryptionKey">Proof encryption key</label> <input name="proofEncryptionKey" value="'.$this->proofEncryptionKey.'"><br><br>
<label for="user">User</label> <textarea name="user">'.$this->user.'</textarea><br><br>
<label for="userEncryptionKey">User encryption key</label> <input name="userEncryptionKey" value="'.$this->userEncryptionKey.'">';
    }
}