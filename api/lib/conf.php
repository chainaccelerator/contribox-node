<?php

class Conf {

    static public string $HOST_IP = '';
    static public string $API_PORT = '';
    static public string $EXTERNAL_IP = '';
    static public string $BC_USER = '';
    static public string $BC_WEB_ROOT_DIR = '';
    static public string $BC_GIT_INSTALL = '';
    static public string $BITCOIN_VERSION = '';
    static public string $ELEMENTS_VERSION = '';
    static public string $PORT_PREFIX_SERVER = '';
    static public string $PORT_PREFIX_RPC = '';
    static public string $BC_SERVER_DIR = '';
    static public string $BC_APP_ROOT_DIR = '';
    static public string $BC_SCRIPT_DIR = '';
    static public string $BC_APP_DIR = '';
    static public string $BC_CONF_DIR = '';
    static public int $BC_RIGHTS_FILES = 0;
    static public int $NUMBER_NODES = 0;
    static public int $BACKUP_PARTICIPANT_NUMBER = 0;
    static public int $WITNESS_PARTICIPANT_NUMBER = 0;
    static public int $LOCK_PARTICIPANT_NUMBER = 0;
    static public int $PEG_PARTICIPANT_NUMBER = 0;
    static public int $BLOCK_PARTICIPANT_NUMBER = 0;
    static public int $PEG_SIGNER_AMOUNT = 0;
    static public int $BLOCK_SIGNER_AMOUNT = 0;
    static public int $NODE_AMOUNT = 0;
    static public int $NODE_INITIAL_AMOUNT = 0;
    static public int $BACKUP_AMOUNT = 0;
    static public int $WITNESS_AMOUNT = 0;
    static public int $LOCK_AMOUNT = 0;
    static public int $PEG_AMOUNT = 0;
    static public int $BLOCK_AMOUNT = 0;
    static public int $BLOCK_PARTICIPANT_MAX = 0;
    static public int $BLOCK_PARTICIPANT_MIN = 0;
    static public int $PEG_PARTICIPANT_MAX = 0;
    static public int $PEG_PARTICIPANT_MIN = 0;
    static public int $BITCOIN_MAIN_PARTICIPANT_NUMBER = 0;
    static public int $BITCOIN_PEG_PARTICIPANT_NUMBER = 0;
    static public int $BITCOIN_BLOCK_PARTICIPANT_NUMBER = 0;

    public function _construct(string $bc_env):void{

        $d = file_get_contents('../' . $bc_env . '/conf/conf.json');
        $d = json_decode($d);
        self::$HOST_IP = $d->HOST_IP;
        self::$API_PORT = $d->API_PORT;
        self::$EXTERNAL_IP = $d->EXTERNAL_IP;
        self::$BC_USER = $d->BC_USER;
        self::$BC_RIGHTS_FILES = $d->BC_RIGHTS_FILES;
        self::$BC_WEB_ROOT_DIR = $d->BC_WEB_ROOT_DIR;
        self::$BC_GIT_INSTALL = $d->BC_GIT_INSTALL;
        self::$BITCOIN_VERSION = $d->BITCOIN_VERSION;
        self::$ELEMENTS_VERSION = $d->ELEMENTS_VERSION;
        self::$PORT_PREFIX_SERVER = $d->PORT_PREFIX_SERVER;
        self::$PORT_PREFIX_RPC = $d->PORT_PREFIX_RPC;
        self::$BC_SERVER_DIR = $d->BC_SERVER_DIR;
        self::$NUMBER_NODES = $d->NUMBER_NODES;
        self::$BACKUP_PARTICIPANT_NUMBER = $d->BACKUP_PARTICIPANT_NUMBER;
        self::$WITNESS_PARTICIPANT_NUMBER = $d->WITNESS_PARTICIPANT_NUMBER;
        self::$LOCK_PARTICIPANT_NUMBER = $d->LOCK_PARTICIPANT_NUMBER;
        self::$PEG_PARTICIPANT_NUMBER = $d->PEG_PARTICIPANT_NUMBER;
        self::$BLOCK_PARTICIPANT_NUMBER = $d->BLOCK_PARTICIPANT_NUMBER;
        self::$PEG_SIGNER_AMOUNT = $d->PEG_SIGNER_AMOUNT;
        self::$BLOCK_SIGNER_AMOUNT = $d->BLOCK_SIGNER_AMOUNT;
        self::$NODE_AMOUNT = $d->NODE_AMOUNT;
        self::$BACKUP_AMOUNT = $d->BACKUP_AMOUNT;
        self::$WITNESS_AMOUNT = $d->WITNESS_AMOUNT;
        self::$LOCK_AMOUNT = $d->LOCK_AMOUNT;
        self::$PEG_AMOUNT = $d->PEG_AMOUNT;
        self::$BLOCK_AMOUNT = $d->BLOCK_AMOUNT;
        self::$BLOCK_PARTICIPANT_MAX = $d->BLOCK_PARTICIPANT_MAX;
        self::$BLOCK_PARTICIPANT_MIN = $d->BLOCK_PARTICIPANT_MIN;
        self::$PEG_PARTICIPANT_MAX = $d->PEG_PARTICIPANT_MAX;
        self::$PEG_PARTICIPANT_MIN = $d->PEG_PARTICIPANT_MIN;
        self::$BITCOIN_MAIN_PARTICIPANT_NUMBER = $d->BITCOIN_MAIN_PARTICIPANT_NUMBER;
        self::$BITCOIN_PEG_PARTICIPANT_NUMBER = $d->BITCOIN_PEG_PARTICIPANT_NUMBER;
        self::$BITCOIN_BLOCK_PARTICIPANT_NUMBER = $d->BITCOIN_BLOCK_PARTICIPANT_NUMBER;
        self::$BC_APP_ROOT_DIR = $d->BC_APP_ROOT_DIR;
        self::$BC_APP_DIR = $d->BC_APP_DIR;
        self::$BC_CONF_DIR = $d->BC_CONF_DIR;
        self::$BC_SCRIPT_DIR = $d->BC_SCRIPT_DIR;
    }
    public static function scriptRun(string $argsString, string $method): string{

        $script = 'bash ' . Conf::$BC_SCRIPT_DIR . '/' . $method . '.sh ' . $argsString;
        echo $script;
        error_log($script, 0);
        exec($script, $result, $result_code);
        error_log(json_encode($result), 0);
        error_log((string)$result_code, 0);
        return implode('', $result);
    }
}