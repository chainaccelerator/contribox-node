<?php

class SdkWallet {

    public static array $wallets = [ 'api', 'from', 'to', 'backup', 'lock', 'cosigner', 'witness', 'peg', 'block', 'template', 'ban', 'board', 'member', 'old', 'onboard', 'outboard', 'cosignerOrg', 'witnessOrg', 'info', 'investorType1'];
    public string $htmlScript = '';

    public function __construct(){

    }
    public function conditionHtml():string {

        $this->htmlScript = '
function Wallet(){

    this.walletList = '.json_encode(self::$wallets).';
    this.list = [];
    this.key = ""
    this.loaded = false;
}
Wallet.prototype.createWallet = function(role, account){

    let w = newWallet();
    
    if (w === "") {
    
        console.warn("wallet creation");
        return;
    }
    let walletJ = JSON.parse(w);
    let accountSigTmp = signHash(walletJ.xprv, "0/0", 0, JSON.stringify(account));    
    let accountSig = JSON.parse(accountSigTmp).signature;
            
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
Wallet.prototype.createwallets = function(account){

    this.walletList.forEach(function(w){

        let w2 = wallet.createWallet(w, account);
        wallet.list[wallet.list.length] = w2;
    });
    let l = JSON.stringify(this.list);
    let s = sodium.from_string(l);
    let h = sodium.crypto_generichash(64, s);
    this.key = sodium.to_hex(h);
    this.loaded = true;
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
Wallet.prototype.sig = function(publicAddress, data) {

    
}
';
        $c = get_class($this);
        file_put_contents('js/'.$c.'.js', $this->htmlScript);
        return '';
    }
}