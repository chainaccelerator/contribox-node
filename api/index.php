<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set("display_errors", "1");
ini_set("log_errors", "1");
ini_set("error_log", "/var/www/contribox-node/api.log");


class Node {

    public string $selfchain = '';
    public string $hostIp = '';
    public string $externalIp = '';
    public string $addressType = '';
    public string $rpcUser = '';
    public string $rprPassword = '';
    public string $rpcBind = '';
    public string $rpcPort = '';
    public string $env = '';
    public int $nodeInstance = 0;
    public int $walletInstance = 0;
    public string $peggedAsset = '';

    public static function construct_from_file(string $file, string $selfchain):Node {

        $c2 = file_get_contents($file);
        $c2 = json_decode($c2);
        $peer = new Node();

        $peer->selfchain = $selfchain;
        $peer->hostIp = $c2->HOST_IP;
        $peer->externalIp = $c2->EXTERNAL_IP;
        $peer->addressType = $c2->ADDRESS_TYPE;
        $peer->rpcUser = $c2->ELEMENTS_RPC_USER_VAL;
        $peer->rprPassword = $c2->ELEMENTS_RPC_PASSWORD_VAL;
        $peer->rpcBind = $c2->ELEMENTS_RPC_BIND_VAL;
        $peer->rpcPort = $c2->ELEMENTS_RPC_PORT_VAL;
        $peer->env = $c2->env;
        $peer->nodeInstance = (int) $c2->nodeInstance;
        $peer->walletInstance = (int) $c2->walletInstance;
        $peer->addressType = $c2->addressType;
        $peer->peggedAsset = $c2->peggedAsset;

        return $peer;
    }
}


class Wallet {

    public string $selfchain = '';
    public string $wallet_name = '';
    public string $pubKey_name = '';
    public string $pubAddress = '';
    public string $pubKey = '';
    public string $rpcUser = '';
    public string $addressType = '';
    public string $rpcPassword = '';
    public string $rpcBind = '';
    public string $rpcPort = '';
    public string $env = '';
    public int $nodeInstance = 0;
    public int $walletInstance = 0;
    public string $chain = '';
    public string $apiBind = '';
    public string $api_port = '';

    public static function construct_from_file(string $file, string $selfchain):Wallet {

        $c2 = file_get_contents($file);
        $c2 = json_decode($c2);
        $peer = new Wallet();

        $peer->selfchain = $selfchain;
        $peer->wallet_name = $c2->wallet_name;
        $peer->pubKey_name = $c2->pubKey_name;
        $peer->pubAddress = $c2->pubAddress;
        $peer->pubKey = $c2->pubKey;
        $peer->addressType = $c2->addressType;
        $peer->rpcUser = $c2->rpcUser;
        $peer->rpcPassword = $c2->rpcPassword;
        $peer->rpcBind = $c2->rpcBind;
        $peer->rpcPort = $c2->rpcPort;
        $peer->env = $c2->env;
        $peer->nodeInstance = (int) $c2->nodeInstance;
        $peer->walletInstance = (int) $c2->walletInstance;
        $peer->addressType = $c2->addressType;
        $peer->chain = $c2->chain;
        $peer->apiBind= $c2->apiBind;
        $peer->api_port= $c2->apiPort;

        return $peer;
    }
}

class Address {

    public string $address = '';
    public string $type = '';
    public string $wallet_name = '';
    public string $wallet_uri = '';
    public string $pubKey_name = '';
    public string $pubAddress = '';
    public string $pubKey = '';
    public string $prvKey = '';
    public string $rpcUser = '';
    public string $rpcPassword = '';
    public string $rpcBind = '';
    public string $rpcPort = '';
    public string $apiBind = '';
    public string $apiPort = '';
    public string $peggedAsset = '';
    public string $env = '';
    public int $nodeInstance = 0;
    public int $walletInstance = 0;
    public string $addressType = '';
    public string $chain = '';
    public string $wallet_nameBitcoin = '';
    public string $wallet_uriBitcoin = '';
    public string $pubAddressBitcoin = '';

    public function addressSet(string $address):void{

        $this->address = $address;
    }
    public function typeSet(string $type):void{

        $this->type = $type;
    }
    public function load(string $bc_env):bool{

        $path = '../'.$bc_env.'/conf/e_'.$this->type.'_'.$bc_env.'_cli*';
        $files = glob($path);

        foreach($files as $file) {

            $c = file_get_contents($file);
            $c = json_decode($c);

            if($c->pubAddress === $this->address) {

                $this->wallet_name = $c->wallet_name;
                $this->wallet_uri = $c->wallet_uri;
                $this->pubKey_name = $c->pubKey_name;
                $this->pubAddress = $c->pubAddress;
                $this->pubKey = $c->pubKey;
                $this->prvKey = $c->prvKey;
                $this->rpcUser = $c->rpcUser;
                $this->rpcPassword = $c->rpcPassword;
                $this->rpcBind = $c->rpcBind;
                $this->rpcPort = $c->rpcPort;
                $this->apiBind = $c->apiBind;
                $this->apiPort = $c->apiPort;
                $this->peggedAsset = $c->peggedAsset;
                $this->env = $c->env;
                $this->nodeInstance = (int) $c->nodeInstance;
                $this->walletInstance = (int) $c->walletInstance;
                $this->addressType = $c->addressType;
                $this->chain = $c->chain;
                $this->wallet_nameBitcoin = $c->wallet_nameBitcoin;
                $this->wallet_uriBitcoin = $c->wallet_uriBitcoin;
                $this->pubAddressBitcoin = $c->pubAddressBitcoin;

                return true;
            }
        }
        return false;
    }
}
class RPC {

