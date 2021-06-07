<?php

class SdkTransaction {

    public int $amount = 0;
    public SdkTemplateTypeFrom $from;
    public SdkTemplateTypeTo $to;
    public string $proof = '{data: "", version: "v0"}';
    public string $user = '{data: "", version: "v0"}';
    public bool $proofSharing = false;
    public bool $userProofSharing = false;
    public string $template = '';
    public array $htmlFieldsId = array();
    public string $htmlScript = '';
    public bool $patternAfterTimeout = false;
    public int $patternAfterTimeoutN = 0;
    public bool $patternBeforeTimeout = false;
    public int $patternBeforeTimeoutN = 0;
    public string $type = '';

    public function __construct(SdkTemplateTypeFrom $from, SdkTemplateTypeTo $to, string $template = '', int $amount = 0, string $proof = '{data: "", version: "v0"}', string $user = '{data: "", version: "v0"}'){

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
            'proofSharing',
            'user',
            'userProofSharing',
            'patternAfterTimeout',
            'patternAfterTimeoutN',
            'patternBeforeTimeout',
            'patternBeforeTimeoutN',
            'type'
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
Transaction.prototype.createTransaction = function () {
    
}
';

        $c = get_class($this);
        file_put_contents('js/'.$c.'.js', $this->htmlScript);

        return '
<label for="from">From addresses</label> <select name="from" multiple>'.$optionsFrom.'</select><br><br>
<label for="to">To addresses</label> <select name="to" multiple>'.$optionsTo.'</select><br><br>
<label for="template">Template</label> <select name="template" id="Template"></select><br><br>
<label for="amount">For</label> <input type="number" name="amount" min="0" value="'.$this->amount.'"> BTC<br><br>
<label for="proof">Proof</label> <textarea name="proof">'.$this->proof.'</textarea><br><br>
<input type="checkbox" name="proofSharing"> Proof sharing<br><br>
<input type="checkbox" name="userProofSharing"> User proof sharing<br><br>
<input type="checkbox" name="patternBeforeTimeout"> before <input name ="patternBeforeTimeoutN" type="number" value="1"> bloc(s) timeout<br><br>
<input type="checkbox" name="patternAfterTimeout"> after <input name ="patternAfterTimeoutN" type="number" value="300"> bloc(s) timeout<br><br>
';
    }
}