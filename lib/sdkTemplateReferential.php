<?php

class SdkTemplateReferential {

    public string $type;

    public function __construct(){

        $class = get_called_class();
        $type = $class::$name;
        $this->type =$type;
    }

    public function conditionHtml(string $o = ''): string {

        $c = get_called_class();

        foreach($c::$templateList as $template){

            $o = '<option selected value="'.$template.'">'.$template.'</option>';
        }
        return '
<br>
<br>
<h4>'.$this->type.'</h4>
<input type="checkbox" name="state'.$this->type.'"> Using with the definition <select name="definition'.$this->type.'">'.$o.'</select>';
    }
    public function definitionJs(): string {

        return SdkHtml::definitionJs($this->type, $this);
    }
}
