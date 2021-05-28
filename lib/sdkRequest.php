<?

class SdkRequest {

    public int $timestamp = 0;
    public array $peerList = [];
    public SdkPow $pow;
    public SdkSig $sig;

    public function __construct(){

        $this->pow = new SdkRequestPow();
        $this->sig = new SdkRequestSig();
    }
}