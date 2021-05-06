 #!/bin/bash

shopt -s expand_aliases

function askForBlockProposal() {

    #echo "" >&2
    #echo -e "${CYAN_LIGHT}[pegInProposal]$NCOLOR" >&2

    local BC_ENV=$1
    # echo "BC_ENV=$BC_ENV" >&2

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../conf/conf.sh $BC_ENV
    INDEX=$((1 + RANDOM % $BLOCK_PARTICIPANT_NUMBER))
    local NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV $INDEX "none")

    echo $NEWBLOCK
}
export -f askForBlockProposal

RES=$(askForBlockProposal ${1})

echo $RES
