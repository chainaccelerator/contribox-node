<?php

class SdkTemplate {

    public static array $domains = ['Laeka', 'Core'];
    public static array $domainsSubs = [
        'Laeka' => ['healthRecord'],
        'Core' => ['user', 'proof']
    ];
    public static array $domainsSubsAbouts = [
        'Laeka' => [
            'healthRecord' => ['Identifier', 'Product', 'Service', 'Voucher', 'State', 'Record', 'Vote', 'Act', 'Payment', 'Ownership', 'Contribution']
        ],
        'Core' => [
            'proof' => ['Identifier'],
            'user' => ['Identifier']
        ]
    ];
    public static array $roles = ['Author', 'Owner', 'Contributor', 'ClientPrivate', 'ClientPublic', 'Witness', 'Provider', 'Distributor', 'Sponsor', 'Insurance'];
    public static array $typeList = ['from', 'to', 'backup', 'lock', 'cosigner', 'witness', 'ban', 'old', 'member', 'board', 'witnessOrg', 'cosignerOrg', 'parentstype1', 'childstype1', 'block', 'peg'];
    public static array $processes = ['Core', 'Authorizations', 'HealthCare', 'Sells', 'Finance', 'Maintenance'];
    public static array $processesSteps = ['Proposal', 'Realization', 'Test', 'Validation', 'Advertising', 'InitialVersion', 'NewVersion'];
    public static array $processesStepsAction = ['AskForConfirmationDeclaration', 'AskForConfirmationBan', 'AskForConfirmationOutboard', 'AskForConfirmationOutboard', 'AskForConfirmationShare', 'AskForTemplateUpdate', 'AskForTechnicalInfos'];
    public static array $list = [];

    public string $name = '';
    public string $validationName = '';
    public string $version = 'v0';
    public string $role = '';
    public string $domain = '';
    public string $domainSub = '';
    public string $domainSubAbout = '';
    public string $process = "";
    public string $processStep = '';
    public string $processStepAction = '';
    public string $templateValidation = 'CoreTemplateValidation';

    public SdkTemplateReferentialProof $proofValidation;
    public SdkTemplateReferentialUser $fromValidation;
    public SdkTemplateReferentialUser $toValidation;
    public SdkTemplateTypeFrom $from;
    public SdkTemplateTypeTo $to;
    public SdkTemplateTypeApi $api;
    public SdkTemplateTypeBackup $backup;
    public SdkTemplateTypeLock $lock;
    public SdkTemplateTypeWitness $witness;
    public SdkTemplateTypeCosigner $cosigner;
    public SdkTemplateTypeBan $ban;
    public SdkTemplateTypeOld $old;
    public SdkTemplateTypeMember $member;
    public SdkTemplateTypeBoard $board;
    public SdkTemplateTypeCosignerOrg $cosignerOrg;
    public SdkTemplateTypeWitnessOrg $witnessOrg;
    public SdkTemplateTypeParentstype1 $parentstype1;
    public SdkTemplateTypeChildstype1 $childstype1;
    public SdkTemplateTypeBlock $block;
    public SdkTemplateTypePeg $peg;
    public SdkTemplateTypeInvestorType1 $investorType1;
    public string $hash;
    public array $htmlFieldsId = array();
    public string $htmlScript = '';

    public static function initFromJson($json){

        $o = new SdkTemplate($json->role, $json->domain, $json->domainSub, $json->process, $json->processStep, $json->processStepAction, $json->about, $json->version, $json->templateValidation);

        foreach($json as $k => $v) {

            $o->$k = $v;
        }
        return $o;
    }

