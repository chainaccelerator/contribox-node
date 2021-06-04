
function RequestData() {

    this.request = {"timestamp":0,"peerList":[],"pow":{"nonce":0,"difficulty":4,"difficultyPatthern":"d","hash":"default","pow":"default","previousHash":"default"},"sig":{"address":"","hash":"default","hdPath":"0\/0","range":"0","signature":"","xpub":""}};
    this.route = {"id":"default","version":"0.1","env":"regtest","template":"","transaction":{"amount":0,"from":[],"to":[],"proof":"{data: \"\", version: \"v0\"}","user":"{data: \"\", version: \"v0\"}","proofEncryptionKey":"","userEncryptionKey":"","htmlFieldsId":[],"htmlScript":"","template":""}};
}
RequestData.prototype.send = function(transaction) {
    
    this.route.transaction = transaction;
    this.request.timestamp = new Date().getTime();
                
    delete requestData.route.transaction.template;
    let p = requestData.route.transaction.proof;
    let u = requestData.route.transaction.proof;    
    
    template.list.forEach(function(t) {
    
        if(t.name == requestData.route.transaction.template) {
            
            requestData.pow(requestData);
            requestData.sig(requestData);
            
            let dest = [];
            
            requestData.route.transaction.backup.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.ban.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.block.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.board.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.childsType1.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.cosigner.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.cosignerOrg.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.from.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.investorType1.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.lock.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.old.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.parentstype1.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.peg.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.to.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.witness.publickeyList.forEach(function(p) { dest[p] = p;});
            requestData.route.transaction.witnessOrg.publickeyList.forEach(function(p) { dest[p] = p;});
            
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
