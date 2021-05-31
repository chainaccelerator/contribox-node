<?php

class SdkTemplateType {

    public static array $patterns = ['none', 'any', 'all', '1'];
    public array $pubList = [];
    public string $type;
    public string $pattern = 'any';
    public bool $patternAfterTimeout = true;
    public int $patternAfterTimeoutN = 300;
    public bool $patternBeforeTimeout = false;
    public int $patternBeforeTimeoutN = 1;
    public int $amountBTCMin = 0;
    public string $amountBTCMinFrom = 'Genesis';
    public bool $state = true;
    public array $htmlFieldsId = array();
    public string $htmlScript = '';

    public function __construct(array $pubList = [], string $pattern = 'any', bool $patternAfterTimeout = true, int $patternAfterTimeoutN = 300, bool $patternBeforeTimeout = false, int $patternBeforeTimeoutN = 1, int $amountBTCMin = 0){

        $class = get_called_class();
        $type = $class::$name;

        for($i=1;$i<100;$i++){
            $class::$patterns[] = ((string) $i).'%';
        }
        $this->type =$type;
        $this->pubList = $pubList;
        $this->pattern = $pattern;
        $this->patternAfterTimeout = $patternAfterTimeout;
        $this->patternAfterTimeoutN = $patternAfterTimeoutN;
        $this->patternBeforeTimeout = $patternBeforeTimeout;
        $this->patternBeforeTimeoutN = $patternBeforeTimeoutN;
        $this->amountBTCMin = $amountBTCMin;
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
    public function conditionHtml(array $pubList = array()): string {

        $optionPatterns = SdkHtml::optionHtml(self::$patterns, $this->pattern);
        $optionPubKeys = '<option selected>None</option>';

        if($this->type !== 'from') {

            $optionPubKeys = SdkHtml::optionHtmlMultiple($pubList, $this->pubList);
        }
        $checkboxState = SdkHtml::checkboxHtml('state'.$this->type, $this->state);
        $checkboxPatternAfterTimeout = SdkHtml::checkboxHtml('patternAfterTimeout'.$this->type, $this->patternAfterTimeout);
        $checkboxPatternBeforeTimeout = SdkHtml::checkboxHtml('patternBeforeTimeout'.$this->type, $this->patternBeforeTimeout);
        $this->htmlFieldsId = [
            $this->type
        ];
        $this->htmlScript = 'Template.prototype.'.$this->type.'GetDataFromForm = function(){

    this.'.$this->type.'.publickeyList = document.getElementById("publickeyList'.$this->type.'").value;
    this.'.$this->type.'.pattern = document.getElementById("pattern'.$this->type.'").value;
    this.'.$this->type.'.patternAfterTimeoutN = document.getElementById("patternAfterTimeoutN'.$this->type.'").value;
    this.'.$this->type.'.patternBeforeTimeoutN = document.getElementById("patternBeforeTimeoutN'.$this->type.'").value;
    this.'.$this->type.'.amountBTCMin = document.getElementById("amountBTCMin'.$this->type.'").value;
    this.'.$this->type.'.amountBTCMinFrom = document.getElementById("amountBTCMinFrom'.$this->type.'").value;
    this.'.$this->type.'.state = document.getElementById("state'.$this->type.'").value;
    this.'.$this->type.'.patternAfterTimeout = document.getElementById("patternAfterTimeout'.$this->type.'").value;
    this.'.$this->type.'.patternBeforeTimeout = document.getElementById("patternBeforeTimeout'.$this->type.'").value;
}';

        return '
<br>
<h4>'.$this->type.'</h4>
'.$checkboxState.' Using<br><br> 
<select name="publickeyList'.$this->type.'" multiple>'.$optionPubKeys.'</select> signers with 
<select name="pattern'.$this->type.'">'.$optionPatterns.'</select> required <br><br>
'.$checkboxPatternAfterTimeout.' after <input type="number" value="'.$this->patternAfterTimeoutN.'" min="1" name="patternAfterTimeoutN'.$this->type.'"> bloc(s) timeout<br><br>
'.$checkboxPatternBeforeTimeout.' before <input type="number" value="'.$this->patternBeforeTimeoutN.'" min="1" name="patternBeforeTimeoutN'.$this->type.'"> bloc(s) timeout<br><br>
<input type="number" name="amountBTCMin'.$this->type.'" value="'.$this->amountBTCMin.'"> Project-BTC rewards,<br><br> 
paid by (if other than From) <input type="text" name="amountBTCMinFrom'.$this->type.'" value="'.$this->amountBTCMinFrom.'"><br>
';
    }
    public function definitionJs(): string {

        return SdkHtml::definitionJs($this->type, $this);
    }
}