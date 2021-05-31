<?php

class SdkTemplate {

    public static array $domains = ['Laeka'];
    public static array $domainsSubs = ['Laeka' => ['healthRecord'], 'core' => ['user', 'proof']];
    public static array $domainsSubsAbouts = [
        'Laeka' => [
            'healthRecord' => ['identifier', 'Product', 'Service', 'Voucher', 'State', 'Record', 'Vote', 'Act', 'Payment', 'Ownership', 'Contribution']
        ],
        'core' => [
            'proof' => ['identifier', 'Product', 'Service', 'Voucher', 'State', 'Record', 'Vote', 'Act', 'Payment', 'Ownership', 'Contribution'],
            'user' => ['identifier', 'Product', 'Service', 'Voucher', 'State', 'Record', 'Vote', 'Act', 'Payment', 'Ownership', 'Contribution']
        ]
    ];
    public static array $roles = ['Author', 'Owner', 'Contributor', 'ClientPrivate', 'ClientPublic', 'Witness', 'Provider', 'Distributor', 'Sponsor', 'Insurance'];
    public static array $typeList = ['from', 'to', 'backup', 'lock', 'cosigner', 'witness', 'ban', 'old', 'member', 'board', 'witnessOrg', 'cosignerOrg', 'parents', 'childs', 'block', 'peg'];
    public static array $processes = ['Authorizations', 'HealthCare', 'Sells', 'Finance', 'Maintenance'];
    public static array $processesSteps = ['Proposal', 'Realization', 'Test', 'Validation', 'Advertising', 'InitialVersion', 'NewVersion'];
    public static array $processesStepsAction = ['AskForConfirmationDeclaration', 'AskForConfirmationBan', 'AskForConfirmationOutboard', 'AskForConfirmationOutboard', 'AskForConfirmationShare', 'AskForTemplateUpdate', 'AskForTechnicalInfos'];
    public static array $list = [];

    public string $name = '';
    public string $version = 'v0';
    public int $amount = 0;
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
    public SdkTemplateTypeParents $parents;
    public SdkTemplateTypeChilds $childs;
    public SdkTemplateTypeBlock $block;
    public SdkTemplateTypePeg $peg;
    public string $hash;

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
        $this->parents = new SdkTemplateTypeParents(SdkTemplateTypeParents::walletsList());
        $this->childs = new SdkTemplateTypeChilds(SdkTemplateTypeChilds::walletsList());
        $this->block = new SdkTemplateTypeBlock(SdkTemplateTypeBlock::walletsList());
        $this->peg = new SdkTemplateTypePeg(SdkTemplateTypePeg::walletsList());
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
        $checkboxAskForDeclareFrom = SdkHtml::checkboxHtml('askForDeclareFrom'.$this->name, $this->declareAddressFrom);
        $checkboxAskForDeclareTo = SdkHtml::checkboxHtml('askForDeclareTo'.$this->name, $this->declareAddressTo);
        $checkboxProofEncryption = SdkHtml::checkboxHtml('proofEncryption'.$this->name, $this->proofEncryption);
        $checkboxUserEncryption = SdkHtml::checkboxHtml('userEncryption'.$this->name, $this->userEncryption);

        return '
<label for="amount">For</label> <input type="number" name="amount" value="'.$this->amount.'"> BTC<br><br>
<label for="roles">As</label> <select name="roles">'.$optionsRoles.'</select><br><br>
<label for="domain">Domain</label> <select name="domain">'.$optionsDomains.'</select> <select name="subdomain">'.$optionsDomainSubs.'</select> <select id="about" name="about">'.$optionsDomainSubsAbout.'</select><br><br>
<label for="process">Process</label> <select name="process">'.$optionsProcesses.'</select> <select name="step">'.$optionsProcessesSteps.'</select> <select name="actions">'.$optionsProcessesStepActions.'</select><br><br>
'.$checkboxBlock.' <label for="AskForConfirmationBlock">Ask for an immediate block signature</label><br><br>
'.$checkboxPeg.' <label for="AskForConfirmationPeg">Ask for for a rapid bitcoin proof</label><br><br>
'.$checkboxAskForDeclareFrom.' <label for="AskForDeclareUserFrom'.$this->name.'"> Require declared users (from)</label><br><br>
'.$checkboxAskForDeclareTo.' <label for="AskForDeclareUserTo'.$this->name.'"> Require declared users (to)</label><br><br>
'.$checkboxProofEncryption.' <label for="proofEncryption'.$this->name.'"> Proof encryption</label><br><br>
'.$checkboxUserEncryption.' <label for="userEncryption'.$this->name.'"> User encryption</label>'
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
.$this->parents->conditionHtml(SdkTemplateTypeParents::walletsList())
.$this->childs->conditionHtml(SdkTemplateTypeChilds::walletsList())
.$this->block->conditionHtml(SdkTemplateTypeBlock::walletsList())
.$this->peg->conditionHtml(SdkTemplateTypePeg::walletsList());
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
        $script .= $this->parents->definitionJs()."\n";
        $script .= $this->childs->definitionJs()."\n";
        $script .= $this->block->definitionJs()."\n";
        $script .= $this->peg->definitionJs()."\n";
        $script .= $this->definitionJs()."\n";

        return $script;
    }
    public function definitionJs(): string {

        return SdkHtml::definitionJs($this->name, $this);
    }
}