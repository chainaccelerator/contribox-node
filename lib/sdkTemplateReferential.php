<?php

class SdkTemplateReferential {

    public string $type;
    public string $htmlScript = '';
    public array $htmlFieldsId = array();

    public function __construct(){

        $class = get_called_class();
        $type = $class::$name;
        $this->type =$type;
    }

    public function conditionHtml(string $o = ''): string {


        $t = glob('../'.Conf::$env.'/data/validation/*.json');
        $optionsValidation = '';

        foreach($t as $f) {

            $j = json_decode(file_get_contents($f));

            $optionsValidation.= '<option name="'.$j->name.'">'.$j->name.'</option>';
        }
        $this->htmlFieldsId = [
            'state'.$this->type,
            'definition'.$this->type
        ];
        $this->htmlScript = 'Template.prototype.'.$this->type.'GetDataFromForm = function(){

    this.'.$this->type.'.state = document.getElementsByName("state'.$this->type.'")[0].value;
    
    if(this.'.$this->type.'.state == "pn") this.'.$this->type.'.state = true;
    else  this.'.$this->type.'.state = false;
    
    this.'.$this->type.'.definition = document.getElementsByName("definition'.$this->type.'")[0].value;    
    this.'.$this->type.'.type = "";
}';
        return '
<br>
<br>
<h4>'.$this->type.'</h4>
<input type="checkbox" name="state'.$this->type.'"> Using with the definition 
<select name="definition'.$this->type.'">'.$optionsValidation.'</select>
';
    }
}
