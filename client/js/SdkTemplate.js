
function Template(amount = 0, role = "owner", domain = "Core", process = "Identifier", blockSignature = false, pegSignature = false, declareAddressFrom = false, declareAddressTo = false, proofEncryption = false, userEncryption = false, templateValidation = "CoreTemplateValidation", proofValidation = {}, fromValidation = {}, toValidation = {}, from = {}, to = {}, backup = {}, lock = {}, witness = {}, cosigner = {}, ban = {}, old = {}, board = {}, cosignerOrg = {}, witnessOrg = {}, parentstype1 = {}, childstype1 = {}, investorType1 = {}, block = {}, peg = {}) {

    this.domains = ["Laeka","Core"];
    this.domainsSubs = {"Laeka":["healthRecord"],"Core":["user","proof"]};
    this.domainsSubsAbouts = {"Laeka":{"healthRecord":["Identifier","Product","Service","Voucher","State","Record","Vote","Act","Payment","Ownership","Contribution"]},"Core":{"proof":["Identifier"],"user":["Identifier"]}}; 
    this.roles = ["Author","Owner","Contributor","ClientPrivate","ClientPublic","Witness","Provider","Distributor","Sponsor","Insurance"];
    this.typeList = ["from","to","backup","lock","cosigner","witness","ban","old","member","board","witnessOrg","cosignerOrg","parentstype1","childstype1","block","peg"];
    this.processes = ["Core","Authorizations","HealthCare","Sells","Finance","Maintenance"];
    this.processesSteps = ["Proposal","Realization","Test","Validation","Advertising","InitialVersion","NewVersion"];
    this.processesStepsAction = ["AskForConfirmationDeclaration","AskForConfirmationBan","AskForConfirmationOutboard","AskForConfirmationOutboard","AskForConfirmationShare","AskForTemplateUpdate","AskForTechnicalInfos"];
    this.list = [{"name":"default","amount":1.0e-5,"role":"Author","domain":"Core","process":"Core","blockSignature":true,"pegSignature":true,"proofSharing":true,"userSharing":true,"patternAfterTimeout":false,"patternAfterTimeoutN":1,"patternBeforeTimeout":false,"patternBeforeTimeoutN":300,"templateValidation":"default","proofValidation":{"state":true,"definition":"","type":"proofValidation"},"fromValidation":{"state":true,"definition":"","type":"fromValidation"},"toValidation":{"state":true,"definition":"","type":""},"from":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"to":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"backup":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"lock":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"witness":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"cosigner":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"ban":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"old":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"board":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"cosignerOrg":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"witnessOrg":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"parentstype1":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"childstype1":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"investorType1":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"block":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"peg":{"xpubList":[],"pattern":"any","patternAfterTimeoutN":300,"patternBeforeTimeoutN":1,"amountBTCMin":"0","amountBTCMinFrom":"Genesis","state":true,"patternAfterTimeout":true,"patternBeforeTimeout":true,"type":""},"hash":""}];
    this.patterns = ["none","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%"];

	this.amount = amount;
	this.role = role;
	this.domain = domain;
	this.process = process;
	this.blockSignature = blockSignature;
	this.pegSignature = pegSignature;
	this.declareAddressFrom = declareAddressFrom;
	this.declareAddressTo = declareAddressTo;
	this.proofEncryption = proofEncryption;
	this.userEncryption = userEncryption;
	this.templateValidation = templateValidation;

    this.proofValidation = proofValidation;
    this.fromValidation = fromValidation;
    this.toValidation = toValidation;
    this.from = from;
    this.to = to;
    this.backup = backup;
    this.lock = lock;
    this.witness = witness;
    this.cosigner = cosigner;
    this.ban = ban;
    this.old = old;
    this.board = board;
    this.cosignerOrg = cosignerOrg;
    this.witnessOrg = witnessOrg;
    this.parentstype1 = parentstype1;
    this.childstype1 = childstype1;
    this.investorType1 = investorType1;
    this.block = block;
    this.peg = peg;
}
Template.prototype.getDataFromForm = function () {

	this.amount = document.getElementsByName("amount")[0].value;
	this.role = document.getElementsByName("role")[0].value;
	this.domain = document.getElementsByName("domain")[0].value;
	this.process = document.getElementsByName("process")[0].value;
	this.blockSignature = document.getElementsByName("blockSignature")[0].value;
	this.pegSignature = document.getElementsByName("pegSignature")[0].value;
	this.declareAddressFrom = document.getElementsByName("declareAddressFrom")[0].value;
	this.declareAddressTo = document.getElementsByName("declareAddressTo")[0].value;
	this.proofEncryption = document.getElementsByName("proofEncryption")[0].value;
	this.userEncryption = document.getElementsByName("userEncryption")[0].value;
	this.templateValidation = document.getElementsByName("templateValidation")[0].value;

    this.proofValidationGetDataFromForm();
    this.proofValidation.type = "proofValidation";
    this.fromValidationGetDataFromForm();
    this.fromValidation.type = "fromValidation";
    this.toValidationGetDataFromForm();
    this.fromGetDataFromForm();
    this.toGetDataFromForm();
    this.backupGetDataFromForm();
    this.lockGetDataFromForm();
    this.witnessGetDataFromForm();
    this.cosignerGetDataFromForm();
    this.banGetDataFromForm();
    this.oldGetDataFromForm();
    this.boardGetDataFromForm();
    this.cosignerOrgGetDataFromForm();
    this.witnessOrgGetDataFromForm();
    this.parentstype1GetDataFromForm();
    this.childstype1GetDataFromForm();
    this.investorType1GetDataFromForm();
    this.blockGetDataFromForm();
    this.pegGetDataFromForm();    
    this.name = this.role+this.domain+this.domainSub+this.domainSubAbout+this.process+this.processStep+this.processStepAction+this.version;
    this.hash = requestData.sha256(this);
            
    return true;
}
Template.prototype.createTemplate = function(){

    this.getDataFromForm();
    let u = false;
    let tl = template.list;
    let proof = template;
    
    wallet.list.forEach(function(w) {
    
        if(w.role == "api" ) user = w.account;
    });
    template.list.forEach(function(t) {
    
        if(t.name == "default") {
            
            delete proof.domains;
            delete proof.domainsSubs;
            delete proof.domainsSubsAbouts;
            delete proof.roles;
            delete proof.typeList;
            delete proof.processes;
            delete proof.processesSteps;
            delete proof.processesStepsAction;
            delete proof.list;
            delete proof.patterns;
             
            let templateDefault = t;
            proof.from = template.from;
            proof.to = template.to;
            
            let transaction = new Transaction(proof.from, proof.to, templateDefault.name, templateDefault.amount, proof, t.proofSharing, user, t.userSharing, t.patternAfterTimeout, t.patternAfterTimeoutN, t.patternBeforeTimeout, t.patternBeforeTimeoutN, t.type);

            template.list = tl;
            
            return requestData.send(transaction);
        }
    }); 
    return false;
}
Template.prototype.proofValidationGetDataFromForm = function(){

    this.proofValidation.state = document.getElementsByName("stateproofValidation")[0].value;
    this.proofValidation.definition = document.getElementsByName("definitionproofValidation")[0].value;    
    this.proofValidation.type = "";
}
Template.prototype.fromValidationGetDataFromForm = function(){

    this.fromValidation.state = document.getElementsByName("statefromValidation")[0].value;
    this.fromValidation.definition = document.getElementsByName("definitionfromValidation")[0].value;    
    this.fromValidation.type = "";
}
Template.prototype.toValidationGetDataFromForm = function(){

    this.toValidation.state = document.getElementsByName("statetoValidation")[0].value;
    this.toValidation.definition = document.getElementsByName("definitiontoValidation")[0].value;    
    this.toValidation.type = "";
}
Template.prototype.fromGetDataFromForm = function(){

        this.from.xpubList = [];
        let selList= document.getElementsByName("xpubListfrom")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.from.xpubList[i] = selList[i].value;
        }   
        this.from.pattern = document.getElementsByName("patternfrom")[0].value;
        this.from.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNfrom")[0].value;                
        this.from.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNfrom")[0].value;
        this.from.amount = document.getElementsByName("amountfrom")[0].value;
        this.from.from = document.getElementsByName("fromfrom")[0].value;
        this.from.state = document.getElementsByName("statefrom")[0].value;
        this.from.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutfrom")[0].value;
        
        if(this.from.patternAfterTimeout == "on") this.from.patternAfterTimeout = true;
        else this.from.patternAfterTimeout = false;
        
        this.from.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutfrom")[0].value;  
        
        if(this.from.patternBeforeTimeout == "on") this.from.patternBeforeTimeout = true;
        else this.from.patternBeforeTimeout = false;
        
        this.from.proof = document.getElementsByName("prooffrom")[0].value;
                
        if(this.from.proof == "on") this.from.proof = true;
        else this.from.proof = false;
        
        this.from.user = document.getElementsByName("userfrom")[0].value;
                
        if(this.from.user == "on") this.from.user = true;
        else this.from.user = false;
        
        this.from.type = "from";
}
Template.prototype.toGetDataFromForm = function(){

        this.to.xpubList = [];
        let selList= document.getElementsByName("xpubListto")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.to.xpubList[i] = selList[i].value;
        }   
        this.to.pattern = document.getElementsByName("patternto")[0].value;
        this.to.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNto")[0].value;                
        this.to.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNto")[0].value;
        this.to.amount = document.getElementsByName("amountto")[0].value;
        this.to.from = document.getElementsByName("fromto")[0].value;
        this.to.state = document.getElementsByName("stateto")[0].value;
        this.to.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutto")[0].value;
        
        if(this.to.patternAfterTimeout == "on") this.to.patternAfterTimeout = true;
        else this.to.patternAfterTimeout = false;
        
        this.to.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutto")[0].value;  
        
        if(this.to.patternBeforeTimeout == "on") this.to.patternBeforeTimeout = true;
        else this.to.patternBeforeTimeout = false;
        
        this.to.proof = document.getElementsByName("proofto")[0].value;
                
        if(this.to.proof == "on") this.to.proof = true;
        else this.to.proof = false;
        
        this.to.user = document.getElementsByName("userto")[0].value;
                
        if(this.to.user == "on") this.to.user = true;
        else this.to.user = false;
        
        this.to.type = "to";
}
Template.prototype.backupGetDataFromForm = function(){

        this.backup.xpubList = [];
        let selList= document.getElementsByName("xpubListbackup")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.backup.xpubList[i] = selList[i].value;
        }   
        this.backup.pattern = document.getElementsByName("patternbackup")[0].value;
        this.backup.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNbackup")[0].value;                
        this.backup.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNbackup")[0].value;
        this.backup.amount = document.getElementsByName("amountbackup")[0].value;
        this.backup.from = document.getElementsByName("frombackup")[0].value;
        this.backup.state = document.getElementsByName("statebackup")[0].value;
        this.backup.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutbackup")[0].value;
        
        if(this.backup.patternAfterTimeout == "on") this.backup.patternAfterTimeout = true;
        else this.backup.patternAfterTimeout = false;
        
        this.backup.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutbackup")[0].value;  
        
        if(this.backup.patternBeforeTimeout == "on") this.backup.patternBeforeTimeout = true;
        else this.backup.patternBeforeTimeout = false;
        
        this.backup.proof = document.getElementsByName("proofbackup")[0].value;
                
        if(this.backup.proof == "on") this.backup.proof = true;
        else this.backup.proof = false;
        
        this.backup.user = document.getElementsByName("userbackup")[0].value;
                
        if(this.backup.user == "on") this.backup.user = true;
        else this.backup.user = false;
        
        this.backup.type = "backup";
}
Template.prototype.lockGetDataFromForm = function(){

        this.lock.xpubList = [];
        let selList= document.getElementsByName("xpubListlock")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.lock.xpubList[i] = selList[i].value;
        }   
        this.lock.pattern = document.getElementsByName("patternlock")[0].value;
        this.lock.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNlock")[0].value;                
        this.lock.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNlock")[0].value;
        this.lock.amount = document.getElementsByName("amountlock")[0].value;
        this.lock.from = document.getElementsByName("fromlock")[0].value;
        this.lock.state = document.getElementsByName("statelock")[0].value;
        this.lock.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutlock")[0].value;
        
        if(this.lock.patternAfterTimeout == "on") this.lock.patternAfterTimeout = true;
        else this.lock.patternAfterTimeout = false;
        
        this.lock.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutlock")[0].value;  
        
        if(this.lock.patternBeforeTimeout == "on") this.lock.patternBeforeTimeout = true;
        else this.lock.patternBeforeTimeout = false;
        
        this.lock.proof = document.getElementsByName("prooflock")[0].value;
                
        if(this.lock.proof == "on") this.lock.proof = true;
        else this.lock.proof = false;
        
        this.lock.user = document.getElementsByName("userlock")[0].value;
                
        if(this.lock.user == "on") this.lock.user = true;
        else this.lock.user = false;
        
        this.lock.type = "lock";
}
Template.prototype.witnessGetDataFromForm = function(){

        this.witness.xpubList = [];
        let selList= document.getElementsByName("xpubListwitness")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.witness.xpubList[i] = selList[i].value;
        }   
        this.witness.pattern = document.getElementsByName("patternwitness")[0].value;
        this.witness.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNwitness")[0].value;                
        this.witness.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNwitness")[0].value;
        this.witness.amount = document.getElementsByName("amountwitness")[0].value;
        this.witness.from = document.getElementsByName("fromwitness")[0].value;
        this.witness.state = document.getElementsByName("statewitness")[0].value;
        this.witness.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutwitness")[0].value;
        
        if(this.witness.patternAfterTimeout == "on") this.witness.patternAfterTimeout = true;
        else this.witness.patternAfterTimeout = false;
        
        this.witness.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutwitness")[0].value;  
        
        if(this.witness.patternBeforeTimeout == "on") this.witness.patternBeforeTimeout = true;
        else this.witness.patternBeforeTimeout = false;
        
        this.witness.proof = document.getElementsByName("proofwitness")[0].value;
                
        if(this.witness.proof == "on") this.witness.proof = true;
        else this.witness.proof = false;
        
        this.witness.user = document.getElementsByName("userwitness")[0].value;
                
        if(this.witness.user == "on") this.witness.user = true;
        else this.witness.user = false;
        
        this.witness.type = "witness";
}
Template.prototype.cosignerGetDataFromForm = function(){

        this.cosigner.xpubList = [];
        let selList= document.getElementsByName("xpubListcosigner")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.cosigner.xpubList[i] = selList[i].value;
        }   
        this.cosigner.pattern = document.getElementsByName("patterncosigner")[0].value;
        this.cosigner.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNcosigner")[0].value;                
        this.cosigner.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNcosigner")[0].value;
        this.cosigner.amount = document.getElementsByName("amountcosigner")[0].value;
        this.cosigner.from = document.getElementsByName("fromcosigner")[0].value;
        this.cosigner.state = document.getElementsByName("statecosigner")[0].value;
        this.cosigner.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutcosigner")[0].value;
        
        if(this.cosigner.patternAfterTimeout == "on") this.cosigner.patternAfterTimeout = true;
        else this.cosigner.patternAfterTimeout = false;
        
        this.cosigner.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutcosigner")[0].value;  
        
        if(this.cosigner.patternBeforeTimeout == "on") this.cosigner.patternBeforeTimeout = true;
        else this.cosigner.patternBeforeTimeout = false;
        
        this.cosigner.proof = document.getElementsByName("proofcosigner")[0].value;
                
        if(this.cosigner.proof == "on") this.cosigner.proof = true;
        else this.cosigner.proof = false;
        
        this.cosigner.user = document.getElementsByName("usercosigner")[0].value;
                
        if(this.cosigner.user == "on") this.cosigner.user = true;
        else this.cosigner.user = false;
        
        this.cosigner.type = "cosigner";
}
Template.prototype.banGetDataFromForm = function(){

        this.ban.xpubList = [];
        let selList= document.getElementsByName("xpubListban")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.ban.xpubList[i] = selList[i].value;
        }   
        this.ban.pattern = document.getElementsByName("patternban")[0].value;
        this.ban.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNban")[0].value;                
        this.ban.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNban")[0].value;
        this.ban.amount = document.getElementsByName("amountban")[0].value;
        this.ban.from = document.getElementsByName("fromban")[0].value;
        this.ban.state = document.getElementsByName("stateban")[0].value;
        this.ban.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutban")[0].value;
        
        if(this.ban.patternAfterTimeout == "on") this.ban.patternAfterTimeout = true;
        else this.ban.patternAfterTimeout = false;
        
        this.ban.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutban")[0].value;  
        
        if(this.ban.patternBeforeTimeout == "on") this.ban.patternBeforeTimeout = true;
        else this.ban.patternBeforeTimeout = false;
        
        this.ban.proof = document.getElementsByName("proofban")[0].value;
                
        if(this.ban.proof == "on") this.ban.proof = true;
        else this.ban.proof = false;
        
        this.ban.user = document.getElementsByName("userban")[0].value;
                
        if(this.ban.user == "on") this.ban.user = true;
        else this.ban.user = false;
        
        this.ban.type = "ban";
}
Template.prototype.oldGetDataFromForm = function(){

        this.old.xpubList = [];
        let selList= document.getElementsByName("xpubListold")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.old.xpubList[i] = selList[i].value;
        }   
        this.old.pattern = document.getElementsByName("patternold")[0].value;
        this.old.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNold")[0].value;                
        this.old.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNold")[0].value;
        this.old.amount = document.getElementsByName("amountold")[0].value;
        this.old.from = document.getElementsByName("fromold")[0].value;
        this.old.state = document.getElementsByName("stateold")[0].value;
        this.old.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutold")[0].value;
        
        if(this.old.patternAfterTimeout == "on") this.old.patternAfterTimeout = true;
        else this.old.patternAfterTimeout = false;
        
        this.old.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutold")[0].value;  
        
        if(this.old.patternBeforeTimeout == "on") this.old.patternBeforeTimeout = true;
        else this.old.patternBeforeTimeout = false;
        
        this.old.proof = document.getElementsByName("proofold")[0].value;
                
        if(this.old.proof == "on") this.old.proof = true;
        else this.old.proof = false;
        
        this.old.user = document.getElementsByName("userold")[0].value;
                
        if(this.old.user == "on") this.old.user = true;
        else this.old.user = false;
        
        this.old.type = "old";
}
Template.prototype.boardGetDataFromForm = function(){

        this.board.xpubList = [];
        let selList= document.getElementsByName("xpubListboard")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.board.xpubList[i] = selList[i].value;
        }   
        this.board.pattern = document.getElementsByName("patternboard")[0].value;
        this.board.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNboard")[0].value;                
        this.board.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNboard")[0].value;
        this.board.amount = document.getElementsByName("amountboard")[0].value;
        this.board.from = document.getElementsByName("fromboard")[0].value;
        this.board.state = document.getElementsByName("stateboard")[0].value;
        this.board.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutboard")[0].value;
        
        if(this.board.patternAfterTimeout == "on") this.board.patternAfterTimeout = true;
        else this.board.patternAfterTimeout = false;
        
        this.board.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutboard")[0].value;  
        
        if(this.board.patternBeforeTimeout == "on") this.board.patternBeforeTimeout = true;
        else this.board.patternBeforeTimeout = false;
        
        this.board.proof = document.getElementsByName("proofboard")[0].value;
                
        if(this.board.proof == "on") this.board.proof = true;
        else this.board.proof = false;
        
        this.board.user = document.getElementsByName("userboard")[0].value;
                
        if(this.board.user == "on") this.board.user = true;
        else this.board.user = false;
        
        this.board.type = "board";
}
Template.prototype.cosignerOrgGetDataFromForm = function(){

        this.cosignerOrg.xpubList = [];
        let selList= document.getElementsByName("xpubListcosignerOrg")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.cosignerOrg.xpubList[i] = selList[i].value;
        }   
        this.cosignerOrg.pattern = document.getElementsByName("patterncosignerOrg")[0].value;
        this.cosignerOrg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNcosignerOrg")[0].value;                
        this.cosignerOrg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNcosignerOrg")[0].value;
        this.cosignerOrg.amount = document.getElementsByName("amountcosignerOrg")[0].value;
        this.cosignerOrg.from = document.getElementsByName("fromcosignerOrg")[0].value;
        this.cosignerOrg.state = document.getElementsByName("statecosignerOrg")[0].value;
        this.cosignerOrg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutcosignerOrg")[0].value;
        
        if(this.cosignerOrg.patternAfterTimeout == "on") this.cosignerOrg.patternAfterTimeout = true;
        else this.cosignerOrg.patternAfterTimeout = false;
        
        this.cosignerOrg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutcosignerOrg")[0].value;  
        
        if(this.cosignerOrg.patternBeforeTimeout == "on") this.cosignerOrg.patternBeforeTimeout = true;
        else this.cosignerOrg.patternBeforeTimeout = false;
        
        this.cosignerOrg.proof = document.getElementsByName("proofcosignerOrg")[0].value;
                
        if(this.cosignerOrg.proof == "on") this.cosignerOrg.proof = true;
        else this.cosignerOrg.proof = false;
        
        this.cosignerOrg.user = document.getElementsByName("usercosignerOrg")[0].value;
                
        if(this.cosignerOrg.user == "on") this.cosignerOrg.user = true;
        else this.cosignerOrg.user = false;
        
        this.cosignerOrg.type = "cosignerOrg";
}
Template.prototype.witnessOrgGetDataFromForm = function(){

        this.witnessOrg.xpubList = [];
        let selList= document.getElementsByName("xpubListwitnessOrg")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.witnessOrg.xpubList[i] = selList[i].value;
        }   
        this.witnessOrg.pattern = document.getElementsByName("patternwitnessOrg")[0].value;
        this.witnessOrg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNwitnessOrg")[0].value;                
        this.witnessOrg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNwitnessOrg")[0].value;
        this.witnessOrg.amount = document.getElementsByName("amountwitnessOrg")[0].value;
        this.witnessOrg.from = document.getElementsByName("fromwitnessOrg")[0].value;
        this.witnessOrg.state = document.getElementsByName("statewitnessOrg")[0].value;
        this.witnessOrg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutwitnessOrg")[0].value;
        
        if(this.witnessOrg.patternAfterTimeout == "on") this.witnessOrg.patternAfterTimeout = true;
        else this.witnessOrg.patternAfterTimeout = false;
        
        this.witnessOrg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutwitnessOrg")[0].value;  
        
        if(this.witnessOrg.patternBeforeTimeout == "on") this.witnessOrg.patternBeforeTimeout = true;
        else this.witnessOrg.patternBeforeTimeout = false;
        
        this.witnessOrg.proof = document.getElementsByName("proofwitnessOrg")[0].value;
                
        if(this.witnessOrg.proof == "on") this.witnessOrg.proof = true;
        else this.witnessOrg.proof = false;
        
        this.witnessOrg.user = document.getElementsByName("userwitnessOrg")[0].value;
                
        if(this.witnessOrg.user == "on") this.witnessOrg.user = true;
        else this.witnessOrg.user = false;
        
        this.witnessOrg.type = "witnessOrg";
}
Template.prototype.parentstype1GetDataFromForm = function(){

        this.parentstype1.xpubList = [];
        let selList= document.getElementsByName("xpubListparentstype1")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.parentstype1.xpubList[i] = selList[i].value;
        }   
        this.parentstype1.pattern = document.getElementsByName("patternparentstype1")[0].value;
        this.parentstype1.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNparentstype1")[0].value;                
        this.parentstype1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNparentstype1")[0].value;
        this.parentstype1.amount = document.getElementsByName("amountparentstype1")[0].value;
        this.parentstype1.from = document.getElementsByName("fromparentstype1")[0].value;
        this.parentstype1.state = document.getElementsByName("stateparentstype1")[0].value;
        this.parentstype1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutparentstype1")[0].value;
        
        if(this.parentstype1.patternAfterTimeout == "on") this.parentstype1.patternAfterTimeout = true;
        else this.parentstype1.patternAfterTimeout = false;
        
        this.parentstype1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutparentstype1")[0].value;  
        
        if(this.parentstype1.patternBeforeTimeout == "on") this.parentstype1.patternBeforeTimeout = true;
        else this.parentstype1.patternBeforeTimeout = false;
        
        this.parentstype1.proof = document.getElementsByName("proofparentstype1")[0].value;
                
        if(this.parentstype1.proof == "on") this.parentstype1.proof = true;
        else this.parentstype1.proof = false;
        
        this.parentstype1.user = document.getElementsByName("userparentstype1")[0].value;
                
        if(this.parentstype1.user == "on") this.parentstype1.user = true;
        else this.parentstype1.user = false;
        
        this.parentstype1.type = "parentstype1";
}
Template.prototype.childstype1GetDataFromForm = function(){

        this.childstype1.xpubList = [];
        let selList= document.getElementsByName("xpubListchildstype1")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.childstype1.xpubList[i] = selList[i].value;
        }   
        this.childstype1.pattern = document.getElementsByName("patternchildstype1")[0].value;
        this.childstype1.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNchildstype1")[0].value;                
        this.childstype1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNchildstype1")[0].value;
        this.childstype1.amount = document.getElementsByName("amountchildstype1")[0].value;
        this.childstype1.from = document.getElementsByName("fromchildstype1")[0].value;
        this.childstype1.state = document.getElementsByName("statechildstype1")[0].value;
        this.childstype1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutchildstype1")[0].value;
        
        if(this.childstype1.patternAfterTimeout == "on") this.childstype1.patternAfterTimeout = true;
        else this.childstype1.patternAfterTimeout = false;
        
        this.childstype1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutchildstype1")[0].value;  
        
        if(this.childstype1.patternBeforeTimeout == "on") this.childstype1.patternBeforeTimeout = true;
        else this.childstype1.patternBeforeTimeout = false;
        
        this.childstype1.proof = document.getElementsByName("proofchildstype1")[0].value;
                
        if(this.childstype1.proof == "on") this.childstype1.proof = true;
        else this.childstype1.proof = false;
        
        this.childstype1.user = document.getElementsByName("userchildstype1")[0].value;
                
        if(this.childstype1.user == "on") this.childstype1.user = true;
        else this.childstype1.user = false;
        
        this.childstype1.type = "childstype1";
}
Template.prototype.investorType1GetDataFromForm = function(){

        this.investorType1.xpubList = [];
        let selList= document.getElementsByName("xpubListinvestorType1")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.investorType1.xpubList[i] = selList[i].value;
        }   
        this.investorType1.pattern = document.getElementsByName("patterninvestorType1")[0].value;
        this.investorType1.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNinvestorType1")[0].value;                
        this.investorType1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNinvestorType1")[0].value;
        this.investorType1.amount = document.getElementsByName("amountinvestorType1")[0].value;
        this.investorType1.from = document.getElementsByName("frominvestorType1")[0].value;
        this.investorType1.state = document.getElementsByName("stateinvestorType1")[0].value;
        this.investorType1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutinvestorType1")[0].value;
        
        if(this.investorType1.patternAfterTimeout == "on") this.investorType1.patternAfterTimeout = true;
        else this.investorType1.patternAfterTimeout = false;
        
        this.investorType1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutinvestorType1")[0].value;  
        
        if(this.investorType1.patternBeforeTimeout == "on") this.investorType1.patternBeforeTimeout = true;
        else this.investorType1.patternBeforeTimeout = false;
        
        this.investorType1.proof = document.getElementsByName("proofinvestorType1")[0].value;
                
        if(this.investorType1.proof == "on") this.investorType1.proof = true;
        else this.investorType1.proof = false;
        
        this.investorType1.user = document.getElementsByName("userinvestorType1")[0].value;
                
        if(this.investorType1.user == "on") this.investorType1.user = true;
        else this.investorType1.user = false;
        
        this.investorType1.type = "investorType1";
}
Template.prototype.blockGetDataFromForm = function(){

        this.block.xpubList = [];
        let selList= document.getElementsByName("xpubListblock")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.block.xpubList[i] = selList[i].value;
        }   
        this.block.pattern = document.getElementsByName("patternblock")[0].value;
        this.block.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNblock")[0].value;                
        this.block.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNblock")[0].value;
        this.block.amount = document.getElementsByName("amountblock")[0].value;
        this.block.from = document.getElementsByName("fromblock")[0].value;
        this.block.state = document.getElementsByName("stateblock")[0].value;
        this.block.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutblock")[0].value;
        
        if(this.block.patternAfterTimeout == "on") this.block.patternAfterTimeout = true;
        else this.block.patternAfterTimeout = false;
        
        this.block.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutblock")[0].value;  
        
        if(this.block.patternBeforeTimeout == "on") this.block.patternBeforeTimeout = true;
        else this.block.patternBeforeTimeout = false;
        
        this.block.proof = document.getElementsByName("proofblock")[0].value;
                
        if(this.block.proof == "on") this.block.proof = true;
        else this.block.proof = false;
        
        this.block.user = document.getElementsByName("userblock")[0].value;
                
        if(this.block.user == "on") this.block.user = true;
        else this.block.user = false;
        
        this.block.type = "block";
}
Template.prototype.pegGetDataFromForm = function(){

        this.peg.xpubList = [];
        let selList= document.getElementsByName("xpubListpeg")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.peg.xpubList[i] = selList[i].value;
        }   
        this.peg.pattern = document.getElementsByName("patternpeg")[0].value;
        this.peg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNpeg")[0].value;                
        this.peg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNpeg")[0].value;
        this.peg.amount = document.getElementsByName("amountpeg")[0].value;
        this.peg.from = document.getElementsByName("frompeg")[0].value;
        this.peg.state = document.getElementsByName("statepeg")[0].value;
        this.peg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutpeg")[0].value;
        
        if(this.peg.patternAfterTimeout == "on") this.peg.patternAfterTimeout = true;
        else this.peg.patternAfterTimeout = false;
        
        this.peg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutpeg")[0].value;  
        
        if(this.peg.patternBeforeTimeout == "on") this.peg.patternBeforeTimeout = true;
        else this.peg.patternBeforeTimeout = false;
        
        this.peg.proof = document.getElementsByName("proofpeg")[0].value;
                
        if(this.peg.proof == "on") this.peg.proof = true;
        else this.peg.proof = false;
        
        this.peg.user = document.getElementsByName("userpeg")[0].value;
                
        if(this.peg.user == "on") this.peg.user = true;
        else this.peg.user = false;
        
        this.peg.type = "peg";
}
