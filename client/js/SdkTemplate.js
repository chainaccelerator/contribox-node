
function Template(amount = 0, role = "owner", domain = "Core", process = "Identifier", blockSignature = false, pegSignature = false, declareAddressFrom = false, declareAddressTo = false, proofEncryption = false, userEncryption = false, templateValidation = "CoreTemplateValidation", proofValidation = {}, fromValidation = {}, toValidation = {}, from = {}, to = {}, backup = {}, lock = {}, witness = {}, cosigner = {}, ban = {}, old = {}, board = {}, cosignerOrg = {}, witnessOrg = {}, parentstype1 = {}, childstype1 = {}, investorType1 = {}, block = {}, peg = {}) {

    this.domains = ["Laeka","Core"];
    this.domainsSubs = {"Laeka":["healthRecord"],"Core":["user","proof"]};
    this.domainsSubsAbouts = {"Laeka":{"healthRecord":["Identifier","Product","Service","Voucher","State","Record","Vote","Act","Payment","Ownership","Contribution"]},"Core":{"proof":["Identifier"],"user":["Identifier"]}}; 
    this.roles = ["Author","Owner","Contributor","ClientPrivate","ClientPublic","Witness","Provider","Distributor","Sponsor","Insurance"];
    this.typeList = ["from","to","backup","lock","cosigner","witness","ban","old","member","board","witnessOrg","cosignerOrg","parentstype1","childstype1","block","peg"];
    this.processes = ["Core","Authorizations","HealthCare","Sells","Finance","Maintenance"];
    this.processesSteps = ["Proposal","Realization","Test","Validation","Advertising","InitialVersion","NewVersion"];
    this.processesStepsAction = ["AskForConfirmationDeclaration","AskForConfirmationBan","AskForConfirmationOutboard","AskForConfirmationOutboard","AskForConfirmationShare","AskForTemplateUpdate","AskForTechnicalInfos"];
    this.list = [{"from":[],"to":[],"name":"default","amount":1.0e-5}];
    this.patterns = ["none","any","all","1","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%"];

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

    let userEncryptionKey = "";
    let proofEncryptionKey = "";
    let u = false;
    
    wallet.list.forEach(function(w) {
    
        if(w.role == "api" ) user = w.account;
    });
    template.list.forEach(function(t) {
    
        if(t.name == "default") {
        
            let templateDefault = t;                    
            let transaction = new Transaction(templateDefault.from, templateDefault.to, templateDefault.name, templateDefault.amount, template, proofEncryptionKey, user, userEncryptionKey);
            transaction.from = template.from;
            transaction.to = template.to;
    
            return requestData.send("default", transaction, this);
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

    this.from.publickeyList = document.getElementsByName("publickeyListfrom")[0].value;
    this.from.pattern = document.getElementsByName("patternfrom")[0].value;
    this.from.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNfrom")[0].value;
    this.from.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNfrom")[0].value;
    this.from.amountBTCMin = document.getElementsByName("amountBTCMinfrom")[0].value;
    this.from.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromfrom")[0].value;
    this.from.state = document.getElementsByName("statefrom")[0].value;
    this.from.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutfrom")[0].value;
    this.from.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutfrom")[0].value;    
    this.from.type = "";
}
Template.prototype.toGetDataFromForm = function(){

    this.to.publickeyList = document.getElementsByName("publickeyListto")[0].value;
    this.to.pattern = document.getElementsByName("patternto")[0].value;
    this.to.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNto")[0].value;
    this.to.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNto")[0].value;
    this.to.amountBTCMin = document.getElementsByName("amountBTCMinto")[0].value;
    this.to.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromto")[0].value;
    this.to.state = document.getElementsByName("stateto")[0].value;
    this.to.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutto")[0].value;
    this.to.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutto")[0].value;    
    this.to.type = "";
}
Template.prototype.backupGetDataFromForm = function(){

    this.backup.publickeyList = document.getElementsByName("publickeyListbackup")[0].value;
    this.backup.pattern = document.getElementsByName("patternbackup")[0].value;
    this.backup.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNbackup")[0].value;
    this.backup.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNbackup")[0].value;
    this.backup.amountBTCMin = document.getElementsByName("amountBTCMinbackup")[0].value;
    this.backup.amountBTCMinFrom = document.getElementsByName("amountBTCMinFrombackup")[0].value;
    this.backup.state = document.getElementsByName("statebackup")[0].value;
    this.backup.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutbackup")[0].value;
    this.backup.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutbackup")[0].value;    
    this.backup.type = "";
}
Template.prototype.lockGetDataFromForm = function(){

    this.lock.publickeyList = document.getElementsByName("publickeyListlock")[0].value;
    this.lock.pattern = document.getElementsByName("patternlock")[0].value;
    this.lock.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNlock")[0].value;
    this.lock.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNlock")[0].value;
    this.lock.amountBTCMin = document.getElementsByName("amountBTCMinlock")[0].value;
    this.lock.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromlock")[0].value;
    this.lock.state = document.getElementsByName("statelock")[0].value;
    this.lock.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutlock")[0].value;
    this.lock.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutlock")[0].value;    
    this.lock.type = "";
}
Template.prototype.witnessGetDataFromForm = function(){

    this.witness.publickeyList = document.getElementsByName("publickeyListwitness")[0].value;
    this.witness.pattern = document.getElementsByName("patternwitness")[0].value;
    this.witness.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNwitness")[0].value;
    this.witness.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNwitness")[0].value;
    this.witness.amountBTCMin = document.getElementsByName("amountBTCMinwitness")[0].value;
    this.witness.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromwitness")[0].value;
    this.witness.state = document.getElementsByName("statewitness")[0].value;
    this.witness.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutwitness")[0].value;
    this.witness.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutwitness")[0].value;    
    this.witness.type = "";
}
Template.prototype.cosignerGetDataFromForm = function(){

    this.cosigner.publickeyList = document.getElementsByName("publickeyListcosigner")[0].value;
    this.cosigner.pattern = document.getElementsByName("patterncosigner")[0].value;
    this.cosigner.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNcosigner")[0].value;
    this.cosigner.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNcosigner")[0].value;
    this.cosigner.amountBTCMin = document.getElementsByName("amountBTCMincosigner")[0].value;
    this.cosigner.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromcosigner")[0].value;
    this.cosigner.state = document.getElementsByName("statecosigner")[0].value;
    this.cosigner.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutcosigner")[0].value;
    this.cosigner.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutcosigner")[0].value;    
    this.cosigner.type = "";
}
Template.prototype.banGetDataFromForm = function(){

    this.ban.publickeyList = document.getElementsByName("publickeyListban")[0].value;
    this.ban.pattern = document.getElementsByName("patternban")[0].value;
    this.ban.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNban")[0].value;
    this.ban.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNban")[0].value;
    this.ban.amountBTCMin = document.getElementsByName("amountBTCMinban")[0].value;
    this.ban.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromban")[0].value;
    this.ban.state = document.getElementsByName("stateban")[0].value;
    this.ban.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutban")[0].value;
    this.ban.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutban")[0].value;    
    this.ban.type = "";
}
Template.prototype.oldGetDataFromForm = function(){

    this.old.publickeyList = document.getElementsByName("publickeyListold")[0].value;
    this.old.pattern = document.getElementsByName("patternold")[0].value;
    this.old.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNold")[0].value;
    this.old.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNold")[0].value;
    this.old.amountBTCMin = document.getElementsByName("amountBTCMinold")[0].value;
    this.old.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromold")[0].value;
    this.old.state = document.getElementsByName("stateold")[0].value;
    this.old.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutold")[0].value;
    this.old.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutold")[0].value;    
    this.old.type = "";
}
Template.prototype.boardGetDataFromForm = function(){

    this.board.publickeyList = document.getElementsByName("publickeyListboard")[0].value;
    this.board.pattern = document.getElementsByName("patternboard")[0].value;
    this.board.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNboard")[0].value;
    this.board.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNboard")[0].value;
    this.board.amountBTCMin = document.getElementsByName("amountBTCMinboard")[0].value;
    this.board.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromboard")[0].value;
    this.board.state = document.getElementsByName("stateboard")[0].value;
    this.board.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutboard")[0].value;
    this.board.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutboard")[0].value;    
    this.board.type = "";
}
Template.prototype.cosignerOrgGetDataFromForm = function(){

    this.cosignerOrg.publickeyList = document.getElementsByName("publickeyListcosignerOrg")[0].value;
    this.cosignerOrg.pattern = document.getElementsByName("patterncosignerOrg")[0].value;
    this.cosignerOrg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNcosignerOrg")[0].value;
    this.cosignerOrg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNcosignerOrg")[0].value;
    this.cosignerOrg.amountBTCMin = document.getElementsByName("amountBTCMincosignerOrg")[0].value;
    this.cosignerOrg.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromcosignerOrg")[0].value;
    this.cosignerOrg.state = document.getElementsByName("statecosignerOrg")[0].value;
    this.cosignerOrg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutcosignerOrg")[0].value;
    this.cosignerOrg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutcosignerOrg")[0].value;    
    this.cosignerOrg.type = "";
}
Template.prototype.witnessOrgGetDataFromForm = function(){

    this.witnessOrg.publickeyList = document.getElementsByName("publickeyListwitnessOrg")[0].value;
    this.witnessOrg.pattern = document.getElementsByName("patternwitnessOrg")[0].value;
    this.witnessOrg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNwitnessOrg")[0].value;
    this.witnessOrg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNwitnessOrg")[0].value;
    this.witnessOrg.amountBTCMin = document.getElementsByName("amountBTCMinwitnessOrg")[0].value;
    this.witnessOrg.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromwitnessOrg")[0].value;
    this.witnessOrg.state = document.getElementsByName("statewitnessOrg")[0].value;
    this.witnessOrg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutwitnessOrg")[0].value;
    this.witnessOrg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutwitnessOrg")[0].value;    
    this.witnessOrg.type = "";
}
Template.prototype.parentstype1GetDataFromForm = function(){

    this.parentstype1.publickeyList = document.getElementsByName("publickeyListparentstype1")[0].value;
    this.parentstype1.pattern = document.getElementsByName("patternparentstype1")[0].value;
    this.parentstype1.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNparentstype1")[0].value;
    this.parentstype1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNparentstype1")[0].value;
    this.parentstype1.amountBTCMin = document.getElementsByName("amountBTCMinparentstype1")[0].value;
    this.parentstype1.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromparentstype1")[0].value;
    this.parentstype1.state = document.getElementsByName("stateparentstype1")[0].value;
    this.parentstype1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutparentstype1")[0].value;
    this.parentstype1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutparentstype1")[0].value;    
    this.parentstype1.type = "";
}
Template.prototype.childstype1GetDataFromForm = function(){

    this.childstype1.publickeyList = document.getElementsByName("publickeyListchildstype1")[0].value;
    this.childstype1.pattern = document.getElementsByName("patternchildstype1")[0].value;
    this.childstype1.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNchildstype1")[0].value;
    this.childstype1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNchildstype1")[0].value;
    this.childstype1.amountBTCMin = document.getElementsByName("amountBTCMinchildstype1")[0].value;
    this.childstype1.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromchildstype1")[0].value;
    this.childstype1.state = document.getElementsByName("statechildstype1")[0].value;
    this.childstype1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutchildstype1")[0].value;
    this.childstype1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutchildstype1")[0].value;    
    this.childstype1.type = "";
}
Template.prototype.investorType1GetDataFromForm = function(){

    this.investorType1.publickeyList = document.getElementsByName("publickeyListinvestorType1")[0].value;
    this.investorType1.pattern = document.getElementsByName("patterninvestorType1")[0].value;
    this.investorType1.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNinvestorType1")[0].value;
    this.investorType1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNinvestorType1")[0].value;
    this.investorType1.amountBTCMin = document.getElementsByName("amountBTCMininvestorType1")[0].value;
    this.investorType1.amountBTCMinFrom = document.getElementsByName("amountBTCMinFrominvestorType1")[0].value;
    this.investorType1.state = document.getElementsByName("stateinvestorType1")[0].value;
    this.investorType1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutinvestorType1")[0].value;
    this.investorType1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutinvestorType1")[0].value;    
    this.investorType1.type = "";
}
Template.prototype.blockGetDataFromForm = function(){

    this.block.publickeyList = document.getElementsByName("publickeyListblock")[0].value;
    this.block.pattern = document.getElementsByName("patternblock")[0].value;
    this.block.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNblock")[0].value;
    this.block.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNblock")[0].value;
    this.block.amountBTCMin = document.getElementsByName("amountBTCMinblock")[0].value;
    this.block.amountBTCMinFrom = document.getElementsByName("amountBTCMinFromblock")[0].value;
    this.block.state = document.getElementsByName("stateblock")[0].value;
    this.block.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutblock")[0].value;
    this.block.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutblock")[0].value;    
    this.block.type = "";
}
Template.prototype.pegGetDataFromForm = function(){

    this.peg.publickeyList = document.getElementsByName("publickeyListpeg")[0].value;
    this.peg.pattern = document.getElementsByName("patternpeg")[0].value;
    this.peg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNpeg")[0].value;
    this.peg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNpeg")[0].value;
    this.peg.amountBTCMin = document.getElementsByName("amountBTCMinpeg")[0].value;
    this.peg.amountBTCMinFrom = document.getElementsByName("amountBTCMinFrompeg")[0].value;
    this.peg.state = document.getElementsByName("statepeg")[0].value;
    this.peg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutpeg")[0].value;
    this.peg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutpeg")[0].value;    
    this.peg.type = "";
}
