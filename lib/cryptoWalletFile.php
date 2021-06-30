<?php

abstract class CryptoWalletFile {

    public string $class = '';
    public string $role = 'main';
    public string $file = '';
    public string $dir = '';
    public string $childFile = '';
    public string $hash;
    public string|bool $data = false;
    public string|bool $classChild = '';
    public int $index = 0;
    public array $childList = array();

    public function __construct(string $role = 'main', string|bool $index = false, string|bool $data = false, bool $save = false) {

        $this->class = get_called_class();
        $this->role = $role;
        $this->setDir();
        $this->setData($data);

        if($index !== false) {

            $this->index = $index;
        }
        else {

            $this->index = count(self::list());
        }
        $hash = CryptoHash::get(json_encode($this));
        $this->hash = $hash->hash;
        $this->setFile();
        $this->setChildListFile();
        $this->childListLoad();
        $this->dataLoad();

        if($save === true) $this->save();
    }
    public static function list(): array{

        $class = get_called_class();
        return glob('../'.Conf::$env.'/data/wallets/'.$class.'/*.dat');
    }
    public function setDir(): bool {

        $this->dir = '../'.Conf::$env.'/data/wallets/'.$this->class.'/';
        return true;
    }
    public function setFile(): string {

        $this->file = $this->dir.$this->hash.'.dat';
        return true;
    }
    public function setChildListFile(): string {

        $this->childFile = $this->dir.'lists/'.$this->hash.'.dat';
        return true;
    }
    public function save(): false|int{

        $obj = $this;
        unset($obj->data);
        $data = json_encode($obj);

        file_put_contents($this->file, $data);

        $file = str_replace('.dat', '.data', $this->file);

        file_put_contents($file, $this->data);

        return true;
    }
    public function dataLoad(): bool  {

        $file = str_replace('.dat', '.data', $this->file);

        if(is_file($file) === true && $this->data === false) {

            $this->data = file_get_contents($file);
        }
        return true;
    }
    public function setData(string|bool $data = false, string $keypair = ''):bool {

        if($data !== false) {

            $this->data = $data;
        }
        return true;
    }
    public function childListLoad(): bool{

        if(is_file($this->childFile) === true ) {

            $this->childList = json_decode(file_get_contents($this->childFile));
        }
        return true;
    }
    public function childNew(string|bool $index = false, string|bool $data = false, bool $save = false): string{

        $childClass = $this->classChild;
        $child = new $childClass($this->role, $index, $data, $save);

        return $this->childAdd($child->hash);
    }
    public function childAdd(string $hash): string{

        if(is_file($this->childFile) === true ) {

            $this->childList = json_decode(file_get_contents($this->childFile));
        }
        $this->childList[] = $hash;
        $data = json_encode($this->childList);

        return file_put_contents($this->childFile, $data);
    }
    public static function loadFile(string $file) {

        if(is_file($file) === false) {

            exit('FIle not found');
        }
        $i = json_decode(file_get_contents($file));
        $class = get_called_class();

        return new $class($i->role, $i->index, false, false);
    }
    public static function loadDefault(){

        $c = get_called_class();
        $list = $c::list();

        if(isset($list[0]) === true) {

            return $c::loadFile($list[0]);
        }
        $class = get_called_class();
        $obj = new $class('default', false, false, true);

        if($obj->classChild !== false) {

            $cCHild = $obj->classChild;
            $objChild = $cCHild::loadDefault();
            $obj->childAdd($objChild->hash);
        }
        return $obj;
    }
}

