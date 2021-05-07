<?php

require_once 'lib/_require.php';

$BC_ENV='regtest';
new Conf($BC_ENV);

$args = $argsString = $BC_ENV . ' ' . Conf::$BITCOIN_BLOCK_PARTICIPANT_NUMBER. ' "' . Conf::BITCOIN_PEG_PARTICIPANT_NUMBER . '" "' . Conf::BLOCK_PARTICIPANT_NUMBER . '" "' . Conf::$BC_CONF_DIR . '"';
$script = pegBlockAddressesInfo;
$result = Conf::scriptRun();

echo nl2br($result);


