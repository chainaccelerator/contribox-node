<?php

require_once 'lib/_require.php';

function infoType(string $env, string $network, string $type):string{

    $prefix=$network.'_a_'.$type.'_';
    $files = glob(Conf::$BC_CONF_DIR.'/'.$prefix.'*');

    foreach($files as $addressFile) {

        $i = json_decode(file_get_contents($addressFile));
        $wallet = $i->wallet_name;
        $cmd = $i->E_CLI_GETWALLETINFO;
        $args = $env.' '.$wallet;
        echo Conf::scriptRun($args, $cmd).'<br>';
    }
    return '';
}

$BC_ENV = 'regtest';
$conf = new Conf($BC_ENV);

infoType($BC_ENV, 'e', 'block');


