<?php


class App
{

    public static array $instanceList = [];

    public static string $dirWwwBase = '/var/www';
    public static string $dirBinBase = '/bin';
    public static string $dirConfBase = '/etc';
    public static string $dirCodeBase = '/var';
    public static string $dirTmpBase = '/var';
    public static string $dirLogBase = '/var/log';
    public static string $dirDataBase = '/var/data';
    public static string $dirScriptBase = '/var/www';

    public static string $portPrefixRpc = '8';
    public static string $portPrefixApi = '9';

    public static string $dirWwwBaseRight = '077';
    public static string $dirBinBaseRight = '077';
    public static string $dirConfBaseRight = '077';
    public static string $dirCodeBaseRight = '077';
    public static string $dirTmpBaseRight = '077';
    public static string $dirLogBaseRight = '077';
    public static string $dirDataBaseRight = '077';
    public static string $dirScriptBaseRight = '077';
    public string $dirDataChainBaseRight = '077';

    public static string $dirWwwBaseUser = '';
    public static string $dirBinBaseUser = '';
    public static string $dirConfBaseUser = '';
    public static string $dirCodeBaseUser = '';
    public static string $dirCodeTmpUser = '';
    public static string $dirLogBaseUser = '';
    public static string $dirDataBaseUser = '';
    public static string $dirScriptBaseUser = '';
    public string $dirDataChainBaseUser = '';

    public string $dirWww = '';
    public string $dirBin = '';
    public string $dirConf = '';
    public string $dirTmp = '';
    public string $dirCode = '';
    public string $dirLog = '';
    public string $dirData = '';
    public string $dirScript = '';
    public string $dirApi = '';
    public string $dirApiClient = '';
    public string $dirClient = '';
    public string $dirInstall = '';
    public string $dirDataChain = '';

    public string $dirWwwRight = '077';
    public string $dirBinRight = '077';
    public string $dirConfRight = '077';
    public string $dirCodeRight = '077';
    public string $dirTmpRight = '077';
    public string $dirLogRight = '077';
    public string $dirDataRight = '077';
    public string $dirScriptRight = '077';
    public string $dirApiRight = '077';
    public string $dirApiClientRight = '077';
    public string $dirClientRight = '077';
    public string $dirInstallRight = '077';
    public string $dirDataChainRight = '077';

    public string $dirWwwUser = '';
    public string $dirBinUser = '';
    public string $dirConfUser = '';
    public string $dirCodeUser = '';
    public string $dirTmpUser = '';
    public string $dirLogUser = '';
    public string $dirDataUser = '';
    public string $dirScriptUser = '';
    public string $dirApiUser = '';
    public string $dirApiClientUser = '';
    public string $dirClientUser = '';

    public string $env = '';
    public string $envIndex = '';
    public string $user = '';
    public int $instanceIndex = 0;
    public string $version = '';
    public string $portPrefix = '';
    public string $rpcPassword = '';
    public bool $qtState = true;
    public string $deamonBin = '';
    public string $qtBin = '';
    public string $debugFile = '';
    public string $debugBin = '';
    public string $cliBin = '';

    public string $conf = '';
    public string $confIniClient = '';
    public string $confIniClientFile = '';
    public string $confIniDeamon = '';
    public string $confIniDeamonFile = '';

    public string $chain = '';
    public string $port = '0';
    public string $portRpc = '0';
    public string $portApi = '0';

