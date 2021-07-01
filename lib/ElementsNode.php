<?php

class ElementsNode extends BitcoinNode {

    public static string $name = 'elements';

    public static $mainchain;

    public function init() {

        parent::init();

        $this->conf('mainchainrpchost', shell::$HOST_IP);
        $this->conf('mainchainrpcport', self::$mainchain->portRpc);
        $this->conf('mainchainrpcuser', self::$mainchain->rpcUser);
        $this->conf('mainchainrpcpassword', self::$mainchain->rpcPassword);
        $this->conf('connect', $this->conf->FIRST_CONNECT.':'(int)$this->portRpc);
        $this->conf('addnode', $this->conf->FIRST_CONNECT.':'((sting)(((int)$this->portRpc)-1));
        $this->conf('addnode', $this->conf->FIRST_CONNECT.':'((sting)(((int)$this->portRpc)-2));
        $this->conf('addnode', $this->conf->FIRST_CONNECT.':'((sting)(((int)$this->portRpc)-3));
        $this->conf('addnode', $this->conf->FIRST_CONNECT.':'((sting)(((int)$this->portRpc)+1));
        $this->conf('addnode', $this->conf->FIRST_CONNECT.':'((sting)(((int)$this->portRpc)+2));
        $this->conf('addnode', $this->conf->FIRST_CONNECT.':'((sting)(((int)$this->portRpc)+3));

        $this->conf($this->chain, '', true, true, true);
        $this->conf('port', $this->portPrefix . $envIndex . $this->instanceIndex);
        $this->conf('bind', shell::$HOST_IP);
        $this->conf('rpcbind', shell::$HOST_IP);
        $this->conf('rpcport', $this->portRpc);
        $this->confWrite();

        unlink($this->debugFile);

        if(is_dir($this->dirBin) === false) {

            Shell::cmdApt('install build-essential libtool autotools-dev autoconf pkg-config libssl-dev');
            Shell::cmdApt('install libboost-all-dev');
            Shell::cmdApt('install libqt5gui5 libqt5core5a libqt5dbus5 qttools5-dev qttools5-dev-tools libprotobuf-dev protobuf-compiler imagemagick librsvg2-bin');
            Shell::cmdApt('install libqrencode-dev autoconf openssl libssl-dev libevent-dev');
            Shell::cmdApt('install libminiupnpc-dev libnatpmp-dev');
            Shell::cmdApt('install libminiupnpc-dev');

            $baseNameFileInstall = 'elements-' . $this->version . '-x86_64-linux-gnu.tar.gz';
            $c = file_get_contents('https://github.com/ElementsProject/elements/releases/download/elements-' . $this->version . '/' . $baseNameFileInstall);

            $tmpFile = $this->dirTmp . '/' . $baseNameFileInstall;

            file_put_contents($tmpFile, $c);
            Shell::cmd('tar -xvzf ' . $tmpFile . ' -C ' . $this->dirBin);
            unlink($tmpFile);
        }
        $this->NUMBER_NODES = $this->conf->NUMBER_NODES;
        $this->MAIN_PARTICIPANT_NUMBER = $this->conf->MAIN_PARTICIPANT_NUMBER;
        $this->PEG_PARTICIPANT_NUMBER = $this->conf->PEG_PARTICIPANT_NUMBER;
        $this->BLOCK_PARTICIPANT_NUMBER = $this->conf->BLOCK_PARTICIPANT_NUMBER;
        $this->NODE_PARTICIPANT_NUMBER = $this->conf->NODE_PARTICIPANT_NUMBER;
        $this->API_PARTICIPANT_NUMBER = $this->conf->API_PARTICIPANT_NUMBER;
        $this->PEG_SIGNER_AMOUNT = $this->conf->PEG_SIGNER_AMOUNT;
        $this->PEG_AMOUNT = $this->conf->PEG_AMOUNT;
        $this->PEG = $this->conf->PEG;
        $this->PEG_PARTICIPANT_MAX = $this->conf->PEG_PARTICIPANT_MAX;
        $this->PEG_PARTICIPANT_MIN = $this->conf->PEG_PARTICIPANT_MIN;

        $this->addCliRoles('main', $this->MAIN_PARTICIPANT_NUMBER);
        $this->addCliRoles('peg', $this->PEG_PARTICIPANT_NUMBER);
        $this->addCliRoles('block', $this->BLOCK_PARTICIPANT_NUMBER);
        $this->addCliRoles('api', $this->BLOCK_PARTICIPANT_NUMBER);
        $this->addCliRoles('node', $this->NODE_PARTICIPANT_NUMBER);

        return true;
    }
    public function addCliRoles(string $role, int $participant):bool{

        if(isset($this->cliList[$role]) === false) $this->cliList[$role] = [];

        for($i = 0; $i < $participant; $i++) {

            $cli = new BitcoinCli();
            $cli->init($this, $role, $i, 0);
            $this->cliList[$role][] = $cli;
        }
        return true;
    }
}