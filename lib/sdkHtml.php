<?php

class SdkHtml {

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

        $optionHtml = '<option selected>None</option>';

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