<?php

class CryptoWalletPrivKey extends CryptoWalletFile {

    public string|bool $classChild = 'CryptoWalletPubKey';

    public function setData(string|bool $data = false, string $keypair = ''):bool {

        if($data !== false && $data !== true) {

            $this->data = $data;
        }
        elseif($data === true) {

            $this->data = $keypair;
        }
        else {

            try {

                $this->data = sodium_crypto_box_keypair();
            }
            catch (SodiumException $e) {

                error_log($e->getMessage(), 0);
                exit('Key pair error ' . $e->getMessage());
            }
        }
        return true;
    }
    public function decode(string $encrypted):string{

        try {

            return sodium_crypto_box_seal_open($encrypted, $this->data);
        }
        catch (SodiumException $e) {

            error_log($e->getMessage(), 0);
            exit('Decode error '.$e->getMessage());
        }
    }
}