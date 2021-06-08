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
RequestData.prototype.roleMsgCreate = function(tx, fromXpubIdList, roleInfo, templateName) {

    if(roleInfo.state != true) return false;
    
    let tx0 = JSON.parse(JSON.stringify(tx));
    console.info("roleInfo.xpubList", roleInfo.xpubList);
    let toList = JSON.parse(JSON.stringify(roleInfo.xpubList));
    if(toList.length == 0) return false;

    tx0.template = templateName;
    tx0.amount = roleInfo.amount;
    tx0.from = fromXpubIdList;
    tx0.to = toList;
    tx0.patternAfterTimeout = roleInfo.patternAfterTimeout;
    tx0.patternAfterTimeoutN = roleInfo.patternAfterTimeoutN;
    tx0.patternBeforeTimeout = roleInfo.patternBeforeTimeout;
    tx0.patternBeforeTimeoutN = roleInfo.patternBeforeTimeoutN;
    tx0.type = roleInfo.type;    
    let l = [];
    
    console.info("tx0", tx0);
    
    if(roleInfo.userProofSharing != true) tx0.proof = "";
    if(roleInfo.proofSharing != true) tx0.user = "";
    
    for(i=0; i<toList.length;i++){
        
        let test = this.encrypt(tx0, toList[i]);
        
        console.info("test", test);
        
        l[l.length] = test;
    }      
    return l;
}

RequestData.prototype.send = function(tr) {
        
    this.route.transaction = JSON.parse(JSON.stringify(tr));
    this.route.template = JSON.parse(JSON.stringify(tr.template));
    this.request.timestamp = new Date().getTime();
                
    let p = JSON.parse(JSON.stringify(requestData.route.transaction.proof));
    let u = JSON.parse(JSON.stringify(requestData.route.transaction.user));
                
    template.list.forEach(function(t) {
    
        if(t.name == requestData.route.template) {
                        
            requestData.pow(requestData);
            requestData.sig(requestData);
            
            let transactions = [];
            let tx = {};
            
            requestData.route.transaction.from.forEach(function(p) { if(t.from.xpubList.indexOf(p) == -1) t.from.xpubList[t.from.xpubList] = p;});
            requestData.route.transaction.to.forEach(function(p) { if(t.to.xpubList.indexOf(p) == -1) t.to.xpubList[t.to.xpubList] = p;});
            
            if(requestData.route.transaction.amount > 0)  t.to.amount = this.route.transaction.amount;
            if(requestData.route.transaction.amount < 0)  t.from.amount = this.route.transaction.amount;

            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.from, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.to, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.backup, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.ban, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.block, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.board, t.name);
            if(tx != false) transactions[this.route.transaction.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.childstype1, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.cosigner, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.cosignerOrg, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.investorType1, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.lock, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.old, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.parentstype1, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.peg, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.witness, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            tx = requestData.roleMsgCreate(requestData.route.transaction, t.from.xpubList, t.witnessOrg, t.name);
            if(tx != false) transactions[transactions.length] = tx;
            
            console.info("transactions", transactions);
            
            let urlClient = "http://localhost:7002/api/index.php";            
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