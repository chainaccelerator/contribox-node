<?php

class SdkTemplateType {

    public static array $patterns = ['none', 'any', 'all', '1'];
    public array $xpubList = [];
    public string $type;
    public string $pattern = 'any';
    public bool $patternAfterTimeout = true;
    public int $patternAfterTimeoutN = 300;
    public bool $patternBeforeTimeout = false;
    public int $patternBeforeTimeoutN = 1;
    public int $amount = 0;
    public string $from = 'Genesis';
    public bool $state = true;
    public bool $proofSharing = true;
    public bool $userProofSharing = true;
    public array $htmlFieldsId = array();
    public string $htmlScript = '';

    public function __construct(array $xpubList = [], string $pattern = 'any', bool $patternAfterTimeout = true, int $patternAfterTimeoutN = 300, bool $patternBeforeTimeout = false, int $patternBeforeTimeoutN = 1, int $amount = 0){

        $class = get_called_class();
        $type = $class::$name;

        for($i=1;$i<100;$i++){
            $class::$patterns[$i] = ((string) $i).'%';
        }
        $this->type =$type;
        $this->xpubList = $xpubList;
        $this->pattern = $pattern;
        $this->patternAfterTimeout = $patternAfterTimeout;
        $this->patternAfterTimeoutN = $patternAfterTimeoutN;
        $this->patternBeforeTimeout = $patternBeforeTimeout;
        $this->patternBeforeTimeoutN = $patternBeforeTimeoutN;
        $this->amount = $amount;
    }
    public static function walletsList(array $res = array()): array{

        $cl = get_called_class();
        $c = $cl::$name;
        $af = [];
        if(isset(SdkWallet::$walletsFederation->$c) === true) foreach(SdkWallet::$walletsFederation->$c as $v) $af[] = $v;
        if(isset(SdkWallet::$walletsShare->$c) === true) foreach(SdkWallet::$walletsShare->$c as $v) $af[] = $v;

        foreach($af as $l) $res[] = $l;

        return $res;
    }
    public function conditionHtml(array $xpubList = array(), string $optionPubKeys = ''): string {

        $c = get_called_class();
        $optionPatterns = SdkHtml::optionHtml(self::$patterns, $this->pattern);
        $optionFrom = SdkHtml::optionHtml(["Genesis", "from", "api", "to", "template", "ban", "board", "member", "old", "onboard", "outboard", "cosignerOrg", "witnessOrg", "info", "investorType1", "parentstype1", "childstype1"], "Genesis");

        $optionPubKeys = SdkHtml::optionHtmlMultiple($xpubList, $this->xpubList);
        $checkboxState = SdkHtml::checkboxHtml('state'.$this->type, $this->state);
        $checkboxProof = SdkHtml::checkboxHtml('proofSharing'.$this->type, $this->state);
        $checkboxUser = SdkHtml::checkboxHtml('userProofSharing'.$this->type, $this->state);
        $checkboxPatternAfterTimeout = SdkHtml::checkboxHtml('patternAfterTimeout'.$this->type, $this->patternAfterTimeout);
        $checkboxPatternBeforeTimeout = SdkHtml::checkboxHtml('patternBeforeTimeout'.$this->type, $this->patternBeforeTimeout);
        $this->htmlFieldsId = [
            $this->type
        ];
        $this->htmlScript = 'Template.prototype.'.$this->type.'GetDataFromForm = function(){

        this.'.$this->type.'.xpubList = [];
        let selList= document.getElementsByName("xpubList'.$this->type.'")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.'.$this->type.'.xpubList[i] = selList[i].value;
        }   
        this.'.$this->type.'.pattern = document.getElementsByName("pattern'.$this->type.'")[0].value;
        
        this.'.$this->type.'.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutN'.$this->type.'")[0].value;
        this.'.$this->type.'.patternAfterTimeoutN = parseInt(this.'.$this->type.'.patternAfterTimeoutN);
                        
        this.'.$this->type.'.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutN'.$this->type.'")[0].value;
        this.'.$this->type.'.patternBeforeTimeoutN = parseInt(this.'.$this->type.'.patternBeforeTimeoutN);
        
        this.'.$this->type.'.amount = document.getElementsByName("amount'.$this->type.'")[0].value;
        this.'.$this->type.'.amount = parseInt(this.'.$this->type.'.amount);
        
        this.'.$this->type.'.from = document.getElementsByName("from'.$this->type.'")[0].value;
        
        this.'.$this->type.'.state = document.getElementsByName("state'.$this->type.'")[0].value;
        if(this.'.$this->type.'.state == "on") this.'.$this->type.'.state = true;
        else this.'.$this->type.'.state = false;
        
        this.'.$this->type.'.proofSharing = document.getElementsByName("proofSharing'.$this->type.'")[0].value;
        if(this.'.$this->type.'.proofSharing == "on") this.'.$this->type.'.proofSharing = true;
        else this.'.$this->type.'.proofSharing = false;
        
        this.'.$this->type.'.userProofSharing = document.getElementsByName("userProofSharing'.$this->type.'")[0].value;
        if(this.'.$this->type.'.userProofSharing == "on") this.'.$this->type.'.userProofSharing = true;
        else this.'.$this->type.'.userProofSharing = false;
        
        if(this.'.$this->type.'.patternAfterTimeout == true) this.'.$this->type.'.patternAfterTimeout = true;
        else this.'.$this->type.'.patternAfterTimeout = false;
        
        this.'.$this->type.'.patternAfterTimeout = document.getElementsByName("patternAfterTimeout'.$this->type.'")[0].value;
        
        if(this.'.$this->type.'.patternAfterTimeout == true) this.'.$this->type.'.patternAfterTimeout = true;
        else this.'.$this->type.'.patternAfterTimeout = false;
        
        this.'.$this->type.'.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeout'.$this->type.'")[0].value;  
        
        if(this.'.$this->type.'.patternBeforeTimeout == true) this.'.$this->type.'.patternBeforeTimeout = true;
        else this.'.$this->type.'.patternBeforeTimeout = false;
        
        this.'.$this->type.'.type = "'.$c::$name.'";
}';

        return '
<br>
<h4>'.$this->type.'</h4>
'.$checkboxState.' Using<br><br> 
<select name="xpubList'.$this->type.'" multiple>'.$optionPubKeys.'</select> signers with 
<select name="pattern'.$this->type.'">'.$optionPatterns.'</select> required <br><br>
'.$checkboxPatternBeforeTimeout.' before <input type="number" value="'.$this->patternBeforeTimeoutN.'" min="1" name="patternBeforeTimeoutN'.$this->type.'"> bloc(s) timeout<br><br>
'.$checkboxPatternAfterTimeout.' after <input type="number" value="'.$this->patternAfterTimeoutN.'" min="1" name="patternAfterTimeoutN'.$this->type.'"> bloc(s) timeout<br><br>
<input type="number" name="amount'.$this->type.'" value="'.$this->amount.'"> Project-BTC rewards, paid by <select name="from'.$this->type.'">'.$optionFrom.'</select><br><br> 
'.$checkboxProof.' Proof sharing<br><br>
'.$checkboxUser.' User proof sharing<br><br>
';
    }
}