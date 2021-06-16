
function Template(role = "owner", domain = "Core", process = "Identifier", templateValidation = "", proofValidation = {}, fromValidation = {}, toValidation = {}, Genesis = {}, api = {}, from = {}, to = {}, backup = {}, lock = {}, cosigner = {}, witness = {}, peg = {}, block = {}, ban = {}, board = {}, member = {}, old = {}, cosignerOrg = {}, witnessOrg = {}, info = {}, parentstype1 = {}, childstype1 = {}, investorType1 = {}) {

    this.domains = ["Laeka","Core"];
    this.domainsSubs = {"Laeka":["healthRecord"],"Core":["user","proof"]};
    this.domainsSubsAbouts = {"Laeka":{"healthRecord":["Identifier","Product","Service","Voucher","State","Record","Vote","Act","Payment","Ownership","Contribution"]},"Core":{"proof":["Identifier"],"user":["Identifier"]}}; 
    this.roles = ["Author","Owner","Contributor","ClientPrivate","ClientPublic","Witness","Provider","Distributor","Sponsor","Insurance"];
    this.typeList = ["Genesis","from","to","backup","lock","cosigner","witness","ban","old","member","board","witnessOrg","cosignerOrg","parentstype1","childstype1","block","peg","investorType1"];
    this.processes = ["Core","Authorizations","HealthCare","Sells","Finance","Maintenance"];
    this.processesSteps = ["Proposal","Realization","Test","Validation","Advertising","InitialVersion","NewVersion"];
    this.processesStepsAction = ["AskForConfirmationDeclaration","AskForConfirmationBan","AskForConfirmationOutboard","AskForConfirmationOutboard","AskForConfirmationShare","AskForTemplateUpdate","AskForTechnicalInfos"];
    this.list = [{"name":"default","amount":1.0e-5,"from":{"xpubList":["c52ea234667f63d384f941149c8af438fb04c94ec2dc0ff066381e690d006184ba055adce53aa8e86358632b3fd96316f2bdc19a3d398cdc6af7a3ffa48fb4fe"],"type":"from","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"to":{"xpubList":["6935e4ab9feb4217c43f9c675585b1345b08a8218b67139fbea953cdb3e36487be48019966e5f61dfe6534fbfcba14f922ca7725102f773e0138fda37183fb72"],"type":"to","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0.0001,"from":"from","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"Genesis":{"xpubList":["4b158879c7f74158a6f7ea7a560af0ccaa83f7b292b274a84a879fd36b041de85d26de1ef2207c2a988c940f63bbb5371d295b5250ba70311d8a51a87f8868de"],"type":"Genesis","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"api":{"xpubList":["bddebd4d8bdf93b7f112a7b0fd72ec3651db0a3b75475d88d87a95d630e93553f654815c0800ad43800e786292705ee07cc5d91fbab3f13d9ead7e36a48dd789"],"type":"api","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"template":{"xpubList":["af6812d78d787ff5d9bdd36a27353f7121341685ff09dbc5f7c0a816725e2cbed69b3539820c4f09301d3df17b63aab8e9eb35590aa0ee4a97b5b38cd069a60b"],"type":"template","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"board","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"ban":{"xpubList":["99b5e68ac877a34327d9518702c94be9b89a8948e8970b9ef40dd44d6b1b234d61cae2046f6204adddbec90708aefbb74f0d40b1cab29828a2e16d1763b88cda"],"type":"ban","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"board","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"board":{"xpubList":["af6812d78d787ff5d9bdd36a27353f7121341685ff09dbc5f7c0a816725e2cbed69b3539820c4f09301d3df17b63aab8e9eb35590aa0ee4a97b5b38cd069a60b"],"type":"board","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0.0001,"from":"from","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"member":{"xpubList":["44647db8193a81b51d8d15b82820051dffc9cb5a073b732177e4e41d59c353ca667e29e7da4577a5c33d6d4cf08f2ed77282a615f0b7d84d6464bf8bdbdd5d0c"],"type":"member","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"board","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"old":{"xpubList":["207296d0b2dcc8d7d4edbbe54fafd97ffd83dd9394a83fa6b375af79efb6724f230e63d1731790956b4bce4a33050a4c6f7670099af2582b401ddeeb96ca1a7d"],"type":"old","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"board","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"onboard":{"xpubList":["af6812d78d787ff5d9bdd36a27353f7121341685ff09dbc5f7c0a816725e2cbed69b3539820c4f09301d3df17b63aab8e9eb35590aa0ee4a97b5b38cd069a60b"],"type":"onboard","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"board","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"outboard":{"xpubList":["af6812d78d787ff5d9bdd36a27353f7121341685ff09dbc5f7c0a816725e2cbed69b3539820c4f09301d3df17b63aab8e9eb35590aa0ee4a97b5b38cd069a60b"],"type":"outboard","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"board","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"cosignerOrg":{"xpubList":["e983e6f5a732784c89831768205b5867bff98dc65f0febfc8bcb3fc90544539d1128b6c773d01cfc547501072bf7c7c2092885b47ceab9b938363a95d53811c6"],"type":"cosignerOrg","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"witnessOrg":{"xpubList":["cc96dfd1442ccc300bcf9c97c28b96b12c339854c45e0ee9bb021232f8a9fe8c5a95a61336c1c1940411e0a36197ef7afd679ea639a33d29e86fb5107a9a3caa"],"type":"witnessOrg","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"cosigner":{"xpubList":["053579d948d25894067af3f301916d6b397092382e1d5e8209d4607edd4c437f722d189e8b7881bfbc1d0fe61b4d8fb5c96ab230fce7e728f786404eb16d2caf"],"type":"cosigner","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"witness":{"xpubList":["31dbf467606302dedc0ca5f820fe0239a9d6c033af54ce4a168e770cb92ae24675e7f4baa615005959c12b58c9a7c9449e57d81a6cef05508f44d03b91d04022"],"type":"witness","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":1.0e-5,"from":"from","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"info":{"xpubList":["19b84e1e571e935f639c58240c2490ebfd08a82082471df4c0e89d814f7deb958440ef7e7b4e9b10b34cb19a19c1f49bbd854fdad87c57ff1ab040346b9b607a"],"type":"info","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"investorType1":{"xpubList":["af6812d78d787ff5d9bdd36a27353f7121341685ff09dbc5f7c0a816725e2cbed69b3539820c4f09301d3df17b63aab8e9eb35590aa0ee4a97b5b38cd069a60b"],"type":"investorType1","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"parentstype1":{"xpubList":["c1008f0451a882598a5704b3c8156947b74bf4b6082114b389e969b5b1bc74b914e7c7933fcdb15c7dc936e418ab7f16792987efb5a72512c5f72867eaec7acf"],"type":"parentstype1","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"childstype1":{"xpubList":["88237d40db98db258f25f6b9a9eba615a0d05261d51a71efeb0dcfe8511f9244e773ba4e7ab7606cf781353e50492ab2592f9c83542af91d5c7eca7a0e8d4208"],"type":"childstype1","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"peg":{"xpubList":["fb6e6806272cecc62a4060a3981fe27dd605eacb8a390629a038d4b31e19f1279fc590df6e5a8618d8d634f96427f1266018425f2bf9892ddc59031634065ca2"],"type":"peg","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"block":{"xpubList":["58e79fec28763c6df2290a411213d29b645bcd0f039a0ae7adafa10b2cc7159574810b5db3c4885b70ce096ed467698c1443265b48e085569da5a53bbdb2772a"],"type":"block","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":false,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"backup":{"xpubList":["6b0d4c1db36f38b44b882c7366cc0dcff48c0199e09eb1f4bd97bb35f6b11af4b749faf6ab62be1099f3a0337cbf2d40fe2ae6629b76143f988f2edfd5713122"],"type":"backup","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":1.0e-5,"from":"from","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""},"lock":{"xpubList":["bf66bb59775e761887afbb7141d58c862c290908c63790ae4b4c66ed30acdab756816f452dd09f15b114d5cec536247bfe15c6c7b2536e497cc6275ec23170d7"],"type":"lock","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":1.0e-5,"from":"from","state":true,"proofSharing":true,"userProofSharing":true,"htmlFieldsId":[],"htmlScript":""}}];
    this.patterns = ["none","1%","2%","3%","4%","5%","6%","7%","8%","9%","10%","11%","12%","13%","14%","15%","16%","17%","18%","19%","20%","21%","22%","23%","24%","25%","26%","27%","28%","29%","30%","31%","32%","33%","34%","35%","36%","37%","38%","39%","40%","41%","42%","43%","44%","45%","46%","47%","48%","49%","50%","51%","52%","53%","54%","55%","56%","57%","58%","59%","60%","61%","62%","63%","64%","65%","66%","67%","68%","69%","70%","71%","72%","73%","74%","75%","76%","77%","78%","79%","80%","81%","82%","83%","84%","85%","86%","87%","88%","89%","90%","91%","92%","93%","94%","95%","96%","97%","98%","99%"];

	this.role = role;
	this.domain = domain;
	this.process = process;
	this.templateValidation = templateValidation;

    this.proofValidation = proofValidation;
    this.fromValidation = fromValidation;
    this.toValidation = toValidation;
    this.Genesis = Genesis;
this.api = api;
this.from = from;
this.to = to;
this.backup = backup;
this.lock = lock;
this.cosigner = cosigner;
this.witness = witness;
this.peg = peg;
this.block = block;
this.ban = ban;
this.board = board;
this.member = member;
this.old = old;
this.cosignerOrg = cosignerOrg;
this.witnessOrg = witnessOrg;
this.info = info;
this.parentstype1 = parentstype1;
this.childstype1 = childstype1;
this.investorType1 = investorType1;

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
    this.GenesisGetDataFromForm();
this.apiGetDataFromForm();
this.fromGetDataFromForm();
this.toGetDataFromForm();
this.backupGetDataFromForm();
this.lockGetDataFromForm();
this.cosignerGetDataFromForm();
this.witnessGetDataFromForm();
this.pegGetDataFromForm();
this.blockGetDataFromForm();
this.banGetDataFromForm();
this.boardGetDataFromForm();
this.memberGetDataFromForm();
this.oldGetDataFromForm();
this.cosignerOrgGetDataFromForm();
this.witnessOrgGetDataFromForm();
this.infoGetDataFromForm();
this.parentstype1GetDataFromForm();
this.childstype1GetDataFromForm();
this.investorType1GetDataFromForm();

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
Template.prototype.GenesisGetDataFromForm = function(){

        this.Genesis.xpubList = [];
        let selList= document.getElementsByName("xpubListGenesis")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.Genesis.xpubList[i] = selList[i].value;
        }   
        this.Genesis.pattern = document.getElementsByName("patternGenesis")[0].value;
        
        this.Genesis.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNGenesis")[0].value;
        this.Genesis.patternAfterTimeoutN = parseInt(this.Genesis.patternAfterTimeoutN);
                        
        this.Genesis.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNGenesis")[0].value;
        this.Genesis.patternBeforeTimeoutN = parseInt(this.Genesis.patternBeforeTimeoutN);
        
        this.Genesis.amount = document.getElementsByName("amountGenesis")[0].value;
        this.Genesis.amount = parseInt(this.Genesis.amount);
        
        this.Genesis.from = document.getElementsByName("fromGenesis")[0].value;
        
        this.Genesis.state = document.getElementsByName("stateGenesis")[0].value;
        if(this.Genesis.state == "on") this.Genesis.state = true;
        else this.Genesis.state = false;
        
        this.Genesis.proofSharing = document.getElementsByName("proofSharingGenesis")[0].value;
        if(this.Genesis.proofSharing == "on") this.Genesis.proofSharing = true;
        else this.Genesis.proofSharing = false;
        
        this.Genesis.userProofSharing = document.getElementsByName("userProofSharingGenesis")[0].value;
        if(this.Genesis.userProofSharing == "on") this.Genesis.userProofSharing = true;
        else this.Genesis.userProofSharing = false;
        
        if(this.Genesis.patternAfterTimeout == true) this.Genesis.patternAfterTimeout = true;
        else this.Genesis.patternAfterTimeout = false;
        
        this.Genesis.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutGenesis")[0].value;
        
        if(this.Genesis.patternAfterTimeout == true) this.Genesis.patternAfterTimeout = true;
        else this.Genesis.patternAfterTimeout = false;
        
        this.Genesis.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutGenesis")[0].value;  
        
        if(this.Genesis.patternBeforeTimeout == true) this.Genesis.patternBeforeTimeout = true;
        else this.Genesis.patternBeforeTimeout = false;
        
        this.Genesis.type = "Genesis";
}
Template.prototype.apiGetDataFromForm = function(){

        this.api.xpubList = [];
        let selList= document.getElementsByName("xpubListapi")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.api.xpubList[i] = selList[i].value;
        }   
        this.api.pattern = document.getElementsByName("patternapi")[0].value;
        
        this.api.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNapi")[0].value;
        this.api.patternAfterTimeoutN = parseInt(this.api.patternAfterTimeoutN);
                        
        this.api.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNapi")[0].value;
        this.api.patternBeforeTimeoutN = parseInt(this.api.patternBeforeTimeoutN);
        
        this.api.amount = document.getElementsByName("amountapi")[0].value;
        this.api.amount = parseInt(this.api.amount);
        
        this.api.from = document.getElementsByName("fromapi")[0].value;
        
        this.api.state = document.getElementsByName("stateapi")[0].value;
        if(this.api.state == "on") this.api.state = true;
        else this.api.state = false;
        
        this.api.proofSharing = document.getElementsByName("proofSharingapi")[0].value;
        if(this.api.proofSharing == "on") this.api.proofSharing = true;
        else this.api.proofSharing = false;
        
        this.api.userProofSharing = document.getElementsByName("userProofSharingapi")[0].value;
        if(this.api.userProofSharing == "on") this.api.userProofSharing = true;
        else this.api.userProofSharing = false;
        
        if(this.api.patternAfterTimeout == true) this.api.patternAfterTimeout = true;
        else this.api.patternAfterTimeout = false;
        
        this.api.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutapi")[0].value;
        
        if(this.api.patternAfterTimeout == true) this.api.patternAfterTimeout = true;
        else this.api.patternAfterTimeout = false;
        
        this.api.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutapi")[0].value;  
        
        if(this.api.patternBeforeTimeout == true) this.api.patternBeforeTimeout = true;
        else this.api.patternBeforeTimeout = false;
        
        this.api.type = "api";
}
Template.prototype.fromGetDataFromForm = function(){

        this.from.xpubList = [];
        let selList= document.getElementsByName("xpubListfrom")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.from.xpubList[i] = selList[i].value;
        }   
        this.from.pattern = document.getElementsByName("patternfrom")[0].value;
        
        this.from.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNfrom")[0].value;
        this.from.patternAfterTimeoutN = parseInt(this.from.patternAfterTimeoutN);
                        
        this.from.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNfrom")[0].value;
        this.from.patternBeforeTimeoutN = parseInt(this.from.patternBeforeTimeoutN);
        
        this.from.amount = document.getElementsByName("amountfrom")[0].value;
        this.from.amount = parseInt(this.from.amount);
        
        this.from.from = document.getElementsByName("fromfrom")[0].value;
        
        this.from.state = document.getElementsByName("statefrom")[0].value;
        if(this.from.state == "on") this.from.state = true;
        else this.from.state = false;
        
        this.from.proofSharing = document.getElementsByName("proofSharingfrom")[0].value;
        if(this.from.proofSharing == "on") this.from.proofSharing = true;
        else this.from.proofSharing = false;
        
        this.from.userProofSharing = document.getElementsByName("userProofSharingfrom")[0].value;
        if(this.from.userProofSharing == "on") this.from.userProofSharing = true;
        else this.from.userProofSharing = false;
        
        if(this.from.patternAfterTimeout == true) this.from.patternAfterTimeout = true;
        else this.from.patternAfterTimeout = false;
        
        this.from.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutfrom")[0].value;
        
        if(this.from.patternAfterTimeout == true) this.from.patternAfterTimeout = true;
        else this.from.patternAfterTimeout = false;
        
        this.from.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutfrom")[0].value;  
        
        if(this.from.patternBeforeTimeout == true) this.from.patternBeforeTimeout = true;
        else this.from.patternBeforeTimeout = false;
        
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
        this.to.patternAfterTimeoutN = parseInt(this.to.patternAfterTimeoutN);
                        
        this.to.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNto")[0].value;
        this.to.patternBeforeTimeoutN = parseInt(this.to.patternBeforeTimeoutN);
        
        this.to.amount = document.getElementsByName("amountto")[0].value;
        this.to.amount = parseInt(this.to.amount);
        
        this.to.from = document.getElementsByName("fromto")[0].value;
        
        this.to.state = document.getElementsByName("stateto")[0].value;
        if(this.to.state == "on") this.to.state = true;
        else this.to.state = false;
        
        this.to.proofSharing = document.getElementsByName("proofSharingto")[0].value;
        if(this.to.proofSharing == "on") this.to.proofSharing = true;
        else this.to.proofSharing = false;
        
        this.to.userProofSharing = document.getElementsByName("userProofSharingto")[0].value;
        if(this.to.userProofSharing == "on") this.to.userProofSharing = true;
        else this.to.userProofSharing = false;
        
        if(this.to.patternAfterTimeout == true) this.to.patternAfterTimeout = true;
        else this.to.patternAfterTimeout = false;
        
        this.to.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutto")[0].value;
        
        if(this.to.patternAfterTimeout == true) this.to.patternAfterTimeout = true;
        else this.to.patternAfterTimeout = false;
        
        this.to.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutto")[0].value;  
        
        if(this.to.patternBeforeTimeout == true) this.to.patternBeforeTimeout = true;
        else this.to.patternBeforeTimeout = false;
        
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
        this.backup.patternAfterTimeoutN = parseInt(this.backup.patternAfterTimeoutN);
                        
        this.backup.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNbackup")[0].value;
        this.backup.patternBeforeTimeoutN = parseInt(this.backup.patternBeforeTimeoutN);
        
        this.backup.amount = document.getElementsByName("amountbackup")[0].value;
        this.backup.amount = parseInt(this.backup.amount);
        
        this.backup.from = document.getElementsByName("frombackup")[0].value;
        
        this.backup.state = document.getElementsByName("statebackup")[0].value;
        if(this.backup.state == "on") this.backup.state = true;
        else this.backup.state = false;
        
        this.backup.proofSharing = document.getElementsByName("proofSharingbackup")[0].value;
        if(this.backup.proofSharing == "on") this.backup.proofSharing = true;
        else this.backup.proofSharing = false;
        
        this.backup.userProofSharing = document.getElementsByName("userProofSharingbackup")[0].value;
        if(this.backup.userProofSharing == "on") this.backup.userProofSharing = true;
        else this.backup.userProofSharing = false;
        
        if(this.backup.patternAfterTimeout == true) this.backup.patternAfterTimeout = true;
        else this.backup.patternAfterTimeout = false;
        
        this.backup.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutbackup")[0].value;
        
        if(this.backup.patternAfterTimeout == true) this.backup.patternAfterTimeout = true;
        else this.backup.patternAfterTimeout = false;
        
        this.backup.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutbackup")[0].value;  
        
        if(this.backup.patternBeforeTimeout == true) this.backup.patternBeforeTimeout = true;
        else this.backup.patternBeforeTimeout = false;
        
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
        this.lock.patternAfterTimeoutN = parseInt(this.lock.patternAfterTimeoutN);
                        
        this.lock.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNlock")[0].value;
        this.lock.patternBeforeTimeoutN = parseInt(this.lock.patternBeforeTimeoutN);
        
        this.lock.amount = document.getElementsByName("amountlock")[0].value;
        this.lock.amount = parseInt(this.lock.amount);
        
        this.lock.from = document.getElementsByName("fromlock")[0].value;
        
        this.lock.state = document.getElementsByName("statelock")[0].value;
        if(this.lock.state == "on") this.lock.state = true;
        else this.lock.state = false;
        
        this.lock.proofSharing = document.getElementsByName("proofSharinglock")[0].value;
        if(this.lock.proofSharing == "on") this.lock.proofSharing = true;
        else this.lock.proofSharing = false;
        
        this.lock.userProofSharing = document.getElementsByName("userProofSharinglock")[0].value;
        if(this.lock.userProofSharing == "on") this.lock.userProofSharing = true;
        else this.lock.userProofSharing = false;
        
        if(this.lock.patternAfterTimeout == true) this.lock.patternAfterTimeout = true;
        else this.lock.patternAfterTimeout = false;
        
        this.lock.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutlock")[0].value;
        
        if(this.lock.patternAfterTimeout == true) this.lock.patternAfterTimeout = true;
        else this.lock.patternAfterTimeout = false;
        
        this.lock.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutlock")[0].value;  
        
        if(this.lock.patternBeforeTimeout == true) this.lock.patternBeforeTimeout = true;
        else this.lock.patternBeforeTimeout = false;
        
        this.lock.type = "lock";
}
Template.prototype.cosignerGetDataFromForm = function(){

        this.cosigner.xpubList = [];
        let selList= document.getElementsByName("xpubListcosigner")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.cosigner.xpubList[i] = selList[i].value;
        }   
        this.cosigner.pattern = document.getElementsByName("patterncosigner")[0].value;
        
        this.cosigner.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNcosigner")[0].value;
        this.cosigner.patternAfterTimeoutN = parseInt(this.cosigner.patternAfterTimeoutN);
                        
        this.cosigner.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNcosigner")[0].value;
        this.cosigner.patternBeforeTimeoutN = parseInt(this.cosigner.patternBeforeTimeoutN);
        
        this.cosigner.amount = document.getElementsByName("amountcosigner")[0].value;
        this.cosigner.amount = parseInt(this.cosigner.amount);
        
        this.cosigner.from = document.getElementsByName("fromcosigner")[0].value;
        
        this.cosigner.state = document.getElementsByName("statecosigner")[0].value;
        if(this.cosigner.state == "on") this.cosigner.state = true;
        else this.cosigner.state = false;
        
        this.cosigner.proofSharing = document.getElementsByName("proofSharingcosigner")[0].value;
        if(this.cosigner.proofSharing == "on") this.cosigner.proofSharing = true;
        else this.cosigner.proofSharing = false;
        
        this.cosigner.userProofSharing = document.getElementsByName("userProofSharingcosigner")[0].value;
        if(this.cosigner.userProofSharing == "on") this.cosigner.userProofSharing = true;
        else this.cosigner.userProofSharing = false;
        
        if(this.cosigner.patternAfterTimeout == true) this.cosigner.patternAfterTimeout = true;
        else this.cosigner.patternAfterTimeout = false;
        
        this.cosigner.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutcosigner")[0].value;
        
        if(this.cosigner.patternAfterTimeout == true) this.cosigner.patternAfterTimeout = true;
        else this.cosigner.patternAfterTimeout = false;
        
        this.cosigner.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutcosigner")[0].value;  
        
        if(this.cosigner.patternBeforeTimeout == true) this.cosigner.patternBeforeTimeout = true;
        else this.cosigner.patternBeforeTimeout = false;
        
        this.cosigner.type = "cosigner";
}
Template.prototype.witnessGetDataFromForm = function(){

        this.witness.xpubList = [];
        let selList= document.getElementsByName("xpubListwitness")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.witness.xpubList[i] = selList[i].value;
        }   
        this.witness.pattern = document.getElementsByName("patternwitness")[0].value;
        
        this.witness.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNwitness")[0].value;
        this.witness.patternAfterTimeoutN = parseInt(this.witness.patternAfterTimeoutN);
                        
        this.witness.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNwitness")[0].value;
        this.witness.patternBeforeTimeoutN = parseInt(this.witness.patternBeforeTimeoutN);
        
        this.witness.amount = document.getElementsByName("amountwitness")[0].value;
        this.witness.amount = parseInt(this.witness.amount);
        
        this.witness.from = document.getElementsByName("fromwitness")[0].value;
        
        this.witness.state = document.getElementsByName("statewitness")[0].value;
        if(this.witness.state == "on") this.witness.state = true;
        else this.witness.state = false;
        
        this.witness.proofSharing = document.getElementsByName("proofSharingwitness")[0].value;
        if(this.witness.proofSharing == "on") this.witness.proofSharing = true;
        else this.witness.proofSharing = false;
        
        this.witness.userProofSharing = document.getElementsByName("userProofSharingwitness")[0].value;
        if(this.witness.userProofSharing == "on") this.witness.userProofSharing = true;
        else this.witness.userProofSharing = false;
        
        if(this.witness.patternAfterTimeout == true) this.witness.patternAfterTimeout = true;
        else this.witness.patternAfterTimeout = false;
        
        this.witness.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutwitness")[0].value;
        
        if(this.witness.patternAfterTimeout == true) this.witness.patternAfterTimeout = true;
        else this.witness.patternAfterTimeout = false;
        
        this.witness.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutwitness")[0].value;  
        
        if(this.witness.patternBeforeTimeout == true) this.witness.patternBeforeTimeout = true;
        else this.witness.patternBeforeTimeout = false;
        
        this.witness.type = "witness";
}
Template.prototype.pegGetDataFromForm = function(){

        this.peg.xpubList = [];
        let selList= document.getElementsByName("xpubListpeg")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.peg.xpubList[i] = selList[i].value;
        }   
        this.peg.pattern = document.getElementsByName("patternpeg")[0].value;
        
        this.peg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNpeg")[0].value;
        this.peg.patternAfterTimeoutN = parseInt(this.peg.patternAfterTimeoutN);
                        
        this.peg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNpeg")[0].value;
        this.peg.patternBeforeTimeoutN = parseInt(this.peg.patternBeforeTimeoutN);
        
        this.peg.amount = document.getElementsByName("amountpeg")[0].value;
        this.peg.amount = parseInt(this.peg.amount);
        
        this.peg.from = document.getElementsByName("frompeg")[0].value;
        
        this.peg.state = document.getElementsByName("statepeg")[0].value;
        if(this.peg.state == "on") this.peg.state = true;
        else this.peg.state = false;
        
        this.peg.proofSharing = document.getElementsByName("proofSharingpeg")[0].value;
        if(this.peg.proofSharing == "on") this.peg.proofSharing = true;
        else this.peg.proofSharing = false;
        
        this.peg.userProofSharing = document.getElementsByName("userProofSharingpeg")[0].value;
        if(this.peg.userProofSharing == "on") this.peg.userProofSharing = true;
        else this.peg.userProofSharing = false;
        
        if(this.peg.patternAfterTimeout == true) this.peg.patternAfterTimeout = true;
        else this.peg.patternAfterTimeout = false;
        
        this.peg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutpeg")[0].value;
        
        if(this.peg.patternAfterTimeout == true) this.peg.patternAfterTimeout = true;
        else this.peg.patternAfterTimeout = false;
        
        this.peg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutpeg")[0].value;  
        
        if(this.peg.patternBeforeTimeout == true) this.peg.patternBeforeTimeout = true;
        else this.peg.patternBeforeTimeout = false;
        
        this.peg.type = "peg";
}
Template.prototype.blockGetDataFromForm = function(){

        this.block.xpubList = [];
        let selList= document.getElementsByName("xpubListblock")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.block.xpubList[i] = selList[i].value;
        }   
        this.block.pattern = document.getElementsByName("patternblock")[0].value;
        
        this.block.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNblock")[0].value;
        this.block.patternAfterTimeoutN = parseInt(this.block.patternAfterTimeoutN);
                        
        this.block.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNblock")[0].value;
        this.block.patternBeforeTimeoutN = parseInt(this.block.patternBeforeTimeoutN);
        
        this.block.amount = document.getElementsByName("amountblock")[0].value;
        this.block.amount = parseInt(this.block.amount);
        
        this.block.from = document.getElementsByName("fromblock")[0].value;
        
        this.block.state = document.getElementsByName("stateblock")[0].value;
        if(this.block.state == "on") this.block.state = true;
        else this.block.state = false;
        
        this.block.proofSharing = document.getElementsByName("proofSharingblock")[0].value;
        if(this.block.proofSharing == "on") this.block.proofSharing = true;
        else this.block.proofSharing = false;
        
        this.block.userProofSharing = document.getElementsByName("userProofSharingblock")[0].value;
        if(this.block.userProofSharing == "on") this.block.userProofSharing = true;
        else this.block.userProofSharing = false;
        
        if(this.block.patternAfterTimeout == true) this.block.patternAfterTimeout = true;
        else this.block.patternAfterTimeout = false;
        
        this.block.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutblock")[0].value;
        
        if(this.block.patternAfterTimeout == true) this.block.patternAfterTimeout = true;
        else this.block.patternAfterTimeout = false;
        
        this.block.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutblock")[0].value;  
        
        if(this.block.patternBeforeTimeout == true) this.block.patternBeforeTimeout = true;
        else this.block.patternBeforeTimeout = false;
        
        this.block.type = "block";
}
Template.prototype.banGetDataFromForm = function(){

        this.ban.xpubList = [];
        let selList= document.getElementsByName("xpubListban")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.ban.xpubList[i] = selList[i].value;
        }   
        this.ban.pattern = document.getElementsByName("patternban")[0].value;
        
        this.ban.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNban")[0].value;
        this.ban.patternAfterTimeoutN = parseInt(this.ban.patternAfterTimeoutN);
                        
        this.ban.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNban")[0].value;
        this.ban.patternBeforeTimeoutN = parseInt(this.ban.patternBeforeTimeoutN);
        
        this.ban.amount = document.getElementsByName("amountban")[0].value;
        this.ban.amount = parseInt(this.ban.amount);
        
        this.ban.from = document.getElementsByName("fromban")[0].value;
        
        this.ban.state = document.getElementsByName("stateban")[0].value;
        if(this.ban.state == "on") this.ban.state = true;
        else this.ban.state = false;
        
        this.ban.proofSharing = document.getElementsByName("proofSharingban")[0].value;
        if(this.ban.proofSharing == "on") this.ban.proofSharing = true;
        else this.ban.proofSharing = false;
        
        this.ban.userProofSharing = document.getElementsByName("userProofSharingban")[0].value;
        if(this.ban.userProofSharing == "on") this.ban.userProofSharing = true;
        else this.ban.userProofSharing = false;
        
        if(this.ban.patternAfterTimeout == true) this.ban.patternAfterTimeout = true;
        else this.ban.patternAfterTimeout = false;
        
        this.ban.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutban")[0].value;
        
        if(this.ban.patternAfterTimeout == true) this.ban.patternAfterTimeout = true;
        else this.ban.patternAfterTimeout = false;
        
        this.ban.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutban")[0].value;  
        
        if(this.ban.patternBeforeTimeout == true) this.ban.patternBeforeTimeout = true;
        else this.ban.patternBeforeTimeout = false;
        
        this.ban.type = "ban";
}
Template.prototype.boardGetDataFromForm = function(){

        this.board.xpubList = [];
        let selList= document.getElementsByName("xpubListboard")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.board.xpubList[i] = selList[i].value;
        }   
        this.board.pattern = document.getElementsByName("patternboard")[0].value;
        
        this.board.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNboard")[0].value;
        this.board.patternAfterTimeoutN = parseInt(this.board.patternAfterTimeoutN);
                        
        this.board.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNboard")[0].value;
        this.board.patternBeforeTimeoutN = parseInt(this.board.patternBeforeTimeoutN);
        
        this.board.amount = document.getElementsByName("amountboard")[0].value;
        this.board.amount = parseInt(this.board.amount);
        
        this.board.from = document.getElementsByName("fromboard")[0].value;
        
        this.board.state = document.getElementsByName("stateboard")[0].value;
        if(this.board.state == "on") this.board.state = true;
        else this.board.state = false;
        
        this.board.proofSharing = document.getElementsByName("proofSharingboard")[0].value;
        if(this.board.proofSharing == "on") this.board.proofSharing = true;
        else this.board.proofSharing = false;
        
        this.board.userProofSharing = document.getElementsByName("userProofSharingboard")[0].value;
        if(this.board.userProofSharing == "on") this.board.userProofSharing = true;
        else this.board.userProofSharing = false;
        
        if(this.board.patternAfterTimeout == true) this.board.patternAfterTimeout = true;
        else this.board.patternAfterTimeout = false;
        
        this.board.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutboard")[0].value;
        
        if(this.board.patternAfterTimeout == true) this.board.patternAfterTimeout = true;
        else this.board.patternAfterTimeout = false;
        
        this.board.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutboard")[0].value;  
        
        if(this.board.patternBeforeTimeout == true) this.board.patternBeforeTimeout = true;
        else this.board.patternBeforeTimeout = false;
        
        this.board.type = "board";
}
Template.prototype.memberGetDataFromForm = function(){

        this.member.xpubList = [];
        let selList= document.getElementsByName("xpubListmember")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.member.xpubList[i] = selList[i].value;
        }   
        this.member.pattern = document.getElementsByName("patternmember")[0].value;
        
        this.member.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNmember")[0].value;
        this.member.patternAfterTimeoutN = parseInt(this.member.patternAfterTimeoutN);
                        
        this.member.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNmember")[0].value;
        this.member.patternBeforeTimeoutN = parseInt(this.member.patternBeforeTimeoutN);
        
        this.member.amount = document.getElementsByName("amountmember")[0].value;
        this.member.amount = parseInt(this.member.amount);
        
        this.member.from = document.getElementsByName("frommember")[0].value;
        
        this.member.state = document.getElementsByName("statemember")[0].value;
        if(this.member.state == "on") this.member.state = true;
        else this.member.state = false;
        
        this.member.proofSharing = document.getElementsByName("proofSharingmember")[0].value;
        if(this.member.proofSharing == "on") this.member.proofSharing = true;
        else this.member.proofSharing = false;
        
        this.member.userProofSharing = document.getElementsByName("userProofSharingmember")[0].value;
        if(this.member.userProofSharing == "on") this.member.userProofSharing = true;
        else this.member.userProofSharing = false;
        
        if(this.member.patternAfterTimeout == true) this.member.patternAfterTimeout = true;
        else this.member.patternAfterTimeout = false;
        
        this.member.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutmember")[0].value;
        
        if(this.member.patternAfterTimeout == true) this.member.patternAfterTimeout = true;
        else this.member.patternAfterTimeout = false;
        
        this.member.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutmember")[0].value;  
        
        if(this.member.patternBeforeTimeout == true) this.member.patternBeforeTimeout = true;
        else this.member.patternBeforeTimeout = false;
        
        this.member.type = "member";
}
Template.prototype.oldGetDataFromForm = function(){

        this.old.xpubList = [];
        let selList= document.getElementsByName("xpubListold")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.old.xpubList[i] = selList[i].value;
        }   
        this.old.pattern = document.getElementsByName("patternold")[0].value;
        
        this.old.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNold")[0].value;
        this.old.patternAfterTimeoutN = parseInt(this.old.patternAfterTimeoutN);
                        
        this.old.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNold")[0].value;
        this.old.patternBeforeTimeoutN = parseInt(this.old.patternBeforeTimeoutN);
        
        this.old.amount = document.getElementsByName("amountold")[0].value;
        this.old.amount = parseInt(this.old.amount);
        
        this.old.from = document.getElementsByName("fromold")[0].value;
        
        this.old.state = document.getElementsByName("stateold")[0].value;
        if(this.old.state == "on") this.old.state = true;
        else this.old.state = false;
        
        this.old.proofSharing = document.getElementsByName("proofSharingold")[0].value;
        if(this.old.proofSharing == "on") this.old.proofSharing = true;
        else this.old.proofSharing = false;
        
        this.old.userProofSharing = document.getElementsByName("userProofSharingold")[0].value;
        if(this.old.userProofSharing == "on") this.old.userProofSharing = true;
        else this.old.userProofSharing = false;
        
        if(this.old.patternAfterTimeout == true) this.old.patternAfterTimeout = true;
        else this.old.patternAfterTimeout = false;
        
        this.old.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutold")[0].value;
        
        if(this.old.patternAfterTimeout == true) this.old.patternAfterTimeout = true;
        else this.old.patternAfterTimeout = false;
        
        this.old.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutold")[0].value;  
        
        if(this.old.patternBeforeTimeout == true) this.old.patternBeforeTimeout = true;
        else this.old.patternBeforeTimeout = false;
        
        this.old.type = "old";
}
Template.prototype.cosignerOrgGetDataFromForm = function(){

        this.cosignerOrg.xpubList = [];
        let selList= document.getElementsByName("xpubListcosignerOrg")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.cosignerOrg.xpubList[i] = selList[i].value;
        }   
        this.cosignerOrg.pattern = document.getElementsByName("patterncosignerOrg")[0].value;
        
        this.cosignerOrg.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNcosignerOrg")[0].value;
        this.cosignerOrg.patternAfterTimeoutN = parseInt(this.cosignerOrg.patternAfterTimeoutN);
                        
        this.cosignerOrg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNcosignerOrg")[0].value;
        this.cosignerOrg.patternBeforeTimeoutN = parseInt(this.cosignerOrg.patternBeforeTimeoutN);
        
        this.cosignerOrg.amount = document.getElementsByName("amountcosignerOrg")[0].value;
        this.cosignerOrg.amount = parseInt(this.cosignerOrg.amount);
        
        this.cosignerOrg.from = document.getElementsByName("fromcosignerOrg")[0].value;
        
        this.cosignerOrg.state = document.getElementsByName("statecosignerOrg")[0].value;
        if(this.cosignerOrg.state == "on") this.cosignerOrg.state = true;
        else this.cosignerOrg.state = false;
        
        this.cosignerOrg.proofSharing = document.getElementsByName("proofSharingcosignerOrg")[0].value;
        if(this.cosignerOrg.proofSharing == "on") this.cosignerOrg.proofSharing = true;
        else this.cosignerOrg.proofSharing = false;
        
        this.cosignerOrg.userProofSharing = document.getElementsByName("userProofSharingcosignerOrg")[0].value;
        if(this.cosignerOrg.userProofSharing == "on") this.cosignerOrg.userProofSharing = true;
        else this.cosignerOrg.userProofSharing = false;
        
        if(this.cosignerOrg.patternAfterTimeout == true) this.cosignerOrg.patternAfterTimeout = true;
        else this.cosignerOrg.patternAfterTimeout = false;
        
        this.cosignerOrg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutcosignerOrg")[0].value;
        
        if(this.cosignerOrg.patternAfterTimeout == true) this.cosignerOrg.patternAfterTimeout = true;
        else this.cosignerOrg.patternAfterTimeout = false;
        
        this.cosignerOrg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutcosignerOrg")[0].value;  
        
        if(this.cosignerOrg.patternBeforeTimeout == true) this.cosignerOrg.patternBeforeTimeout = true;
        else this.cosignerOrg.patternBeforeTimeout = false;
        
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
        this.witnessOrg.patternAfterTimeoutN = parseInt(this.witnessOrg.patternAfterTimeoutN);
                        
        this.witnessOrg.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNwitnessOrg")[0].value;
        this.witnessOrg.patternBeforeTimeoutN = parseInt(this.witnessOrg.patternBeforeTimeoutN);
        
        this.witnessOrg.amount = document.getElementsByName("amountwitnessOrg")[0].value;
        this.witnessOrg.amount = parseInt(this.witnessOrg.amount);
        
        this.witnessOrg.from = document.getElementsByName("fromwitnessOrg")[0].value;
        
        this.witnessOrg.state = document.getElementsByName("statewitnessOrg")[0].value;
        if(this.witnessOrg.state == "on") this.witnessOrg.state = true;
        else this.witnessOrg.state = false;
        
        this.witnessOrg.proofSharing = document.getElementsByName("proofSharingwitnessOrg")[0].value;
        if(this.witnessOrg.proofSharing == "on") this.witnessOrg.proofSharing = true;
        else this.witnessOrg.proofSharing = false;
        
        this.witnessOrg.userProofSharing = document.getElementsByName("userProofSharingwitnessOrg")[0].value;
        if(this.witnessOrg.userProofSharing == "on") this.witnessOrg.userProofSharing = true;
        else this.witnessOrg.userProofSharing = false;
        
        if(this.witnessOrg.patternAfterTimeout == true) this.witnessOrg.patternAfterTimeout = true;
        else this.witnessOrg.patternAfterTimeout = false;
        
        this.witnessOrg.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutwitnessOrg")[0].value;
        
        if(this.witnessOrg.patternAfterTimeout == true) this.witnessOrg.patternAfterTimeout = true;
        else this.witnessOrg.patternAfterTimeout = false;
        
        this.witnessOrg.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutwitnessOrg")[0].value;  
        
        if(this.witnessOrg.patternBeforeTimeout == true) this.witnessOrg.patternBeforeTimeout = true;
        else this.witnessOrg.patternBeforeTimeout = false;
        
        this.witnessOrg.type = "witnessOrg";
}
Template.prototype.infoGetDataFromForm = function(){

        this.info.xpubList = [];
        let selList= document.getElementsByName("xpubListinfo")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.info.xpubList[i] = selList[i].value;
        }   
        this.info.pattern = document.getElementsByName("patterninfo")[0].value;
        
        this.info.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNinfo")[0].value;
        this.info.patternAfterTimeoutN = parseInt(this.info.patternAfterTimeoutN);
                        
        this.info.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNinfo")[0].value;
        this.info.patternBeforeTimeoutN = parseInt(this.info.patternBeforeTimeoutN);
        
        this.info.amount = document.getElementsByName("amountinfo")[0].value;
        this.info.amount = parseInt(this.info.amount);
        
        this.info.from = document.getElementsByName("frominfo")[0].value;
        
        this.info.state = document.getElementsByName("stateinfo")[0].value;
        if(this.info.state == "on") this.info.state = true;
        else this.info.state = false;
        
        this.info.proofSharing = document.getElementsByName("proofSharinginfo")[0].value;
        if(this.info.proofSharing == "on") this.info.proofSharing = true;
        else this.info.proofSharing = false;
        
        this.info.userProofSharing = document.getElementsByName("userProofSharinginfo")[0].value;
        if(this.info.userProofSharing == "on") this.info.userProofSharing = true;
        else this.info.userProofSharing = false;
        
        if(this.info.patternAfterTimeout == true) this.info.patternAfterTimeout = true;
        else this.info.patternAfterTimeout = false;
        
        this.info.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutinfo")[0].value;
        
        if(this.info.patternAfterTimeout == true) this.info.patternAfterTimeout = true;
        else this.info.patternAfterTimeout = false;
        
        this.info.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutinfo")[0].value;  
        
        if(this.info.patternBeforeTimeout == true) this.info.patternBeforeTimeout = true;
        else this.info.patternBeforeTimeout = false;
        
        this.info.type = "info";
}
Template.prototype.parentstype1GetDataFromForm = function(){

        this.parentstype1.xpubList = [];
        let selList= document.getElementsByName("xpubListparentstype1")[0].selectedOptions;
         
        for (var i = 0; i < selList.length; i++) {
            this.parentstype1.xpubList[i] = selList[i].value;
        }   
        this.parentstype1.pattern = document.getElementsByName("patternparentstype1")[0].value;
        
        this.parentstype1.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutNparentstype1")[0].value;
        this.parentstype1.patternAfterTimeoutN = parseInt(this.parentstype1.patternAfterTimeoutN);
                        
        this.parentstype1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNparentstype1")[0].value;
        this.parentstype1.patternBeforeTimeoutN = parseInt(this.parentstype1.patternBeforeTimeoutN);
        
        this.parentstype1.amount = document.getElementsByName("amountparentstype1")[0].value;
        this.parentstype1.amount = parseInt(this.parentstype1.amount);
        
        this.parentstype1.from = document.getElementsByName("fromparentstype1")[0].value;
        
        this.parentstype1.state = document.getElementsByName("stateparentstype1")[0].value;
        if(this.parentstype1.state == "on") this.parentstype1.state = true;
        else this.parentstype1.state = false;
        
        this.parentstype1.proofSharing = document.getElementsByName("proofSharingparentstype1")[0].value;
        if(this.parentstype1.proofSharing == "on") this.parentstype1.proofSharing = true;
        else this.parentstype1.proofSharing = false;
        
        this.parentstype1.userProofSharing = document.getElementsByName("userProofSharingparentstype1")[0].value;
        if(this.parentstype1.userProofSharing == "on") this.parentstype1.userProofSharing = true;
        else this.parentstype1.userProofSharing = false;
        
        if(this.parentstype1.patternAfterTimeout == true) this.parentstype1.patternAfterTimeout = true;
        else this.parentstype1.patternAfterTimeout = false;
        
        this.parentstype1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutparentstype1")[0].value;
        
        if(this.parentstype1.patternAfterTimeout == true) this.parentstype1.patternAfterTimeout = true;
        else this.parentstype1.patternAfterTimeout = false;
        
        this.parentstype1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutparentstype1")[0].value;  
        
        if(this.parentstype1.patternBeforeTimeout == true) this.parentstype1.patternBeforeTimeout = true;
        else this.parentstype1.patternBeforeTimeout = false;
        
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
        this.childstype1.patternAfterTimeoutN = parseInt(this.childstype1.patternAfterTimeoutN);
                        
        this.childstype1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNchildstype1")[0].value;
        this.childstype1.patternBeforeTimeoutN = parseInt(this.childstype1.patternBeforeTimeoutN);
        
        this.childstype1.amount = document.getElementsByName("amountchildstype1")[0].value;
        this.childstype1.amount = parseInt(this.childstype1.amount);
        
        this.childstype1.from = document.getElementsByName("fromchildstype1")[0].value;
        
        this.childstype1.state = document.getElementsByName("statechildstype1")[0].value;
        if(this.childstype1.state == "on") this.childstype1.state = true;
        else this.childstype1.state = false;
        
        this.childstype1.proofSharing = document.getElementsByName("proofSharingchildstype1")[0].value;
        if(this.childstype1.proofSharing == "on") this.childstype1.proofSharing = true;
        else this.childstype1.proofSharing = false;
        
        this.childstype1.userProofSharing = document.getElementsByName("userProofSharingchildstype1")[0].value;
        if(this.childstype1.userProofSharing == "on") this.childstype1.userProofSharing = true;
        else this.childstype1.userProofSharing = false;
        
        if(this.childstype1.patternAfterTimeout == true) this.childstype1.patternAfterTimeout = true;
        else this.childstype1.patternAfterTimeout = false;
        
        this.childstype1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutchildstype1")[0].value;
        
        if(this.childstype1.patternAfterTimeout == true) this.childstype1.patternAfterTimeout = true;
        else this.childstype1.patternAfterTimeout = false;
        
        this.childstype1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutchildstype1")[0].value;  
        
        if(this.childstype1.patternBeforeTimeout == true) this.childstype1.patternBeforeTimeout = true;
        else this.childstype1.patternBeforeTimeout = false;
        
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
        this.investorType1.patternAfterTimeoutN = parseInt(this.investorType1.patternAfterTimeoutN);
                        
        this.investorType1.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutNinvestorType1")[0].value;
        this.investorType1.patternBeforeTimeoutN = parseInt(this.investorType1.patternBeforeTimeoutN);
        
        this.investorType1.amount = document.getElementsByName("amountinvestorType1")[0].value;
        this.investorType1.amount = parseInt(this.investorType1.amount);
        
        this.investorType1.from = document.getElementsByName("frominvestorType1")[0].value;
        
        this.investorType1.state = document.getElementsByName("stateinvestorType1")[0].value;
        if(this.investorType1.state == "on") this.investorType1.state = true;
        else this.investorType1.state = false;
        
        this.investorType1.proofSharing = document.getElementsByName("proofSharinginvestorType1")[0].value;
        if(this.investorType1.proofSharing == "on") this.investorType1.proofSharing = true;
        else this.investorType1.proofSharing = false;
        
        this.investorType1.userProofSharing = document.getElementsByName("userProofSharinginvestorType1")[0].value;
        if(this.investorType1.userProofSharing == "on") this.investorType1.userProofSharing = true;
        else this.investorType1.userProofSharing = false;
        
        if(this.investorType1.patternAfterTimeout == true) this.investorType1.patternAfterTimeout = true;
        else this.investorType1.patternAfterTimeout = false;
        
        this.investorType1.patternAfterTimeout = document.getElementsByName("patternAfterTimeoutinvestorType1")[0].value;
        
        if(this.investorType1.patternAfterTimeout == true) this.investorType1.patternAfterTimeout = true;
        else this.investorType1.patternAfterTimeout = false;
        
        this.investorType1.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeoutinvestorType1")[0].value;  
        
        if(this.investorType1.patternBeforeTimeout == true) this.investorType1.patternBeforeTimeout = true;
        else this.investorType1.patternBeforeTimeout = false;
        
        this.investorType1.type = "investorType1";
}
