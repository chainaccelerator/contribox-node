<?php

class CryptoWalletPubKey extends CryptoWalletFile {

    public string|bool $classChild = false;

    public function setData(string|bool $data = false, string $keypair = ''):bool
    {

        if ($data !== false) {

            $this->data = $data;
        }
        else {

            try {

                $this->data = sodium_crypto_box_publickey($keypair);
            }
            catch (SodiumException $e) {

                error_log($e->getMessage(), 0);
                exit('Pub key error '.$e->getMessage());
            }
        }
        return true;
    }
    public function encode(string $plaintextMessage):string {

        try {

            return sodium_crypto_box_seal($plaintextMessage, $this->data);
        }
        catch (SodiumException $e) {

            error_log($e->getMessage(), 0);
            exit('encode error '.$e->getMessage());
        }
    }
}