    public string $method = '';
    public int $block = 0;
    public string $bc_env = '';
    public Address $to;
    public Address $from;
    public string $id = '';
    public stdClass $params;
    public int $amount = 0;
    public string $hex = '';
    public string $script = '';
    public string $proof = '';
    public string $jsonrpc = '1.0';
    public int $code = 200001;
    public string $msg = "";
    public bool $state = true;
    public string $success = '';

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

    public function __construct(){

        $this->to = new Address();
        $this->from = new Address();
        $data = file_get_contents("php://input");
        error_log($data, 0);

        if(empty($data) === true) {

            error_log('GET', 0);
            $data = new stdClass();

            foreach($_GET as $k => $v) $data->$k = $v;
        }
        else {

            $data = json_decode($data);
        }
        if(isset($data->jsonrpc) === false || $data->jsonrpc !== $this->jsonrpc) exit('RPC Version');
        if(isset($data->bc_env) === false) exit('Err env');
        if(isset($data->id) === false) exit('Err id');
        if(isset($data->from->address) === false) exit('Err From');
        $this->bc_env = $data->bc_env;
        $this->method = $data->method;
        $this->id = $data->id;
        $this->from->addressSet($data->from->address);
        $this->from->typeSet($data->from->type);
        $this->from->load($this->bc_env);
        $d = file_get_contents('../'.$this->bc_env.'/conf/conf.json');
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

        if(isset($data->params) === true) {

            $this->params = $data->params;

            if(isset($this->params->amount) === true) $this->amount = $this->params->amount;
            if(isset($this->params->hex) === true) $this->hex = $this->params->hex;
            if(isset($this->params->script) === true) $this->script = $this->params->script;
            if(isset($this->params->proof) === true) $this->proof = $this->params->proof;
        }
        if(isset($data->to->address) === true) {
                $this->to->addressSet($data->to->address);
                $this->to->typeSet($data->to->type);
                $this->to->load($this->bc_env);
        }
        switch ($data->method) {

            case 'askForBlockProposal':
                $argsString = $this->bc_env;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'blockProposal':
                $argsString = $this->bc_env.' '.$this->to->walletInstance.' '.$this->hex;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'blockValidation':
                $argsString = $this->bc_env.' '.$this->to->walletInstance.' "'.$this->hex.'" "'.$this->script.'"';
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();

            case 'askForPegInProposal':
                $argsString = $this->bc_env;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'pegInProposal':
                $argsString = $this->bc_env.' '.$this->to->walletInstance;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'pegInValidation':
                $argsString = $this->bc_env.' '.$this->to->walletInstance.' "'.$this->hex.'" "'.$this->script.'" "'.$this->proof.'"';
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();

            case 'pegOutProposal':
                $argsString = $this->bc_env;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'askForPegOutValidation':
                $argsString = $this->bc_env.' '.$this->to->walletInstance;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'pegOutValidation':
                $argsString = $this->bc_env.' '.$this->to->walletInstance;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();

            case 'blockcount':
                $argsString = $this->bc_env;
                $this->success = self::scriptRun($argsString, $this->method);
                $this->ret();
                exit();

            case 'getWalletList':
                $list = self::wallet_add('b_peg', 'bitcoin');
                $list = self::wallet_add('block', 'elements', $list);
                $list = self::wallet_add('peg', 'elements', $list);
                $list = self::wallet_add('backup', 'elements', $list);
                $list = self::wallet_add('lock', 'elements', $list);
                $list = self::wallet_add('witness', 'elements', $list);
                $this->success->walletList = $list;
                $list = self::node_add($this->bc_env, 'elements');
                $this->success->nodeList = $list;
                $this->ret();
                exit();

            default:
                $this->state = false;
                $this->code = 500001;
                $this->msg = "Method Not found";
                $this->ret();
                exit();
        }
    }
    public static function wallet_add(string $type, string $selfchain, Array $list = array()): Array{

        $c = file_get_contents('../regtest/conf/'.$type.'_wallets.json');
        $c = json_decode($c);

        foreach($c as $bitcoin_wallet_file) $list[] = Wallet::construct_from_file($bitcoin_wallet_file, $selfchain);

        return $list;
    }
    public static function node_add(string $env, string $selfchain, Array $list = array()): Array{

        foreach(self::$NUMBER_NODES as $element_node_index) {

            $list[] = Node::construct_from_file('../regtest/conf/e_node_'.$env.'_regtest_'.$element_node_index.'.json', $selfchain);
        }
        return $list;
    }
    public static function scriptRun(string $argsString, string $method):string{

        $script='bash '.self::$BC_SCRIPT_DIR.'/'.$method.'.sh '.$argsString;
        error_log($script, 0);
        exec($script, $result, $result_code);
        error_log(json_encode($result), 0);
        error_log((string) $result_code, 0);
        return implode('', $result);
    }
    public function ret():void{

        $res = new stdClass();
        $res->jsonrpc = $this->jsonrpc;
        $res->block = $this->block;
        $res->id = $this->id;
        $res->bc_env = $this->bc_env;
        $res->from = $this->to;
        $res->to = $this->from;
        $res->result = new stdClass();
        $res->result->state = $this->state;
        $res->result->code = $this->code;
        $res->result->msg = $this->msg;
        $res->success = $this->success;
        $output = json_encode($res, JSON_PRETTY_PRINT);

        error_log($output, 0);

        echo $output;

        exit();
    }
}
new RPC();
