<?php

class SdkHtml {

    public static function definitionJs(string $name, $obj): string {

        $cp = new stdClass();
        $cp->vars = $obj;
        $cp->consts = new stdClass();
        $class = get_class($obj);

        foreach (get_class_vars($class) as $name => $default) {

            if (isset($class::$$name)) {

                $cp->consts->$name = $class::$$name;
            }
        }
        return 'var ' . $name . ' = ' . json_encode($cp) . ';';
    }
    public static function optionHtml(array $tab, string $value = ''): string {

        $optionHtml = '';

        foreach ($tab as $elm) {

            $selected = '';

            if ($elm === $value) $selected = ' selected';

            $optionHtml .= '<option value="' . $elm . '"' . $selected . '>' . $elm . '</option>';
        }
        return $optionHtml;
    }
    public static function optionHtmlMultiple(array $tab, array $value = []): string {

        $optionHtml = '<option>None</option>';

        foreach ($tab as $elm) {

            $selected = '';
            $elm = $elm->wallet_name;

            if (in_array($elm, $value) === true) $selected = ' selected';

            $optionHtml .= '<option value="' . $elm . '"' . $selected . '>' . $elm . '</option>';
        }
        return $optionHtml;
    }
    public static function checkboxHtml(string $name, bool $value) {

        $checked = '';

        if ($value === true) $checked = ' checked';

        return '<input type="checkbox" name="' . $name . '" ' . $checked . '>';
    }
}