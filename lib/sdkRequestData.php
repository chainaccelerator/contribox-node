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
RequestData.prototype.send = function(template, proof = "", user = "") {

    let userEncryptionKey = "";
    let proofEncryptionKey = "";

    template.list.forEach(function(t) {
    
        if(t.templateValidation = template+"Validation") {
        
            let transaction = new Transaction(t.from, t.to, t.templateValidation, t.amount, t.proof, t.proofEncryptionKey, t.user, t.userEncryptionKey);
    
            wallet.list.forEach(function(w){
        
                if(w.role == "api") {
                    
                    let pubkey = w.pubkey0; 
                    let urlClient = "http://localhost:7001/api/index.php";
                    let dataToHash = this;
                    console.info(dataToHash);
                    delete dataToHash.request.pow;
                    this.request.pow.hash = sodium.crypto_generichash(64, sodium.from_string(JSON.stringify(dataToHash)));
                    this.request.sig.sig = wallet.sig(publicAddress, requestData.pow.hash);
                
                    // request options
                    const options = {
                            method: "POST",
                        body: JSON.stringify(requestData),
                        headers: {
                                "Content-Type": "application/json"
                        }
                    }
                    // send post request
                    fetch(urlClient, options)
                    .then(res => res.json())
                        .then(res => console.log(res))
                        .catch(err => console.error(err));
                }
            });
        }
    });
}
';

        return '';
    }


}