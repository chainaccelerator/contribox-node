<?php

class Shell {

    public static string $HOST_IP = '';
    public static string $EXTERNAL_IP = '';
    public static string $BLACK='\033[0;30m';
    public static string $GREY_DARK='\033[0;30m';
    public static string $RED='\033[0;31m';
    public static string $GREEN='\033[0;32m';
    public static string $BROWN='\033[0;33m';
    public static string $BLUE='\033[0;34m';
    public static string $PURPLE='\033[0;35m';
    public static string $CYAN='\033[0;36m';
    public static string $RED_LIGHT='\033[1;31m';
    public static string $GREEN_LIGHT='\033[1;32m';
    public static string $BROWN_LIGHT='\033[1;33m';
    public static string $BLUE_LIGHT='\033[1;34m';
    public static string $PURPLE_LIGHT='\033[1;35m';
    public static string $CYAN_LIGHT='\033[1;36m';
    public static string $GREY_LIGHT='\033[1;37m';
    public static string $NCOLOR='\033[0m';

    public static string $confFile;

    public static function echoSection(string $section):bool{

        echo self::$SYAN_LIGHT.'['.$section.']'.self::$NCOLOR;

        return true;
    }
    public static function echoSectionSub(string $sectionSub):bool{

        echo self::$SYAN_LIGHT.'['.$sectionSub.']'.self::$NCOLOR;

        return true;
    }