    public static function constructAll(string $env, bool $start = false, bool $stopForce = false, bool $rmData = false): bool{

        $c = get_called_class();
        $conf = self::dirConfBase.'/'.$c::$name.'/'.$env.'/conf.json';
        $confJson = json_decode(file_get_contents($confFile));
        $n = $confJson->NUMBER_NODES;

        for($i=1;$i<=$n;$i++){

            $c = get_called_class();
            $node = new $c($env, $n);
            $node->init();

            self::$instanceList[] = $node;

            if($start === true) $node->start($stopForce, $rmData);
        }
        return true;
    }
    public function mkdir(string $baseName):bool {

        $var = 'dir'.$baseName.'BaseUser';
        self::$$var = $this->user;
        $var = 'dir'.$baseName.'User';
        $this->$var = $this->user;

        $var = 'dir'.$baseName.'Base';
        $varRight = 'dir'.$baseName.'BaseRight';
        $varUser = 'dir'.$baseName.'BaseUser';
        Shell::mkdir(self::$$var, self::$$varRight, self::$$varUser);

        $var = 'dir'.$baseName;
        $varRight = 'dir'.$baseName.'Right';
        $varUser = 'dir'.$baseName.'User';
        Shell::mkdir(self::$$var, self::$$varRight, self::$$varUser);

        return true;
    }
    public function __construct(string $env, int $instanceIndex = 0) {

        $c = get_called_class();
        $confFile = self::dirConfBase.' / '.$this->name.'/' . $this->env . '/conf.json';
        $this->name = $c::$name;
        $this->env = $env;
        $this->instanceIndex = $instanceIndex;
        $this->conf = json_decode(file_get_contents($confFile));
        $this->user = $this->conf->BC_USER;
        $this->dirWww = self::$dirWwwBase . '/' . $this->name . '/' . $env;
        $this->dirBin = $this->dirBin . '/' . $this->version . '/bin';
        $this->dirConf = self::$dirConfBase . '/' . $this->name . '/' . $env;
        $this->dirCode = self::$dirCodeBase . '/' . $this->name;
        $this->dirTmp = self::$dirTmpBase . '/' . $this->name;
        $this->dirLog = self::$dirLogBase . '/' . $this->name . '/' . $env;
        $this->dirScript = self::$dirScriptBase . '/' . $this->name . '/' . $env;
        $this->dirData = self::$dirDataBase . '/' . $this->name . '/' . $env;
        $this->dirApi = $this->dirWww . '/api';
        $this->dirApiClient = $this->dirWww . '/apiClient';
        $this->dirClient = $this->dirWww . '/client';
        $this->dirDataChain = $this->dirData . '/' . $this->chain;
        $this->confIniClientFile = $this->dirConf . '/client-' . $this->instanceIndex . 'ini';
        $this->confIniDeamonFile = $this->dirConf . '/daemon-' . $this->instanceIndex . '.ini';
        $this->debugFile = $this->dirLog . '/' . $this->instanceIndex . '.log';
        $this->debugBin = 'tail -f ' . $rhis->debugFile;
        $this->chain = $this->conf->CHAIN;
        $this->envIndex = $this->conf->ENV_INDEX;
        $this->version = $this->conf->VERSION;
        $this->qtState = $this->conf->QT_STATE;
        $this->port = $this->conf->PORT_PREFIX . $this->conf->ENV_INDEX;
        $this->portRpc = $this->port . self::$portPrefixRpc;
        $this->portApi = $this->port . self::$portPrefixRpc . self::$portPrefixApi;
        $this->rpcUser = $this->name . '-' . $this->env . '-' . $this->instanceIndex . '-' . $this->user;
        $this->rpcPassword = $this->conf->RPC_PWD;
        $this->deamonBin = $this->dirBin . '/' . $this->name . ' -conf=' . $this->confIniDeamonFile;
        $this->qtBin = $this->dirBin . '/' . $this->name . '-qt -conf=' . $this->confIniDeamonFile;
        $this->cliBin = $this->dirBin . '/' . $this->name . '-cli -conf=' . $this->confIniClientFile . ' -rpcconnect=' . shell::$HOST_IP . ' -rpcport=' . $rpcPort . ' -rpcuser=' . $rpcUser . ' -rpcpassword=' . $this->rpcPassword;

        $this->mkdir('Www');
        $this->mkdir('Bin');
        $this->mkdir('Conf');
        $this->mkdir('Tmp');
        $this->mkdir('Code');
        $this->mkdir('Log');
        $this->mkdir('Data');
        $this->mkdir('Script');
        $this->mkdir('Api');
        $this->mkdir('ApiClient');
        $this->mkdir('Client');
        $this->mkdir('DataChain');
    }
    public function confWrite():bool{

        file_put_contents($this->confIniClientFile, $this->confIniClient);
        chmod($this->dirConfRight, $this->confIniClientFile);
        chown($this->dirConfUser, $this->confIniClientFile);

        file_put_contents($this->confIniDeamonFile, $this->confIniDeamon);
        chmod($this->dirConfRight, $this->confIniDeamonFile);
        chown($this->dirConfUser, $this->confIniDeamonFile);

        return true;
    }
    public function start(bool $stop = false, bool $rmData = false): bool {

        if ($stop === true) {

            echo echoSectionSub('STOP');

            Shell::cmd($this->cliList[0]->node->serviceStop, true);
            sleep(5);
        }
        if ($rmData === true) {

            Shell::rmdir($this->dirDataChain);
            sleep(5);
            Shell::mkdir($DATADIR_VAL, $this->dirDataRight, $this->dirDataUser);
            sleep(5);
        }
        echo echoSectionSub('START');

        if ($this->qtState === true) Shell::cmd($this->qtBin, true);
        else Shell::cmd($this->deamonBin, true);

        sleep(5);

        return true;
    }
    public function conf(string $k, string $v = '', bool $deamonState = true, bool $clientState = true, bool $section = false): bool {

        if ($section === false) $param = $k . '=' . $v . "\n";
        else $param = '[' . $k . ']';

        if ($clientState === true) $this->confIniClient .= $param;
        if ($deamonState === true) $this->confIniDeamon .= $param;

        return true;
    }
}
