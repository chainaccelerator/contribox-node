
function RequestData() {

    this.request = {"timestamp":0,"peerList":[],"pow":{"nonce":0,"difficulty":4,"difficultyPatthern":"d","hash":"default","pow":"default","previousHash":"default"},"sig":{"address":"","hash":"default","hdPath":"0\/0","range":"0","signature":"","xpub":""}};
    this.route = {"id":"default","version":"0.1","env":"regtest","template":"","transaction":{"amount":0,"from":[],"to":[],"template":"","proof":"{data: \"\", version: \"v0\"}","user":"{data: \"\", version: \"v0\"}","proofEncryptionKey":"","userEncryptionKey":"","htmlFieldsId":[],"htmlScript":""}};
}
RequestData.prototype.send = function(templateName, transaction) {
            
    this.route.transaction = transaction;
    this.request.timestamp = new Date().getTime();
    this.route.template = templateName;
    delete this.route.template.domains;
    delete this.route.template.domainsSubs;
    delete this.route.template.domainsSubsAbouts; 
    delete this.route.template.roles;
    delete this.route.template.typeList;
    delete this.route.template.processes;
    delete this.route.template.processesSteps;
    delete this.route.template.processesStepsAction;
    delete this.route.template.list;
    delete this.route.template.patterns;
    
    let dest = [];
            
    wallet.list.forEach(function(w){

        if(w.role == "api") {
                            
            let pubkey = w.pubkey0; 
            let urlClient = "http://localhost:7001/api/index.php";
            requestData.pow(requestData);
            requestData.request.sig = wallet.sig(w, requestData);
        
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
