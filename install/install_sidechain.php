<?php

require_once '../lib/_require.php';

Shell::$HOST_IP = Shell::ipGet();
Shell::cmdApt('update');
Shell::cmdApt('full-upgrade');
Shell::cmdApt('install curl git jq wget lsb-release apt-transport-https ca-certificates sed dos2unix');
Shell::mkdir(Shell::$dirWww);
Shell::mkdir(Shell::$dirWwwProject);
Shell::cmdGitClone('https://github.com/chainaccelerator/contribox-node.git', Shell::$dirWwwProject);
Shell::kill('bitcoin-qt');
Shell::kill('elements-qt');
Shell::confGet();
Shell::env_dir_init();

$env = $argv[0];

Contribox::constructAll($env);
BitcoinNode::constructAll($env);


ElementsNode::$mainchain = BitcoinNode::$instanceList[0];
ElementNode::constructAll($env);

source $BC_APP_INSTALL_DIR/elements.sh 1 $NODE_CONF_FILE $CODE_CONF_FILE "" "" "" ""

if [ $NEW_NODE -eq 0 ];then

  export BLOCK_LIST_CONF=$(wallet_gen "block" $BLOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
  export BLOCK_PUBKEY_LIST=$(createMultisigPubKeyList $BC_ENV "block" $BLOCK_PARTICIPANT_NUMBER $BC_CONF_DIR)
  echo "BLOCK_PARTICIPANT_MIN=$BLOCK_PARTICIPANT_MIN"
  export BLOCK_REDEEMSCRIPT=$(createMultisig $BC_ENV "block" $BLOCK_PUBKEY_LIST $BLOCK_PARTICIPANT_MIN $BC_CONF_DIR)

  export PEG_LIST_CONF=$(wallet_gen "peg" $PEG_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
  export PEG_PUBKEY_LIST=$(createMultisigPubKeyList $BC_ENV "peg" $PEG_PARTICIPANT_NUMBER $BC_CONF_DIR)
  echo "PEG_PARTICIPANT_MIN=$PEG_PARTICIPANT_MIN"
  export PEG_REDEEMSCRIPT=$(createMultisig $BC_ENV "peg" $PEG_PUBKEY_LIST $PEG_PARTICIPANT_MIN $BC_CONF_DIR)

  for a in `seq 1 $NUMBER_NODES`;
  do
      source $BC_APP_INSTALL_DIR/elements.sh "$a" $NODE_CONF_FILE $CODE_CONF_FILE $BLOCK_REDEEMSCRIPT $PEG_REDEEMSCRIPT "[$BLOCK_PUBKEY_LIST]" "[$PEG_PUBKEY_LIST]"

      if [ $a -eq 1 ];then

        export BLOCK_LIST_CONF=$(wallet_gen "block" $BLOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
        export LOAD=$(eval "$E_CLI_LOADWALLET \"\"")
        export NODE_PUB_ADDRESS=$(getWalletConfFileParam "block" 1 "pubAddress" $BC_CONF_DIR)

        export SEND_INITIAL=$(eval "$E_CLI_SENDTOADDRESS2 $NODE_PUB_ADDRESS 21000000 'InitialTokens' "''" true true")
        echo "SEND_INITIAL=$SEND_INITIAL"
        export NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 "none")

        export PEG_LIST_CONF=$(wallet_gen "peg" $BLOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
        export NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 "none")

        export MAIN_LIST_CONF=$(wallet_gen "main" $MAIN_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export FROM_LIST_CONF=$(wallet_gen "from" $FROM_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export TO_LIST_CONF=$(wallet_gen "to" $TO_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export NODE_LIST_CONF=$(wallet_gen "node" $NODE_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export LOCK_LIST_CONF=$(wallet_gen "lock" $LOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV"  $BC_CONF_DIR)
        export BACKUP_LIST_CONF=$(wallet_gen "backup" $BACKUP_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export COSIGNER_LIST_CONF=$(wallet_gen "cosigner" $COSIGNER_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export WITNESS_LIST_CONF=$(wallet_gen "witness" $WITNESS_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export SHARE_LIST_CONF=$(wallet_gen "share" $SHARE_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export SOLD_LIST_CONF=$(wallet_gen "old" $OLD_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export MEMBER_LIST_CONF=$(wallet_gen "member" $MEMBER_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export BOARD_LIST_CONF=$(wallet_gen "board" $BOARD_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export BAN_LIST_CONF=$(wallet_gen "ban" $BAN_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export WITNESSORG_LIST_CONF=$(wallet_gen "witnessOrg" $WITNESSORG_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export COSIGNERORG_LIST_CONF=$(wallet_gen "cosignerOrg" $COSIGNERORG_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export PARENTTYPE1_LIST_CONF=$(wallet_gen "parentstype1" $PARENTTYPE1_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export CHILDTYPE1_LIST_CONF=$(wallet_gen "childstype1" $CHILDTYPE1_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
        export INVESTORTYPE1_LIST_CONF=$(wallet_gen "investorType1" $CHILDTYPE1_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
      fi
      export API_LIST_CONF=$(wallet_gen "api" $API_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
  done
  if [ $PEG -eq 1 ];then

      export INDEX_E=1
      export INDEX_B_PEG=1
      export INDEX_B_BLOCK=1

      echo "" >&2
      echo -e "${BROWN}[FIRST PEG IN]$NCOLOR" >&2
      FIRSTPEG=$($BC_APP_SCRIPT_DIR/pegInProposal.sh $BC_ENV $INDEX_E $INDEX_B_PEG $INDEX_B_BLOCK)

      echo "" >&2
      echo -e "${BROWN}[FIRST PEG OUT]$NCOLOR" >&2
      FIRSTPEG=$($BC_APP_SCRIPT_DIR/pegOut.sh $BC_ENV $INDEX_E $INDEX_B_PEG $INDEX_B_BLOCK)
  fi
fi

apt autoremove -y -q=2


serversUp "php"
serversUp "bitcoin"
serversUp "elements"
