 #!/bin/bash

shopt -s expand_aliases

function pegInProposal() {

    #echo "" >&2
    #echo -e "${CYAN_LIGHT}[PEG IN]$NCOLOR" >&2

    local BC_ENV=$1
    local INDEX_E=$2
    local INDEX_B_PEG=$3
    local INDEX_B_BLOCK=$4

    echo "BC_ENV=$BC_ENV" >&2
    echo "INDEX_E=$INDEX_E" >&2
    echo "INDEX_B_PEG=$INDEX_B_PEG" >&2
    echo "INDEX_B_BLOCK=$INDEX_B_BLOCK" >&2

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV

    # echo "[PEG PROPOSAL $INDEX" >&2
    local BITCOIN_ADDRESS=$(bitcoinAddressInfo $INDEX_B_PEG "b_peg" $BC_CONF_DIR)
    local ELEMENTS_ADDRESS=$(elementsAddressInfo $INDEX_E "peg" $BC_CONF_DIR)


    local PEGINADDRESS=$(getWalletConfFileParamCMD "peg" $INDEX_E "E_CLI_GETPEGINADDRESS" $BC_CONF_DIR "" "" "")
    local MAINCHAIN=$(echo $PEGINADDRESS | jq -r '.mainchain_address')
    echo "MAINCHAIN=$MAINCHAIN" >&2
    local CLAIMSCRIPT=$(echo $PEGINADDRESS | jq -r '.claim_script')
    echo "CLAIMSCRIPT=$CLAIMSCRIPT" >&2

    local TXID=$(getWalletConfFileParamCMD "b_peg" $INDEX_B_PEG "B_CLI_SENDTOADDRESS" $BC_CONF_DIR $MAINCHAIN $PEG_AMOUNT "sendToWatchmen")
    local T="'''[\"'''$TXID'''\"]'''"
    echo "T=$T" >&2

    bitcoinMine $BC_ENV $BITCOIN_BLOCK_PARTICIPANT_NUMBER $BC_CONF_DIR

    bitcoinTxInfo $INDEX_B_PEG "b_peg" $TXID $BC_CONF_DIR "BITCOIN TXID" >2

    local PROOF=$(getWalletConfFileParamCMD "b_peg" $INDEX_B_PEG "B_CLI_GETTXOUTPROOF" $BC_CONF_DIR $T "" "")
    echo -e "\nPROOF=$PROOF" >&2
    local RAW=$(getWalletConfFileParamCMD "b_peg" $INDEX_B_PEG "B_CLI_GETRAWTRANSACTION" $BC_CONF_DIR $TXID "" "")
    echo -e "\nRAW=$RAW" >&2
    local CLAIMTXID=$(getWalletConfFileParamCMD "peg" $INDEX_E "E_CLI_CLAIMPEGIN" $BC_CONF_DIR $RAW $PROOF $CLAIMSCRIPT)
    echo -e "\nCLAIMTXID=$CLAIMTXID" >&2

    local PROPOSAL=$(askFor $ELEMENTS_ADDRESS 'peg' $BC_CONF_DIR $PEG_PARTICIPANT_MAX $PEG_AMOUNT $BC_ENV 'peg' 'pegInValidation' "" "" "")

    local NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 "none")

    elementsTxInfo $INDEX_E "peg" $CLAIMTXID $CLAIMTXID $BC_CONF_DIR "CLAIMTXID" >&2

    bitcoinAddressInfo $INDEX_B_PEG "b_peg" $BC_CONF_DIR >&2
    elementsAddressInfo $INDEX_E "peg" $BC_CONF_DIR >&2

    echo $ELEMENTS_WALLET_INFO
}
export -f pegInProposal

RES=$(pegInProposal ${1} ${2} ${3} ${4})

echo $RES