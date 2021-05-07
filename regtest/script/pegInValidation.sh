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

    local blockAddress=$(elementsAddressInfo $INDEX_E_BLOCK "block" $BC_CONF_DIR)
    local GENERATE=$(getWalletConfFileParamCMD "peg" $INDEX_E_PEG "E_CLI_GENERATETOADDRESS" $BC_CONF_DIR 1 $blockAddress "")
    local RES=$(echo $GENERATE | jq '.[0]')

    echo $RES
}
export -f pegInValidation

RES=$(pegInValidation ${1} ${2} ${3})
