#!/bin/bash

shopt -s expand_aliases

clear

export BC_ENV=$1
export BC_USER=$2
export BC_RIGHTS_FILES=$3
export EXTERNAL_IP=$4
export HOST_IP=$5
export FIRST_CONNECT=$6
# export EXTERNAL_IP="10.10.242.30"
# export FIRST_CONNECT="10.0.0.2"

if [ ! -d "/var/www" ];then

  mkdir "/var/www"
  chmod $BC_USER "/var/www"
  chown $BC_RIGHTS_FILES "/var/www"
fi
if [ -d "/var/www/contribox-node" ];then

  rm -rf /var/www/contribox-node
fi

apt install git -y
git clone 'https://github.com/chainaccelerator/contribox-node.git' /var/www/contribox-node
cd /var/www/contribox-node/install
source /var/www/contribox-node/install/install_sidechain.sh $BC_ENV 1 $BC_USER $BC_RIGHTS_FILES $EXTERNAL_IP $HOST_IP $FIRST_CONNECT
rm -rf /tmp/install_node.sh
