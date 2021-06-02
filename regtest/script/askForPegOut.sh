 #!/bin/bash

shopt -s expand_aliases

BASEDIR=$(dirname "$0")
source $BASEDIR/../../conf/conf.sh $1

RES=$(askForPegOut ${1})

echo $RES


