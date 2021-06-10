
function Template(role = "owner", domain = "Core", process = "Identifier", templateValidation = "", proofValidation = {}, fromValidation = {}, toValidation = {}, from = {}, to = {}, backup = {}, lock = {}, witness = {}, cosigner = {}, ban = {}, old = {}, board = {}, cosignerOrg = {}, witnessOrg = {}, parentstype1 = {}, childstype1 = {}, investorType1 = {}, block = {}, peg = {}) {

    this.domains = ["Laeka","Core"];
    this.domainsSubs = {"Laeka":["healthRecord"],"Core":["user","proof"]};
    this.domainsSubsAbouts = {"Laeka":{"healthRecord":["Identifier","Product","Service","Voucher","State","Record","Vote","Act","Payment","Ownership","Contribution"]},"Core":{"proof":["Identifier"],"user":["Identifier"]}}; 
    this.roles = ["Author","Owner","Contributor","ClientPrivate","ClientPublic","Witness","Provider","Distributor","Sponsor","Insurance"];
    this.typeList = ["from","to","backup","lock","cosigner","witness","ban","old","member","board","witnessOrg","cosignerOrg","parentstype1","childstype1","block","peg"];
    this.processes = ["Core","Authorizations","HealthCare","Sells","Finance","Maintenance"];
    this.processesSteps = ["Proposal","Realization","Test","Validation","Advertising","InitialVersion","NewVersion"];
    this.processesStepsAction = ["AskForConfirmationDeclaration","AskForConfirmationBan","AskForConfirmationOutboard","AskForConfirmationOutboard","AskForConfirmationShare","AskForTemplateUpdate","AskForTechnicalInfos"];
    this.list = [{"name":"default","amount":1.0e-5,"from":{"xpubList":[],"type":"from","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"to":{"xpubList":[],"type":"to","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""}}];
    this.patterns = ["none","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%"];

	this.role = role;
	this.domain = domain;
	this.process = process;
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

	this.role = document.getElementsByName("role")[0].value;
	this.domain = document.getElementsByName("domain")[0].value;
	this.process = document.getElementsByName("process")[0].value;
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
            
    template.list.forEach(function(t) {
    
        var u = {};
    
        wallet.list.forEach(function(w) {
        
            if(w.role == "api" ) u = w.account;
        });    
        if(t.name == "default") {
                    
            template.getDataFromForm();
            
            var p = JSON.parse(JSON.stringify(template));            
            delete p.domains;
            delete p.domainsSubs;
            delete p.domainsSubsAbouts;
            delete p.roles;
            delete p.typeList;
            delete p.processes;
            delete p.processesSteps;
            delete p.processesStepsAction;
            delete p.list;
            delete p.patterns;
                        
            let trs = new Transaction(JSON.parse(JSON.stringify(p.from.xpubList)), [], "default", 0, JSON.parse(JSON.stringify(p)), JSON.parse(JSON.stringify(u)));
                                    
            console.info("trs", trs);
                    
            return requestData.send(trs);
        }
    }); 
    
    return false;
}
Template.prototype.proofValidationGetDataFromForm = function(){

    this.proofValidation.state = document.getElementsByName("stateproofValidation")[0].value;
    
    if(this.proofValidation.state == "pn") this.proofValidation.state = true;
    else  this.proofValidation.state = false;
    
    this.proofValidation.definition = document.getElementsByName("definitionproofValidation")[0].value;    
    this.proofValidation.type = "";
}
Template.prototype.fromValidationGetDataFromForm = function(){

    this.fromValidation.state = document.getElementsByName("statefromValidation")[0].value;
    
    if(this.fromValidation.state == "pn") this.fromValidation.state = true;
    else  this.fromValidation.state = false;
    
    this.fromValidation.definition = document.getElementsByName("definitionfromValidation")[0].value;    
    this.fromValidation.type = "";
}
Template.prototype.toValidationGetDataFromForm = function(){

    this.toValidation.state = document.getElementsByName("statetoValidation")[0].value;
    
    if(this.toValidation.state == "pn") this.toValidation.state = true;
    else  this.toValidation.state = false;
    
    this.toValidation.definition = document.getElementsByName("definitiontoValidation")[0].value;    
    this.toValidation.type = "";
}
















