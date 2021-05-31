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

    public int $amount = 0;
    public string $name = '';
    public string $version = 'v0';
    public string $role = '';
    public string $domain = '';
    public string $domainSub = '';
    public string $domainSubAbout = '';
    public string $process = "";
    public string $processStep = '';
    public string $processStepAction = '';
    public bool $blockSignature = false;
    public bool $pegSignature = false;
    public bool $declareAddressFrom = false;
    public bool $declareAddressTo = false;
    public bool $proofEncryption = false;
    public bool $userEncryption = false;

    public SdkTemplateReferentialProof $proof;
    public SdkTemplateReferentialUser $fromValidation;
    public SdkTemplateReferentialUser $toValidation;
    public SdkTemplateTypeFrom $from;
    public SdkTemplateTypeTo $to;
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
    public SdkTemplateTypeParents $parentstype1;
    public SdkTemplateTypeChilds $childstype1;
    public SdkTemplateTypeBlock $block;
    public SdkTemplateTypePeg $peg;
    public SdkTemplateTypeInvestorType1 $investorType1;
    public string $hash;
    public array $htmlFieldsId = array();

    public static function initFromJson($json){

        $o = new SdkTemplate($json->role, $json->domain, $json->domainSub, $json->process, $json->processStep, $json->processStepAction, $json->about, $json->amount, $json->blockSignature, $json->pegSignature, $json->version, $json->declareAddressFrom, $json->declareAddressTo, $json->proofEncryption, $json->userEncryption);

        foreach($json as $k => $v) {

            $o->$k = $v;
        }
        return $o;
    }

    public function __construct(string $role, string $domain, string $domainSub, string $process, string $processStep, string $processStepAction, string $about, int $amount = 0, bool $blockSignature = false, bool $pegSignature = false, string $version = 'v0', bool $declareAddressFrom = false, bool $declareAddressTo = false, bool $proofEncryption = false, bool $userEncryption = false){

        $this->version = $version;
        $this->amount = $amount;
        $this->role = $role;
        $this->domain = $domain;
        $this->domainSub = $domainSub;
        $this->domainSubAbout = $about;
        $this->process = $process;
        $this->processStep = $processStep;
        $this->processStepAction = $processStepAction;
        $this->blockSignature = $blockSignature;
        $this->pegSignature = $pegSignature;
        $this->proof = new SdkTemplateReferentialProof();
        $this->fromValidation = new SdkTemplateReferentialUser();
        $this->fromValidation->type = 'from';
        $this->toValidation = new SdkTemplateReferentialUser();
        $this->toValidation->type = 'to';
        $this->from = new SdkTemplateTypeFrom(SdkTemplateTypeFrom::walletsList());
        $this->to = new SdkTemplateTypeTo(SdkTemplateTypeTo::walletsList());
        $this->backup = new SdkTemplateTypeBackup(SdkTemplateTypeBackup::walletsList());
        $this->lock = new SdkTemplateTypeLock(SdkTemplateTypeLock::walletsList());
        $this->witness = new SdkTemplateTypeWitness(SdkTemplateTypeWitness::walletsList());
        $this->cosigner = new SdkTemplateTypeCosigner(SdkTemplateTypeCosigner::walletsList());
        $this->ban = new SdkTemplateTypeBan(SdkTemplateTypeBan::walletsList());
        $this->old = new SdkTemplateTypeOld(SdkTemplateTypeOld::walletsList());
        $this->member = new SdkTemplateTypeMember(SdkTemplateTypeMember::walletsList());
        $this->board = new SdkTemplateTypeBoard(SdkTemplateTypeBoard::walletsList());
        $this->cosignerOrg = new SdkTemplateTypeCosignerOrg(SdkTemplateTypeCosignerOrg::walletsList());
        $this->witnessOrg = new SdkTemplateTypeWitnessOrg(SdkTemplateTypeWitnessOrg::walletsList());
        $this->parentstype1 = new SdkTemplateTypeParents(SdkTemplateTypeParents::walletsList());
        $this->childstype1 = new SdkTemplateTypeChilds(SdkTemplateTypeChilds::walletsList());
        $this->block = new SdkTemplateTypeBlock(SdkTemplateTypeBlock::walletsList());
        $this->peg = new SdkTemplateTypePeg(SdkTemplateTypePeg::walletsList());
        $this->investorType1 = new SdkTemplateTypeInvestorType1(SdkTemplateTypeInvestorType1::walletsList());
        $this->name = $this->role.'_'.$this->domain.'_'.$this->domainSub.'_'.$this->domainSubAbout.'_'.$this->process.'_'.$this->processStep.'_'.$this->processStepAction.'_'.$this->version;
        $this->hash = CryptoHash::get($this->name)->hash;
        $this->declareAddressFrom = $declareAddressFrom;
        $this->declareAddressTo = $declareAddressTo;
        $this->proofEncryption = $proofEncryption;
        $this->userEncryption = $userEncryption;

    }
    public function conditionHtml(): string {

        $optionsRoles = SdkHtml::optionHtml(self::$roles, $this->role);
        $optionsDomains = SdkHtml::optionHtml(self::$domains, $this->domain);
        $optionsDomainSubs = SdkHtml::optionHtml(self::$domainsSubs[$this->domain], $this->domainSub);
        $optionsDomainSubsAbout = SdkHtml::optionHtml(self::$domainsSubsAbouts[$this->domain][$this->domainSub], $this->domainSubAbout);
        $optionsProcesses = SdkHtml::optionHtml(self::$processes, $this->process);
        $optionsProcessesSteps = SdkHtml::optionHtml(self::$processesSteps, $this->processStep);
        $optionsProcessesStepActions = SdkHtml::optionHtml(self::$processesStepsAction, $this->processStepAction);
        $checkboxBlock = SdkHtml::checkboxHtml('block', $this->blockSignature);
        $checkboxPeg = SdkHtml::checkboxHtml('peg', $this->pegSignature);
        $checkboxAskForDeclareFrom = SdkHtml::checkboxHtml('askForDeclareFrom', $this->declareAddressFrom);
        $checkboxAskForDeclareTo = SdkHtml::checkboxHtml('askForDeclareTo', $this->declareAddressTo);
        $checkboxProofEncryption = SdkHtml::checkboxHtml('proofEncryption', $this->proofEncryption);
        $checkboxUserEncryption = SdkHtml::checkboxHtml('userEncryption', $this->userEncryption);

        $this->htmlFieldsId = [
            'amount',
            'roles',
            'domain',
            'process',
            'block',
            'peg',
            'askForDeclareFrom',
            'askForDeclareTo',
            'proofEncryption',
            'userEncryption'
        ];

        $form = '
<label for="amount">For</label> <input type="number" name="amount" value="'.$this->amount.'"> Project-BTC<br><br>
<label for="roles">As</label> <select name="roles">'.$optionsRoles.'</select><br><br>
<label for="domain">Domain</label> <select name="domain">'.$optionsDomains.'</select> <select name="subdomain">'.$optionsDomainSubs.'</select> <select id="about" name="about">'.$optionsDomainSubsAbout.'</select><br><br>
<label for="process">Process</label> <select name="process">'.$optionsProcesses.'</select> <select name="step">'.$optionsProcessesSteps.'</select> <select name="actions">'.$optionsProcessesStepActions.'</select><br><br>
'.$checkboxBlock.' <label for="AskForConfirmationBlock">Ask for an immediate block signature</label><br><br>
'.$checkboxPeg.' <label for="AskForConfirmationPeg">Ask for for a rapid bitcoin proof</label><br><br>
'.$checkboxAskForDeclareFrom.' <label for="AskForDeclareUserFrom"> Require declared users (from)</label><br><br>
'.$checkboxAskForDeclareTo.' <label for="AskForDeclareUserTo"> Require declared users (to)</label><br><br>
'.$checkboxProofEncryption.' <label for="proofEncryption"> Proof encryption</label><br><br>
'.$checkboxUserEncryption.' <label for="userEncryption"> User encryption</label>'
        .$this->proof->conditionHtml()
        .$this->fromValidation->conditionHtml()
        .$this->toValidation->conditionHtml()
        .$this->from->conditionHtml(SdkTemplateTypeFrom::walletsList())
        .$this->to->conditionHtml(SdkTemplateTypeTo::walletsList())
        .$this->backup->conditionHtml(SdkTemplateTypeBackup::walletsList())
        .$this->lock->conditionHtml(SdkTemplateTypeLock::walletsList())
        .$this->witness->conditionHtml(SdkTemplateTypeWitness::walletsList())
        .$this->cosigner->conditionHtml(SdkTemplateTypeCosigner::walletsList())
        .$this->ban->conditionHtml(SdkTemplateTypeBan::walletsList())
        .$this->old->conditionHtml(SdkTemplateTypeOld::walletsList())
        .$this->member->conditionHtml(SdkTemplateTypeMember::walletsList())
        .$this->board->conditionHtml(SdkTemplateTypeBoard::walletsList())
        .$this->cosignerOrg->conditionHtml(SdkTemplateTypeCosignerOrg::walletsList())
        .$this->witnessOrg->conditionHtml(SdkTemplateTypeWitnessOrg::walletsList())
        .$this->parentstype1->conditionHtml(SdkTemplateTypeParents::walletsList())
        .$this->childstype1->conditionHtml(SdkTemplateTypeChilds::walletsList())
        .$this->investorType1->conditionHtml(SdkTemplateTypeInvestorType1::walletsList())
        .$this->block->conditionHtml(SdkTemplateTypeBlock::walletsList())
        .$this->peg->conditionHtml(SdkTemplateTypePeg::walletsList());

        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->proof->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->fromValidation->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->toValidation->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->from->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->to->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->backup->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->lock->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->witness->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->cosigner->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->ban->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->old->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->board->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->cosignerOrg->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->witnessOrg->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->parentstype1->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->childstype1->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->investorType1->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->block->htmlFieldsId);
        $this->htmlFieldsId = array_merge($this->htmlFieldsId, $this->peg->htmlFieldsId);

        return $form;
    }
    public function initJs(): string{

        $script = $this->proof->definitionJs()."\n";
        $script .= $this->fromValidation->definitionJs()."\n";
        $script .= $this->toValidation->definitionJs()."\n";
        $script .= $this->from->definitionJs()."\n";
        $script .= $this->to->definitionJs()."\n";
        $script .= $this->backup->definitionJs()."\n";
        $script .= $this->lock->definitionJs()."\n";
        $script .= $this->witness->definitionJs()."\n";
        $script .= $this->cosigner->definitionJs()."\n";
        $script .= $this->ban->definitionJs()."\n";
        $script .= $this->old->definitionJs()."\n";
        $script .= $this->member->definitionJs()."\n";
        $script .= $this->board->definitionJs()."\n";
        $script .= $this->cosignerOrg->definitionJs()."\n";
        $script .= $this->witnessOrg->definitionJs()."\n";
        $script .= $this->parentstype1->definitionJs()."\n";
        $script .= $this->childstype1->definitionJs()."\n";
        $script .= $this->investorType1->definitionJs()."\n";
        $script .= $this->block->definitionJs()."\n";
        $script .= $this->peg->definitionJs()."\n";
        $script .= $this->definitionJs()."\n";
        $function = '';

        foreach($this->htmlFieldsId as $id){

            $function .= 'data.'.$id.' = document.getElementsByName("'.$id.'")[0].value;'."\n";
        }
        $function = '
function templateGetData() {

    var data = {};
'.$function.'

    return data;
}
console.log(templateGetData());
';
        $script .= $function;

        return $script;
    }
    public function definitionJs(): string {

        return SdkHtml::definitionJs($this->name, $this);
    }
}