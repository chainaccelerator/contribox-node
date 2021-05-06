 #!/bin/bash

shopt -s expand_aliases

function askForPegOutProposal() {

    #echo "" >&2
    #echo -e "${CYAN_LIGHT}[pegInProposal]$NCOLOR" >&2

    local BC_ENV=$1
    # echo "BC_ENV=$BC_ENV" >&2

    local BASEDIR0=$(dirname "$0")
    INDEX_E=$((1 + RANDOM % $PEG_PARTICIPANT_NUMBER))
    INDEX_B=$((1 + RANDOM % $BITCOIN_PARTICIPANT_NUMBER))
    local PEG_OUT=$($BC_APP_SCRIPT_DIR/pegOut.sh $BC_ENV $INDEX_E $INDEX_B)

    echo $PEG_OUT
}
export -f askForPegOutProposal

RES=$(askForPegOutProposal ${1})

echo $RES


