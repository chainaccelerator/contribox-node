 #!/bin/bash

shopt -s expand_aliases

function pegInValidation() {

    #echo "" >&2
    #echo -e "${CYAN_LIGHT}[PEG IN]$NCOLOR" >&2

    local BC_ENV=$1
    local INDEX_E_PEG=$2
    local INDEX_E_BLOCK=$3
    # echo "BC_ENV=$BC_ENV" >&2
    # echo "INDEX_E_PEG=$INDEX_E_PEG" >&2
    # echo "INDEX_E_BLOCK=$INDEX_E_BLOCK" >&2

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV

    local RES=""
    local blockAddress0=$(elementsAddressInfo $INDEX_E_PEG "peg" $BC_CONF_DIR)
    echo "blockAddress0=$blockAddress0" >&2
    # local LIST=$(getWalletConfFileParamCMD "peg" $INDEX_E_PEG "E_CLI_GETRAWMEMPOOL" $BC_CONF_DIR false)
    # echo "LIST=$LIST" >&2
    local HASH=$(getWalletConfFileParamCMD "peg" $INDEX_E_PEG "E_CLI_GENERATE" $BC_CONF_DIR 101)
    HASH=$(echo $HASH | jq '.[0]')
    echo "HASH=$HASH" >&2

    # local GENERATE=$(getWalletConfFileParamCMD "peg" $INDEX_E_PEG "E_CLI_GENERATETOADDRESS" $BC_CONF_DIR 1 $blockAddress0 "")
    # local RES0=$(echo $GENERATE | jq '.[0]')
    # RES="$RES $RES0 $blockAddress0 "

    local NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 $HASH)
    # for a in `seq 1 $BLOCK_PARTICIPANT_NUMBER`;
    # do
       # local blockAddress=$(elementsAddressInfo $a "block" $BC_CONF_DIR)
       # local GENERATE=$(getWalletConfFileParamCMD "peg" $INDEX_E_PEG "E_CLI_GENERATETOADDRESS" $BC_CONF_DIR 1 $blockAddress "")
       # RES0=$(echo $GENERATE | jq '.[0]')
       # RES=$RES", "$RES0
    # done
    echo $HASH
}
export -f pegInValidation

RES=$(pegInValidation ${1} ${2} ${3})
