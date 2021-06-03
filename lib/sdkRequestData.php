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
RequestData.prototype.send = function(templateName, transaction) {
            
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
    this.route.transaction = transaction;
    this.route.timestamp = new Date().getTime();
            
    wallet.list.forEach(function(w){

        if(w.role == "api") {
                            
            let pubkey = w.pubkey0; 
            let urlClient = "http://localhost:7001/api/index.php";
            let ref = requestData.sha256(JSON.stringify(requestData));
            requestData.request.pow.pow =  requestData.pow(ref);
            requestData.request.sig.sig = wallet.sig(w, ref);
        
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
    
    return hex;
}
RequestData.prototype.pow = function(data){

  let dataStr = JSON.stringify(data);
  let pattern = Array(this.request.pow.difficulty + 1).join(this.request.pow.difficultyPatthern);
  
  while (this.request.pow.hash.substring(0, this.request.pow.difficulty) !== pattern) {
  
    this.request.pow.nonce++;
    this.request.pow.hash = this.sha256(this.request.pow.previousHash + this.timestamp + dataStr + this.request.pow.nonce);
    
    if(this.request.pow.nonce > 1000) return false;
  }  
}
';
        $c = get_class($this);
        file_put_contents('js/'.$c.'.js', $this->htmlScript);

        return '';
    }


}