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
RequestData.prototype.send = function(transaction) {
        
    this.route.transaction = transaction;
    this.request.timestamp = new Date().getTime();
                
    let p = requestData.route.transaction.proof;
    let u = requestData.route.transaction.proof;
    
    console.info("send");
    
    template.list.forEach(function(t) {
    
        if(t.name == requestData.route.transaction.template) {
            
            requestData.pow(requestData);
            requestData.sig(requestData);
            
            let dest = [];
            
            t.backup.publickeyList.forEach(function(p) { dest[p] = p;});
            t.ban.publickeyList.forEach(function(p) { dest[p] = p;});
            t.block.publickeyList.forEach(function(p) { dest[p] = p;});
            t.board.publickeyList.forEach(function(p) { dest[p] = p;});
            t.childsType1.publickeyList.forEach(function(p) { dest[p] = p;});
            t.cosigner.publickeyList.forEach(function(p) { dest[p] = p;});
            t.cosignerOrg.publickeyList.forEach(function(p) { dest[p] = p;});
            t.from.publickeyList.forEach(function(p) { dest[p] = p;});
            t.investorType1.publickeyList.forEach(function(p) { dest[p] = p;});
            t.lock.publickeyList.forEach(function(p) { dest[p] = p;});
            t.old.publickeyList.forEach(function(p) { dest[p] = p;});
            t.parentstype1.publickeyList.forEach(function(p) { dest[p] = p;});
            t.peg.publickeyList.forEach(function(p) { dest[p] = p;});
            t.transaction.to.publickeyList.forEach(function(p) { dest[p] = p;});
            t.transaction.witness.publickeyList.forEach(function(p) { dest[p] = p;});
            t.transaction.witnessOrg.publickeyList.forEach(function(p) { dest[p] = p;});
            
            console.info(dest);
    
            proofEncryptionKey = requestData.walletCreate();
            proof = requestData.encrypt(p, proofEncryptionKey.publicKey);
            userEncryptionKey = requestData.walletCreate();
            user = requestData.encrypt(u, userEncryptionKey.publicKey);
            
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
RequestData.prototype.encrypt = function(message, publicKey) {

  let m = JSON.stringify(message);
  let enc = new TextEncoder();
  let encoded = enc.encode(m);
  
  return window.crypto.subtle.encrypt(
    {
      name: "RSA-OAEP"
    },
    publicKey,
    encoded
  );
}
RequestData.prototype.decrypt = function(ciphertext, privateKey) {

  return window.crypto.subtle.decrypt(
    {
      name: "RSA-OAEP"
    },
    privateKey,
    ciphertext
  );
}
RequestData.prototype.walletCreate = function(){

    return window.crypto.subtle.generateKey(
      {
        name: "RSA-OAEP",
        modulusLength: 4096,
        publicExponent: new Uint8Array([1, 0, 1]),
        hash: "SHA-256"
      },
      true,
      ["encrypt", "decrypt"]
    );
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
    
    if(this.request.pow.nonce > 400000) return false;
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