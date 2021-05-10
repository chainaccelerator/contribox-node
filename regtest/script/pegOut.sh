 #!/bin/bash

shopt -s expand_aliases

function pegOutProposal() {

    #echo "" >&2
    #echo -e "${CYAN_LIGHT}[PEG IN]$NCOLOR" >&2

    local BC_ENV=$1
    local INDEX_E=$2
    local INDEX_B_PEG=$3
    local INDEX_B_BLOCK=$4
    # echo "BC_ENV=$BC_ENV" >&2

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV

    # echo "[PEG PROPOSAL $INDEX" >&2
    local BITCOIN_ADDRESS=$(bitcoinAddressInfo $INDEX_B_PEG "b_peg" $BC_CONF_DIR)
    local ELEMENTS_ADDRESS=$(elementsAddressInfo $INDEX_E "peg" $BC_CONF_DIR)

    local SENDTOMAINCHAIN=$(getWalletConfFileParamCMD "peg" $INDEX_E "E_CLI_SENDTOMAINCHAIN" $BC_CONF_DIR $BITCOIN_ADDRESS 0.0002 true)

    NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 "none")

    elementsTxInfo $INDEX_E "peg" $SENDTOMAINCHAIN $CLAIMTXID $BC_CONF_DIR "SENDTOMAINCHAIN" >&2

    bitcoinMine $BC_ENV $BITCOIN_BLOCK_PARTICIPANT_NUMBER $BC_CONF_DIR

    bitcoinAddressInfo $INDEX_B_PEG "b_peg" $BC_CONF_DIR >&2e
    elementsAddressInfo $INDEX_E "peg" $BC_CONF_DIR >&2

    echo $ELEMENTS_BALANCE
}
export -f pegOutProposal

PEGOUT=$(pegOutProposal ${1} ${2} ${3})

echo $PEGOUT
