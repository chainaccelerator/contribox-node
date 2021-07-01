<?php

class ApiRoute {

    public static string $version = 'v0';
    public static string $env = 'regtest';
    public static stdClass $conf;

    public string $id = 'default';
    public SdkTemplate $template;
    public SdkTransaction $transaction;
    public stdClass $response;
    public stdClass $params;

    public function __construct(stdClass $data){

        if(isset($data->version) === false || $data->version !== self::$version) {exit('Bad version');}

        if(isset($data->env) === false) {exit('No env');} else self::$env = $data->env;
        self::$conf = json_decode(file_get_contents('/var/www/contribox-node/'.$this->env.'/conf/shared/e_node_regtest_1.json'));

        if(isset($data->id) === false) {exit('No id');} else $this->id = $data->id;
        if(isset($data->template) === false) {exit('No template');} else $this->template = SdkTemplate::initFromJson($data->template);
        if(isset($data->transaction) === false) {exit('No transaction');} else $this->transaction = SdkTemplate::initFromJson($data->transaction);
        if(isset($data->params) === false) {exit('No params');} else $this->params = $data->params;

        $this->response = new stdClass();
        $func = 'pre_'.$this->template->name;

        if (method_exists($this, $func) === true) $this->$func();

        $this->store();

        $func = 'post_'.$this->template->name;

        if (method_exists($this, $func) === true) $this->$func();
    }
    public function store(){


    }
    public function onboard():bool{

        $amount = 0.00000001;
        $data = $this->params->data;
        $destAddress = $this->params->destAddress;
        $this->response->mineAddress = $this->getNewAddress('onboard', 1, 'legacy', false);
        $this->response->unblindedPrevTx = $this->sendToAddress('onboard', 1, $destAddress, $amount);
        $this->response->contractHash = CryptoHash::get($data);
        $this->response->assetTx = $this->createIssueAssetTx('onboard', 1, $this->response->unblindedPrevTx, $this->response->contractHash, $destAddress, $this->response->mineAddress);

        return true;
    }
    public function getNewAddress(string $walletType, $addressType = 'legacy', bool $blind = false, int $walletIndex = 1, $method = 'getnewaddress'): string{

        $params = new stdClass();

        return $this->elementsRpc($walletType, $method, $params, 'http', $walletIndex);
    }
    public function sendToAddress(string $walletType, string $addressType, string $destAddress, float $amount = 0.00000001, int $walletIndex = 1, $method = 'sendtoaddress'): string{

        $params = new stdClass();

        return $this->elementsRpc($walletType, $method, $params, 'http', $walletIndex);
    }
    public function createIssueAssetTx(string $walletType, $unblindedPrevTx, string $contractHash, string $destAddress, string $mineAddress, int $walletIndex = 1): string{

        $method = '';
        $params = new stdClass();

        return $this->elementsRpc($walletType, $method, $params, 'http', $walletIndex);
    }
    public function elementsRpc(string $walletType, string $template, stdClass $params, $proto = 'http', int $walletIndex = 1):bool{

        $request = json_encode(array(
            'template' => $template,
            'params' => $params,
            'id'     => uniqid()
        ));
        $walletConf = json_decode(file_get_contents('/var/www/contribox-node/'.$this->env.'/conf/e_'.$walletType.'_'.$this->env.'_cli1_wallet'.$walletIndex.'.json'));
        $rpcUser = $walletConf->rpcUser;
        $rpcPassword = $walletConf->rpcPassword;
        $rpcBind = $walletConf->rpcBind;
        $rpcPort = $walletConf->rpcPort;
        $wallet_name = $walletConf->wallet_name;
        $curl    = curl_init($proto.'://'.$rpcBind.':'.$rpcPort.'/wallet/'.$wallet_name);
        $options = array(
            CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
            CURLOPT_USERPWD        => $rpcUser . ':' . $rpcPassword,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER     => array('Content-type: application/json'),
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $request
        );
        curl_setopt_array($curl, $options);

        $this->response->raw_response = curl_exec($curl);
        $this->response->stdClass = json_decode($this->raw_response, true);
        $this->response->status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $curl_error = curl_error($curl);

        curl_close($curl);

        if (!empty($curl_error)) $this->response->error = $curl_error;

        return true;
    }
}