<?php

class RPC{

    public string $method = '';
    public int $block = 0;
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

    public function __construct(){

        $this->to = new Address();
        $this->from = new Address();
        $data = file_get_contents("php://input");

        if (empty($data) === true) {

            if (empty($_GET) === true) {

                exit('Request');
            }
            error_log('GET', 0);
            $data = new stdClass();

            foreach ($_GET as $k => $v) $data->$k = $v;
        } else {

            $data = json_decode($data);
        }
        if (isset($data->bc_env) === false) exit('Err env');

        new Conf($data->bc_env);
        ini_set("error_log", '/var/www/contribox-node/' .$data->bc_env . '/log/api.log');
        error_log('RECEIVED: '.json_encode($data, JSON_PRETTY_PRINT), 0);

        if (isset($data->jsonrpc) === false || $data->jsonrpc !== $this->jsonrpc) exit('RPC Version');
        if (isset($data->id) === false) exit('Err id');
        if (isset($data->from->address) === false) exit('Err From');
        $this->method = $data->method;
        $this->id = $data->id;
        $this->from->addressSet($data->from->address);
        $this->from->typeSet($data->from->type);
        $this->from->load();

        if (isset($data->params) === true) {

            $this->params = $data->params;

            if (isset($this->params->amount) === true) $this->amount = $this->params->amount;
            if (isset($this->params->hex) === true) $this->hex = $this->params->hex;
            if (isset($this->params->script) === true) $this->script = $this->params->script;
            if (isset($this->params->proof) === true) $this->proof = $this->params->proof;
        }
        if (isset($data->to->address) === true) {
            $this->to->addressSet($data->to->address);
            $this->to->typeSet($data->to->type);
            $this->to->load();
        }
        switch ($data->method) {

            case 'askForBlockProposal':
                $argsString = Conf::$BC_ENV;
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'blockProposal':
                $argsString = Conf::$BC_ENV . ' ' . $this->to->walletInstance . ' ' . $this->hex;
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'blockValidation':
                $argsString = Conf::$BC_ENV . ' ' . $this->to->walletInstance . ' "' . $this->hex . '" "' . $this->script . '"';
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'askForPegInProposal':
                $argsString = Conf::$BC_ENV;
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'pegInProposal':
                $argsString = Conf::$BC_ENV . ' ' . $this->to->walletInstance;
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'pegInValidation':
                $argsString = Conf::$BC_ENV . ' ' . $this->to->walletInstance . ' "' . $this->hex . '" "' . $this->script . '" "' . $this->proof . '"';
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();

            case 'pegOutProposal':
                $argsString = Conf::$BC_ENV;
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'askForPegOutValidation':
                $argsString = Conf::$BC_ENV . ' ' . $this->to->walletInstance;
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();
            case 'pegOutValidation':
                $argsString = Conf::$BC_ENV . ' ' . $this->to->walletInstance;
                $this->success = Conf::scriptRun($argsString, $this->method);
                $this->ret();
                exit();

            case 'blockcount':
                $argsString = Conf::$BC_ENV;
                $this->success = Conf::scriptRun($argsString, $this->method);
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
                $list = self::node_add(Conf::$BC_ENV, 'elements');
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
    public static function wallet_add(string $type, string $selfchain, array $list = array()): array{

        $c = file_get_contents('../regtest/conf/' . $type . '_wallets.json');
        $c = json_decode($c);

        foreach ($c as $bitcoin_wallet_file) $list[] = Wallet::construct_from_file($bitcoin_wallet_file, $selfchain);

        return $list;
    }
    public static function node_add(string $env, string $selfchain, array $list = array()): array{

        foreach (conf::$NUMBER_NODES as $element_node_index) {

            $list[] = Node::construct_from_file('../regtest/conf/e_node_' . $env . '_regtest_' . $element_node_index . '.json', $selfchain);
        }
        return $list;
    }
    public function ret(): void{

        $res = new stdClass();
        $res->jsonrpc = $this->jsonrpc;
        $res->block = $this->block;
        $res->id = $this->id;
        $res->bc_env = Conf::$BC_ENV;
        $res->from = $this->to;
        $res->to = $this->from;
        $res->result = new stdClass();
        $res->result->state = $this->state;
        $res->result->code = $this->code;
        $res->result->msg = $this->msg;
        $res->success = $this->success;
        $output = json_encode($res, JSON_PRETTY_PRINT);

        error_log('SEND: '.$output, 0);

        echo $output;

        exit();
    }
}