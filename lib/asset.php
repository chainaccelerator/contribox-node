<?php

class Asset {

    public string $name;
    public string $data;
    public int $quantity;

    public Template $templateBoardingOn;
    public Template $templateBoardingOff;
    public Template $templateBan;
    public Template $templateIssue;
    public Template $templateIssueN;
    public Template $templateFreeze;
    public Template $templateTransfer;

    public CryptoHash $hash;

    public function __construct(){}

    public function setName(string $name):bool {

        $this->name = $name;

        return true;
    }
    public function setQuantity(int $quantity):bool {

        $this->quantity = $quantity;

        return true;
    }
    public function setData(string $data):bool {

        $this->data = $data;

        return true;
    }
    public function setTemplateBoardingOn(Template $template):bool {

        $this->templateBoardingOn = $template;

        return true;
    }
    public function setTemplateBoardingOff(Template $template):bool {

        $this->templateBoardingOff = $template;

        return true;
    }
    public function setTemplateBan(Template $template):bool {

        $this->templateBan = $template;

        return true;
    }
    public function setTemplateIssue(Template $template):bool {

        $this->templateIssue = $template;

        return true;
    }
    public function setTmplateIssueN(Template $template):bool {

        $this->templateIssueN = $template;

        return true;
    }
    public function setTemplateFreeze(Template $template):bool {

        $this->templateFreeze = $template;

        return true;
    }
    public function setTemplateTransfer(Template $template):bool {

        $this->templateTransfer = $template;

        return true;
    }
}