    public function __construct(string $role, string $domain, string $domainSub, string $process, string $processStep, string $processStepAction, string $about, string $version = 'v0', string $templateValidation = 'CoreTemplateValidation'){

        $this->version = $version;
        $this->role = $role;
        $this->domain = $domain;
        $this->domainSub = $domainSub;
        $this->domainSubAbout = $about;
        $this->process = $process;
        $this->processStep = $processStep;
        $this->processStepAction = $processStepAction;
        $this->proofValidation = new SdkTemplateReferentialProof();
        $this->proofValidation->type = 'proofValidation';
        $this->fromValidation = new SdkTemplateReferentialUser();
        $this->fromValidation->type = 'fromValidation';
        $this->toValidation = new SdkTemplateReferentialUser();
        $this->toValidation->type = 'toValidation';
        $this->templateValidation = $templateValidation;

        $this->from = new SdkTemplateTypeFrom(SdkTemplateTypeFrom::walletsList());
        $c = [];
        foreach(SdkWallet::$walletsFederation as $d => $v) $c[$d] = $d;
        foreach(SdkWallet::$walletsShare as $d => $v) $c[$d] = $d;

        foreach($c as $t) {
            $cc = 'SdkTemplateType'.ucfirst($t);
            $this->$t = new $cc($cc::walletsList());
        }
        $this->name = $this->role.'_'.$this->domain.'_'.$this->domainSub.'_'.$this->domainSubAbout.'_'.$this->process.'_'.$this->processStep.'_'.$this->processStepAction.'_'.$this->version;
        $this->hash = CryptoHash::get($this->name)->hash;

        $files = glob('../'.Conf::$env.'/data/template/*.json');

        foreach($files as $file) {

            $o = json_decode(file_get_contents($file));
            self::$list[] = $o;
        }
    }
    public function conditionHtml(): string {

        $templateList = array();

        foreach(self::$list as $k => $v){

            $templateList[] = $v->name;
        }
        $optionsRoles = SdkHtml::optionHtml(self::$roles, $this->role);
        $optionsDomains = SdkHtml::optionHtml(self::$domains, $this->domain);
        $optionsDomainSubs = SdkHtml::optionHtml(self::$domainsSubs[$this->domain], $this->domainSub);
        $optionsDomainSubsAbout = SdkHtml::optionHtml(self::$domainsSubsAbouts[$this->domain][$this->domainSub], $this->domainSubAbout);
        $optionsProcesses = SdkHtml::optionHtml(self::$processes, $this->process);
        $optionsProcessesSteps = SdkHtml::optionHtml(self::$processesSteps, $this->processStep);
        $optionsProcessesStepActions = SdkHtml::optionHtml(self::$processesStepsAction, $this->processStepAction);
        $optionsValidation = SdkHtml::optionHtml($templateList, 'Default');

        $this->htmlFieldsId = [
            'role',
            'domain',
            'process',
            'templateValidation'
        ];

        $form = '
<label for="role">As</label> <select name="role">'.$optionsRoles.'</select><br><br>
<label for="domain">Domain</label> <select name="domain">'.$optionsDomains.'</select> <select name="subdomain">'.$optionsDomainSubs.'</select> <select id="about" name="about">'.$optionsDomainSubsAbout.'</select><br><br>
<label for="process">Process</label> <select name="process">'.$optionsProcesses.'</select> <select name="step">'.$optionsProcessesSteps.'</select> <select name="actions">'.$optionsProcessesStepActions.'</select><br><br>
<label for="templateValidation">Template</label> <select name="templateValidation">'.$optionsValidation.'</select>'
.$this->proofValidation->conditionHtml()
.$this->fromValidation->conditionHtml()
.$this->toValidation->conditionHtml();

        $c = [];
        $c['from'] = 'from';
        foreach(SdkWallet::$walletsFederation as $d => $v) $c[$d] = $d;
        foreach(SdkWallet::$walletsShare as $d => $v) $c[$d] = $d;

        foreach($c as $t) {
            $c = 'SdkTemplateType'.ucfirst($t);
            $form .= $this->$t->conditionHtml($c::walletsList());
        }
        $function = '';
        $function1 = '';
        $function2 = '';

        foreach($this->htmlFieldsId as $id){

            $function .= "\t".'this.'.$id.' = document.getElementsByName("'.$id.'")[0].value;'."\n";
            $function1 .= $id.' = '.json_encode($this->$id).', ';
            $function2 .= "\t".'this.'.$id.' = '.$id.';'."\n";
        }
        $l = array();
        foreach(self::$list as $o) $l[] = json_decode(file_get_contents('../'.Conf::$env.'/data/template/'.$o->name.'.json'));
        $cc = '';
        $ci = '';
        $cl = '';
        $cd = '';

        foreach(SdkWallet::$wallets as $w) {
            $cc .= $w.' = {}, ';
            $ci .= 'this.'.$w.' = '.$w.';'."\n";
            $cl .= $this->$w->htmlScript."\n";
            $cd .= 'this.'.$w.'GetData'.$w.'Form();'."\n";
        }
        $cc = substr($cc, 0, -2);
        $this->htmlScript =  '
function Template('.substr($function1, 0,-2).', proofValidation = {}, fromValidation = {}, toValidation = {}, '.$cc.') {

    this.domains = '.json_encode(self::$domains).';
    this.domainsSubs = '.json_encode(self::$domainsSubs).';
    this.domainsSubsAbouts = '.json_encode(self::$domainsSubsAbouts).'; 
    this.roles = '.json_encode(self::$roles).';
    this.typeList = '.json_encode(self::$typeList).';
    this.processes = '.json_encode(self::$processes).';
    this.processesSteps = '.json_encode(self::$processesSteps).';
    this.processesStepsAction = '.json_encode(self::$processesStepsAction).';
    this.list = '.json_encode($l).';
    this.patterns = '.json_encode(SdkTemplateType::$patterns).';

'.$function2.'
    this.proofValidation = proofValidation;
    this.fromValidation = fromValidation;
    this.toValidation = toValidation;
    '.$ci.'
}
Template.prototype.getDataFromForm = function () {

'.$function.'
   
    this.proofValidationGetDataFromForm();
    this.proofValidation.type = "proofValidation";
    this.fromValidationGetDataFromForm();
    this.fromValidation.type = "fromValidation";
    this.toValidationGetDataFromForm();
    '.$cd.'
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
'.$this->proofValidation->htmlScript."\n".$this->fromValidation->htmlScript."\n".$this->toValidation->htmlScript."\n".$cl;

        $c = get_class($this);
        file_put_contents('js/'.$c.'.js', $this->htmlScript);

        return $form;
    }
}