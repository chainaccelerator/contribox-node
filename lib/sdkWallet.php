<?php

class SdkWallet {

    public static array $wallets = [ 'api', 'from', 'to', 'backup', 'lock', 'cosigner', 'witness', 'peg', 'block', 'ban', 'board', 'member', 'old', 'onboard', 'outboard', 'cosignerOrg', 'witnessOrg', 'info', 'parentstype1', 'childsttype1', 'investorType1'];
    public static stdClass $walletsShare;
    public static stdClass $walletsFederation;
    public string $htmlScript = '';

    public function __construct(){

        self::$walletsShare = json_decode(file_get_contents('../'.Conf::$env.'/conf/share.json'));
        self::$walletsFederation = json_decode(file_get_contents('../'.Conf::$env.'/conf/federation.json'));
    }
    public function conditionHtml():string {

        $this->htmlScript = '
function Wallet(){

    this.walletList = '.json_encode(self::$wallets).';
    this.walletsShare = '.json_encode(self::$walletsShare).';
    this.walletsFederation = '.json_encode(self::$walletsFederation).';
    this.list = [];
    this.key = ""
    this.loaded = false;
}
Wallet.prototype.createWallet = function(account, role){

    let w = newWallet();
    
    if (w === "") {
    
        console.warn("wallet creation");
        return;
    }
    let walletJ = JSON.parse(w);
    let accountSig = this.sig(walletJ, account);
            
    return {
    
        hdPath: walletJ.hdPath,
        pubkey0:  walletJ.pubkey0,
        seedWords: walletJ.seedWords,
        xprv: walletJ.xprv,
        xpub: walletJ.xpub,
        role: role,
        account: account,
        accountSig: accountSig
    };
}
Wallet.prototype.download = function() {

    let element = document.createElement("a");
    element.setAttribute("href", "data:text/plain;charset=utf-8," + encodeURIComponent(JSON.stringify(this)));
    element.setAttribute("download", "wallet_contribox.dat");
    element.style.display = "none";
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}
Wallet.prototype.load = function(reader){

    let wallet = reader.result;
    let walletJ = JSON.parse(wallet.toString());
    this.list = walletJ.list;
    this.key = walletJ.key;
    this.loaded = true;
}
Wallet.prototype.sig = function(w, data) {

    let h = requestData.sha256(data);    
    let s = signHash(w.xprv, "0/0", 0, h);
    return JSON.parse(s);
}
';
        $c = get_class($this);
        file_put_contents('js/'.$c.'.js', $this->htmlScript);
        return '';
    }
}