    public static function init(string $confFile) {

        self::$HOST_IP = self::ipGet();
        self::$conf = json_decode(file_get_contents($confFile));
        self::$EXTERNAL_IP = self::$conf::$EXTERNAL_IP;
    }
    public static function cmd(string $cmd, bool $silent = false): string {

        if($silent === true) $cmd .= ' > /dev/null 2>&1';

        exec($cmd, $output = [], $return_code = 0);

        return implode('', $output);
    }
    public static function cmdPhp(string $cmd, bool $silent = false): string{

        return self::cmd("php ".dirname(__FILE__).'../'.self::$baseDir.'/'.$cmd, $silent);
    }
    public static function cmdApt(string $cmd): string{

        return self::cmd('apt '.$scmd.' -y -qq', true);
    }
    public static function cmdAptUpdate(){

        Shell::cmdApt(update);

        return Shell::cmdApt(upgrade);
    }
    public static function cmdAptInstall(string $cmd): string{

        return self::cmd('apt install '.$scmd.' -y -qq', true);
    }
    public static function cmdGitClone(string $gitUri, string $dir, string $right, string $user): string{

        self::cmd('git clone '.$gitUri.' '.$dir, true);

        return self::chmodchown($dir, $right, $user);
    }
    public static function chmodchown(string $dir, string $right, string $user):string {

        self::cmd('chmod $dir $right -R');

        return self::cmd('chown $dir $user -R');
    }
    public static function ipGet(): string{

        return self::cmd("echo $(ip -j address | jq '.[1].addr_info[0].local')", false);
    }
    public static function mkdir(string $dir, string $right, string $user): bool{

        if(is_dir($dir) === false)  mkdir($dir);

        return self::chmodchown($dir, $right, $user);
    }
    public static function rmdir(string $dir): bool{

        if(is_dir($dir) === false) return true;

        return unlink($dir);
    }
    public static function kill(string $name):bool {

        $pid = self::cmd("echo $(pidof '".$name."')");

        if(empty($pid) === fasle) {

          self::cmd("kill -9 ".$name);
          return true;
        }
        return false;
    }
    public static function confGet():bool{

        self::$conf = json_decode(file_get_contents(self::$CONF_FILE));

        return true;
    }
    public static function phpServerStart(string $dir, string $dirLog, string $serviceName, string $port): string {

        return self::cmd('php -d error_reporting=E_ALL -d error_log='.$dirLog.'/'.$serviceName.'.log -S '.Shell::$HOST_IP.':'.$port.' -t '.$dir, false);
    }
    public static function pidStop(string $program):bool{

        $pid = self::cmd("export PHP_PID=$(pidof '".$program."')");

        if(empty($pid) === true) {

            self::cmd('kill -9 $PHP_PID');

            return true;
        }
        return false;
    }
    /*
    public static function serversUp() {

        ss -tlnp | grep "$1"
        }
        export -f serversUp

        confJsonGet() {

        eval "export $2=$(cat $1 | jq -r .$2)"
        }

        public static function createMultisigPubKeyList() {

            local BC_ENV=$1
          local TYPE=$2
          local PARTICIPANT_NUMBER=$3
          local BC_CONF_DIR=$4

           for a in `seq 1 $PARTICIPANT_NUMBER`;
            do
                PUBKEY=$(getWalletConfFileParam $TYPE $a "pubKey" $BC_CONF_DIR)

                if [ $a -eq 1 ];then
                    PUBKEY_LIST='"'$PUBKEY'"'
                else
                    PUBKEY_LIST=$PUBKEY_LIST',"'$PUBKEY'"'
                fi
            done
            echo $PUBKEY_LIST
        }

        public static function createMultisig(){

            local BC_ENV=$1
          local TYPE=$2
          local PUBKEY_LIST=$3
          local PARTICIPANT_MIN=$4
          local BC_CONF_DIR=$5

          echo BC_ENV=$BC_ENV >&2
          echo TYPE=$TYPE >&2
          echo PUBKEY_LIST=$PUBKEY_LIST >&2
          echo PARTICIPANT_MIN=$PARTICIPANT_MIN >&2
          echo BC_CONF_DIR=$BC_CONF_DIR >&2

          local PUBKEY_LIST0='['$PUBKEY_LIST']'
          echo ''${PUBKEY_LIST0}'' > $BC_CONF_DIR/"e_$TYPE_"${BC_ENV}"_pubKey_list.json"
          local MULTISIG=$(getWalletConfFileParamCMD $TYPE 1 "E_CLI_CREATEMULTISIG" $BC_CONF_DIR $PARTICIPANT_MIN "'[$PUBKEY_LIST]'" "legacy")
          local REDEEMSCRIPT=$(echo $MULTISIG | jq -r '.redeemScript')
          # echo "" >&2
          # echo "REDEEMSCRIPT=$REDEEMSCRIPT" >&2

          echo $REDEEMSCRIPT
        }


        public static function askFor(){

            local addressFrom=$1
            local addressFromType=$2
            local BC_CONF_DIR=$3
            local PARTICIPANT_NUMBER=$4
            local amount=$5
            local bc_env=$6
            local addressType=$7
            local method=$8
            local hex=$9
            local script=${10}
            local proof=${11}

            # echo "" >&2
            # echo "addressFrom=$addressFrom" >&2
            # echo "addressFromType=$addressFromType" >&2
            # echo "BC_CONF_DIR=$BC_CONF_DIR" >&2
            # echo "PARTICIPANT_NUMBER=$PARTICIPANT_NUMBER" >&2
            # echo "amount=$amount" >&2
            # echo "bc_env=$bc_env" >&2
            # echo "addressType=$addressType" >&2
            # echo "method=$method" >&2
            echo "hex=$hex" >&2

            local RESULT='['
            local block=$(getWalletConfFileParamCMD $addressType 1 "E_CLI_GETBLOCKCOUNT" $BC_CONF_DIR "" "" "")
            block=$(($block+1))
            local O=5
            for j in $(seq 1 $O);
            do

                if [ $j -eq 1 ];then
                    local participant2=$(($PARTICIPANT_NUMBER/2))
                    participant2=$(($participant2+1))
                    local index2=$(($block % $participant2))
                elif [ $j -lt $O ];then

                    index2=$(($index2/2))
                    index2=$(($index2+1))
                    RESULT=$RESULT','
                elif [ $j -eq $O ];then
                    index2=$(($index2/2))
                    index2=$(($index2+1))
                    RESULT=$RESULT','
                fi
                local addressTo=$(getWalletConfFileParam $addressType $index2 "pubAddress" $BC_CONF_DIR)
                local pubKeyTo=$(getWalletConfFileParam $addressType $index2 "pubKey" $BC_CONF_DIR)
                echo -e "${CYAN}[$method index: $index2 $addressTo $pubKeyTo]$NCOLOR" >&2

                local addressTo=$(getWalletConfFileParam $addressType $index2 "pubAddress" $BC_CONF_DIR)
                local addressToType=$(getWalletConfFileParam $addressType $index2 "addressType" $BC_CONF_DIR)
                local HOST=$(getWalletConfFileParam $addressType $index2 "HOST_IP" $BC_CONF_DIR)
                local PORT=$(getWalletConfFileParam $addressType $index2 "API_PORT" $BC_CONF_DIR)
                local DATA=$(cat <<EOF
        {
            "jsonrpc": "1.0",
            "id": "curltest",
            "block": ${block},
            "bc_env": "${bc_env}",
            "method": "${method}",
            "from": {
                "address": "${addressFrom}",
                "type": "${addressFromType}"
            },
            "to": {
                "address": "${addressTo}",
                "type": "${addressType}"
            },
            "params": {
                "amount": ${amount},
                "hex": "${hex}",
                "script": "${script}",
                "proof": "${proof}"
            }
        }
        EOF
        )
                # echo "DATA=$DATA" >&2
                local RESULT_TMP=$(curl --digest -s -H "Accept: application/json" -H "Content-Type:application/json" -X POST --data "$DATA" "http://$HOST:$PORT/index.php")
                RESULT_TMP=$(echo $RESULT_TMP | jq '.success')
                # echo "VALIDATION=$RESULT_TMP" >&2
                RESULT=$RESULT$(eval echo $RESULT_TMP)
            done
            RESULT=$RESULT"]"
            echo "VALIDATION=$RESULT" >&2
            echo $RESULT
        }

        public static function bitcoinMine(){

            BC_ENV=$1
            BITCOIN_BLOCK_PARTICIPANT_NUMBER=$2
            BC_CONF_DIR=$3

            if [ "$BC_ENV" == "main" ];then
               local SLEEP=$((60*10*2))
               sleep $SLEEP
            else
              for a in `seq 1 $BITCOIN_BLOCK_PARTICIPANT_NUMBER`;
              do
                  local BITCOIN_ADDRESS2=$(getWalletConfFileParam "b_block" $a "pubAddress" $BC_CONF_DIR)
                local BITCOIN_BLOCK_GEN=$(getWalletConfFileParamCMD "b_block" $a "B_CLI_GENERATETOADDRESS" $BC_CONF_DIR 101 $BITCOIN_ADDRESS2 "")
              done
            fi
            sleep 20
        }

        public static function bitcoinAddressInfo(){

            local INDEX=$1
            local TYPE=$2
            local BC_CONF_DIR=$3

            local ADDRESS=$(getWalletConfFileParam $TYPE $INDEX "pubAddress" $BC_CONF_DIR)
            local WALLET=$(getWalletConfFileParam $TYPE $INDEX "wallet_name" $BC_CONF_DIR)
            local WALLET_INFO=$(getWalletConfFileParamCMD $TYPE $INDEX "B_CLI_GETWALLETINFO" $BC_CONF_DIR "" "" "")
            local BALANCE=$(echo $WALLET_INFO | jq -r '.balance')
            local BALANCE_IMMATURE=$(echo $WALLET_INFO | jq -r '.immature_balance')
            echo "ADDRESS=$ADDRESS WALLET=$WALLET BALANCE=$BALANCE BALANCE_IMMMATURE=$BALANCE_IMMATURE" >&2

            echo $ADDRESS
        }

        public static function elementsAddressInfo(){

            local INDEX=$1
            local TYPE=$2
            local BC_CONF_DIR=$3

            local ADDRESS=$(getWalletConfFileParam $TYPE $INDEX "pubAddress" $BC_CONF_DIR)
            local WALLET=$(getWalletConfFileParam $TYPE $INDEX "wallet_name" $BC_CONF_DIR)
            local WALLET_INFO=$(getWalletConfFileParamCMD $TYPE $INDEX "E_CLI_GETWALLETINFO" $BC_CONF_DIR "" "" "")
            local BALANCE=$(echo $WALLET_INFO | jq -r '.balance.bitcoin')
            local BALANCE_IMMATURE=$(echo $WALLET_INFO | jq -r '.immature_balance.bitcoin')
            echo "ADDRESS=$ADDRESS WALLET=$WALLET BALANCE=$BALANCE BALANCE_IMMMATURE=$BALANCE_IMMATURE" >&2

            echo $ADDRESS
        }

        public static function bitcoinTxInfo(){

            local INDEX=$1
            local TYPE=$2
            local TXID=$3
            local BC_CONF_DIR=$4
            local COMMENT=$5

            echo "COMMENT=$COMMENT" >&2
            local ADDRESS=$(getWalletConfFileParam $TYPE $INDEX "pubAddress" $BC_CONF_DIR)
            local WALLET=$(getWalletConfFileParam $TYPE $INDEX "wallet_name" $BC_CONF_DIR $TXID "" "" "")
            local WALLET=$(getWalletConfFileParamCMD $TYPE $INDEX "B_CLI_GETTRANSACTION" $BC_CONF_DIR $TXID "" "" "")
            local WALLET_AMOUNT=$(echo $WALLET | jq '.amount')
            local WALLET_FEE=$(echo $WALLET | jq '.fee')
            local WALLET_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
            local WALLET_CATEGORY=$(echo $WALLET | jq '.details[0].category')
            local WALLET_ABANDONED=$(echo $WALLET | jq '.details[0].abandoned')
            local WALLET_HEX=$(echo $WALLET | jq '.hex')
            echo "B_WALLET: ADDRESS=$ADDRESS WALLET:${WALLETNAME} txid:${TXID} amount:${WALLET_AMOUNT} fee:${WALLET_FEE} confirmations:${WALLET_CONFIRMATION} category:${WALLET_CATEGORY} abandoned:${WALLET_ABANDONED}" >&2
            local BC=$(getWalletConfFileParamCMD $TYPE $INDEX "B_CLI_GETRAWTRANSACTION" $BC_CONF_DIR $TXID 1 "")
            local BC_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
            local BC_CATEGORY=$(echo $WALLET | jq '.vout[0].value')
            local BC_ADDRESS0=$(echo $WALLET | jq '.vout[0].addresses[0]')
            echo "B_BC: txid=${TXID} confirmations:${BC_CONFIRMATION} address0:${BC_ADDRESS0}" >&2

            echo $WALLET_HEX
        }

        public static function elementsTxInfo(){

            local INDEX=$1
            local TYPE=$2
            local TXID=$3
            local BC_CONF_DIR=$4
            local COMMENT=$5

            echo "COMMENT=$COMMENT" >&2
            local WALLET=$(getWalletConfFileParamCMD $TYPE $INDEX "E_CLI_GETTRANSACTION" $BC_CONF_DIR $TXID "" "" "")
            local WALLETNAME=$(getWalletConfFileParam $TYPE $INDEX "wallet_name" $BC_CONF_DIR $TXID "" "" "")
            local WALLET_AMOUNT=$(echo $WALLET | jq '.amount.bitcoin')
            local WALLET_FEE=$(echo $WALLET | jq '.fee.bitcoin')
            local WALLET_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
            local WALLET_CATEGORY=$(echo $WALLET | jq '.details[0].category')
            local WALLET_ABANDONED=$(echo $WALLET | jq '.details[0].abandoned')
            local WALLET_HEX=$(echo $WALLET | jq '.hex')
            echo "E_WALLET: wallet:${WALLETNAME} txid=${TXID} amount:${WALLET_AMOUNT} fee:${WALLET_FEE} confirmations:${WALLET_CONFIRMATION} category:${WALLET_CATEGORY} abandoned:${WALLET_ABANDONED}" >&2
            local BC=$(getWalletConfFileParamCMD $TYPE $INDEX "E_CLI_GETRAWTRANSACTION" $BC_CONF_DIR $TXID 1 "")
            local BC_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
            local BC_VALUE=$(echo $WALLET | jq '.vout[0].value')
            local BC_ASSET=$(echo $WALLET | jq '.vout[0].asset')
            echo "E_BC: txid=${TXID} confirmations:${BC_CONFIRMATION} value:${BC_VALUE} asset:${BC_ASSET}" >&2

            echo $WALLET_HEX
        }

        public static function pegBlockAddressesInfo(){

            local BC_ENV=$1
          local BITCOIN_BLOCK_PARTICIPANT_NUMBER=$2
          local BITCOIN_PEG_PARTICIPANT_NUMBER=$3
          local BLOCK_PARTICIPANT_NUMBER=$4
          local PEG_PARTICIPANT_NUMBER=$5
          local BC_CONF_DIR=$6

          local MINE=$(bitcoinMine $BC_ENV $BITCOIN_BLOCK_PARTICIPANT_NUMBER $BC_CONF_DIR)
          local NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 "none")

          for a in `seq 1 $BITCOIN_BLOCK_PARTICIPANT_NUMBER`;
          do
              bitcoinAddressInfo $a "b_block" $BC_CONF_DIR >&2
          done
          for a in `seq 1 $BITCOIN_PEG_PARTICIPANT_NUMBER`;
          do
              bitcoinAddressInfo $a "b_peg" $BC_CONF_DIR >&2
          done
          for a in `seq 1 $BLOCK_PARTICIPANT_NUMBER`;
          do
              elementsAddressInfo $a "block" $BC_CONF_DIR >&2
          done
          for a in `seq 1 $PEG_PARTICIPANT_NUMBER`;
          do
              elementsAddressInfo $a "peg" $BC_CONF_DIR >&2
          done
        }
    */
}