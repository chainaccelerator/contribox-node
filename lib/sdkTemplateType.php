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

        $class = get_called_class();
        $type = $class::$name;
        $store = 'shared';
        $path = '/var/www/contribox-node/'.Conf::$env.'/conf/'.$store.'/e_'.$type.'_regtest_cli1_wallet*.json';
        $fileList = glob($path);

        foreach($fileList as $file) {

            $data = json_decode(file_get_contents($file));
            $res[] = $data;
        }
        return $res;
    }
    public function conditionHtml(array $xpubList = array(), string $optionPubKeys = ''): string {

        $c = get_called_class();
        $optionPatterns = SdkHtml::optionHtml(self::$patterns, $this->pattern);

        if($this->type !== 'from') {

            $optionPubKeys = SdkHtml::optionHtmlMultiple($xpubList, $this->xpubList);
        }
        $checkboxState = SdkHtml::checkboxHtml('state'.$this->type, $this->state);
        $checkboxProof = SdkHtml::checkboxHtml('proof'.$this->type, $this->state);
        $checkboxUser = SdkHtml::checkboxHtml('user'.$this->type, $this->state);
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
        this.'.$this->type.'.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutN'.$this->type.'")[0].value;
        this.'.$this->type.'.amount = document.getElementsByName("amount'.$this->type.'")[0].value;
        this.'.$this->type.'.from = document.getElementsByName("from'.$this->type.'")[0].value;
        this.'.$this->type.'.state = document.getElementsByName("state'.$this->type.'")[0].value;
        this.'.$this->type.'.patternAfterTimeout = document.getElementsByName("patternAfterTimeout'.$this->type.'")[0].value;
        
        if(this.'.$this->type.'.patternAfterTimeout == "on") this.'.$this->type.'.patternAfterTimeout = true;
        else this.'.$this->type.'.patternAfterTimeout = false;
        
        this.'.$this->type.'.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeout'.$this->type.'")[0].value;  
        
        if(this.'.$this->type.'.patternBeforeTimeout == "on") this.'.$this->type.'.patternBeforeTimeout = true;
        else this.'.$this->type.'.patternBeforeTimeout = false;
        
        this.'.$this->type.'.proof = document.getElementsByName("proof'.$this->type.'")[0].value;
                
        if(this.'.$this->type.'.proof == "on") this.'.$this->type.'.proof = true;
        else this.'.$this->type.'.proof = false;
        
        this.'.$this->type.'.user = document.getElementsByName("user'.$this->type.'")[0].value;
                
        if(this.'.$this->type.'.user == "on") this.'.$this->type.'.user = true;
        else this.'.$this->type.'.user = false;
        
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
<input type="number" name="amount'.$this->type.'" value="'.$this->amount.'"> Project-BTC rewards,<br><br> 
paid by (if other than From) <input type="text" name="from'.$this->type.'" value="'.$this->from.'"><br><br> 
'.$checkboxProof.' Proof sharing<br><br>
'.$checkboxUser.' User proof sharing<br><br>
';
    }
}