 #!/bin/bash

shopt -s expand_aliases

function blockProposal() {

    # echo "" >&2
    # echo -e "${CYAN_LIGHT}[PEG IN]$NCOLOR" >&2
    local BC_ENV="$1"
    local INDEX=$2
    local HEX="$3"

    echo "BC_ENV=$BC_ENV" >&2
    echo "INDEX=$INDEX" >&2
    echo "HEX=$HEX" >&2
    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV

    for a in `seq 1 102`;
    do

      local BLOCKCOUNT1=$(getWalletConfFileParamCMD "block" $INDEX "E_CLI_GETBLOCKCOUNT" $BC_CONF_DIR "" "" "")
      echo "BLOCK_CURRENT_BEFORE=$BLOCKCOUNT1" >&2
      local addressFrom=$(elementsAddressInfo $INDEX "block" $BC_CONF_DIR)
      # echo "addressFrom=$addressFrom" >&2
      local REDEEMSCRIPT=$(getWalletConfFileParam "block" $INDEX "REDEEMSCRIPT" $BC_CONF_DIR "" "" "")
      # echo "REDEEMSCRIPT=$REDEEMSCRIPT" >&2

      local HEXF=$HEX

      if [ "$HEX" == "none" ];then
          echo "none" >&2
          HEXF=$(getWalletConfFileParamCMD "block" $INDEX "E_CLI_GETNEWBLOCKHEX" $BC_CONF_DIR "" "" "")
          # echo "HEX=$HEX" >&2
      else
        HEXF=$HEX
      fi
      PROPOSAL=$(askFor $addressFrom 'block' $BC_CONF_DIR $BLOCK_PARTICIPANT_MAX $BLOCK_AMOUNT $BC_ENV 'block' 'blockValidation' $HEXF "")
      sleep 20

      # echo "PROPOSAL=$PROPOSAL" >&2
      local COMBINED=$(getWalletConfFileParamCMD "block" $INDEX "E_CLI_COMBINEBLOCKSIGS" $BC_CONF_DIR $HEXF "'$PROPOSAL'" "")

      # echo "COMBINED=$COMBINED" >&2
      local SIGNEDBLOCK=$(echo $COMBINED | jq -r '.hex')
      # echo "SIGNEDBLOCK=$SIGNEDBLOCK" >&2
      local SUBMIT=$(getWalletConfFileParamCMD "block" $INDEX "E_CLI_SUBMITBLOCK" $BC_CONF_DIR $SIGNEDBLOCK "" "")
      # echo "SUBMIT=$SUBMIT" >&2
      local BLOCKCOUNT2=$(getWalletConfFileParamCMD "block" $INDEX "E_CLI_GETBLOCKCOUNT" $BC_CONF_DIR "" "" "")
      # echo "BLOCK_CURRENT_AFTER=$BLOCKCOUNT2" >&2
      local RES=$(($BLOCKCOUNT2-$BLOCKCOUNT1))
    done
    echo $BLOCKCOUNT2 >&2
    echo $BLOCKCOUNT2
}
export -f blockProposal

RES=$(blockProposal ${1} ${2} ${3})

echo $RES

