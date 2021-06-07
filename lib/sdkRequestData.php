<?php

class SdkRequestData {

    public SdkRequest $request;
    public SdkRequestRoute $route;
    public string $htmlScript = '';

    public function __construct(string $role = '', string $domain = '', string $domainSub = '', string $process = '', string $processStep = '', string $processStepAction = '', string $about = '', int $amount = 0, bool $blockSignature = false, bool $pegSignature = false, string $version = 'v0', bool $declareAddressFrom = false, bool $declareAddressTo = false, bool $proofEncryption = false, bool $userEncryption = false, array $form = [], array $to = [], string $template = '', string $proof = '{data: "", version: "v0"}', string $user = '{data: "", version: "v0"}'){

        $this->request = new SdkRequest();
        $this->route = new SdkRequestRoute($role, $domain, $domainSub, $process, $processStep, $processStepAction, $about, $amount, $blockSignature, $pegSignature, $version, $declareAddressFrom, $declareAddressTo, $proofEncryption, $userEncryption, $form, $to, $template, $proof, $user);
    }
    public function conditionHtml():string {

        $this->htmlScript =  '
function RequestData() {

    this.request = '.json_encode($this->request).';
    this.route = '.json_encode($this->route).';
}
RequestData.prototype.roleMsgCreate = function(tx, roleInfo, templateName) {

    if(roleInfo.xpubList == []) return false;
    if(roleInfo.state == "off") return false;
    
    tx.template = templateName;
    tx.amount = roleInfo.amount;
    tx.from = roleInfo.from;
    tx.patternAfterTimeout = roleInfo.patternAfterTimeout;
    tx.patternAfterTimeoutN = roleInfo.patternAfterTimeoutN;
    tx.patternBeforeTimeout = roleInfo.patternBeforeTimeout;
    tx.patternBeforeTimeoutN = roleInfo.patternBeforeTimeoutN;
    tx.type = roleInfo.type;
    
    if(roleInfo.proof == "on") {
    
     for(i=0; i<roleInfo.xpubList.length;i++){
        
            if(tx.proofEncryption != "on") tx.proof =  "";
            
            if(tx.userEncryption != "on") tx.user =  "";
        }
    }
    console.info("tx", tx);
    
    requestData.encrypt(tx, roleInfo.xpubList[i]);
    
    return transaction;
}

RequestData.prototype.send = function(transaction) {
        
    this.route.transaction = transaction;
    this.route.template = transaction.template;
    this.request.timestamp = new Date().getTime();
                
    let p = requestData.route.transaction.proof;
    console.info(p);
    let u = requestData.route.transaction.user;
    console.info(u);
    
    delete transaction.template;
            
    template.list.forEach(function(t) {
    
        if(t.name == requestData.route.template) {
                        
            requestData.pow(requestData);
            requestData.sig(requestData);
            
            let transactions = [];
            let tx = {};
            
            requestData.route.transaction.from.xpubList.forEach(function(p) { if(dest.indexOf(p) == -1) requestData.route.transaction.from.xpubList[requestData.route.transaction.from.xpubList] = p;});
            requestData.route.transaction.to.xpubList.forEach(function(p) { if(dest.indexOf(p) == -1) requestData.route.transaction.to.xpubList[requestData.route.transaction.to.xpubList] = p;});
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.backup, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.ban, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.block, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.board, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.childstype1, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.cosigner, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.cosignerOrg, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.investorType1, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.lock, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.old, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.parentstype1, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.peg, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.to, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.witness, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.witnessOrg, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            console.info("transactions", transactions);
            
            let urlClient = "http://localhost:7001/api/index.php";            
            const options = {
            
                method: "POST",
                body: JSON.stringify(requestData),
                headers: {
                    "Content-Type": "application/json"
                }
            }
            fetch(urlClient, options)
            .then(res => res.json())
                .then(res => console.log(res))
                .catch(err => console.error(err));
        }
    });                                        
}
RequestData.prototype.sha256 = function(message) {

    let m = JSON.stringify(message);
    let s = sodium.from_string(m);
    let h = sodium.crypto_generichash(64, s);
    let hex = sodium.to_hex(h);
    
    // let msgUint8 = new TextEncoder().encode(message);
    // let hashBuffer = await crypto.subtle.digest("SHA-256", msgUint8);
    // let hashArray = Array.from(new Uint8Array(hashBuffer));
    // let hashHex = hashArray.map(b => b.toString(16).padStart(2, "0")).join("");
    
    return hex;
}
RequestData.prototype.encrypt = function(message, xpub) {

    let m = JSON.stringify(message);
    hdPath = "0/0";
    range = 100;
    
    return encryptMessageWithXpub(m, xpub, hdPath, range);
    
    // return sodium.crypto_aead_xchacha20poly1305_ietf_encrypt(message, null, null, wallet.nonce3, wallet.key3);
        
    // let m = JSON.stringify(message);
    // let enc = new TextEncoder();
    // let encoded = enc.encode(m);
    
    // return window.crypto.subtle.encrypt(
    //   {
    //      name: "RSA-OAEP"
    //   },
    //   publicKey,
    //   encoded
    // );
}
RequestData.prototype.decrypt = function(newCipher, xprv) {

    encryptedMessage = newCipher.encryptedMessage;
    hdPath = newCipher.hdPath;
    range = newCipher.range;
    xpub = newCipher.xpub;
    pubkey = newCipher.pubkey;
    senderPubkey = newCipher.encryptedMessage;

    let message = decryptMessage(encryptedMessage, xprv, hdPath, range, pubkey, senderPubkey);
    
    return JSON.parse(message);    

    // return sodium.crypto_aead_xchacha20poly1305_ietf_decrypt(null, ciphertext, null, wallet.nonce3, wallet.key3);

    // return window.crypto.subtle.decrypt(
    // {
    //   name: "RSA-OAEP"
    // },
    // privateKey,
    // ciphertext
    // );
}
RequestData.prototype.sig = function(data){

    wallet.list.forEach(function(w){
    
        if(w.role == "api") {
        
            requestData.request.sig = wallet.sig(w, data);
        }
    });
    return false;
}
RequestData.prototype.pow = function(data){

  let pattern = Array(this.request.pow.difficulty + 1).join(this.request.pow.difficultyPatthern);
  this.request.pow.hash = this.sha256(data);
  this.request.pow.pow = "";
  
  while (this.request.pow.pow.substring(0, this.request.pow.difficulty) != pattern) {
     
    this.request.pow.nonce++;
    this.request.pow.pow = this.sha256(this.request.pow.previousHash + this.timestamp + this.request.pow.hash + this.request.pow.nonce);
    
    if(this.request.pow.nonce > 800000) return false;
  } 
  console.info("pow", requestData.request.pow.pow);
  console.info("nonce", requestData.request.pow.nonce);
}
';
        $c = get_class($this);
        file_put_contents('js/'.$c.'.js', $this->htmlScript);

        return '';
    }
}