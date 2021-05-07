#!/bin/bash

shopt -s expand_aliases

rm -rf $BITCOIN_LOG_ROOT_PATH/*
rm -rf $ELEMENTS_LOG_ROOT_PATH/*

echo ""
echo -e "${CYAN_LIGHT}[WEB SERVER]${NCOLOR}"
echo -e "${GREEN_LIGHT}START${NCOLOR}"
rm  -rf $BC_API_LOG_FILE
php -d error_reporting=E_ALL -d error_log=$BC_API_LOG_FILE -S $HOST_IP:$API_PORT -t $BC_APP_API_DIR > /dev/null 2>&1 &
touch $BC_RIGHTS_FILES $BC_API_LOG_FILE
chmod $BC_RIGHTS_FILES $BC_API_LOG_FILE
chown $BC_USER $BC_API_LOG_FILE
if [ ! $NEW_NODE -eq 1 ];then

    source $BC_APP_INSTALL_DIR/bitcoin.sh

    export B_BLOCK_CONF_FILE=$(bitcoinWallet_gen "main" $BITCOIN_MAIN_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE $CYAN $NCOLOR $BC_ENV $BC_CONF_DIR)
    export B_BLOCK_CONF_FILE=$(bitcoinWallet_gen "block" $BITCOIN_BLOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE $CYAN $NCOLOR $BC_ENV $BC_CONF_DIR)
    export B_PEG_CONF_FILE=$(bitcoinWallet_gen "peg" $BITCOIN_PEG_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE $CYAN $NCOLOR $BC_ENV $BC_CONF_DIR)

    echo "" >&2
    echo -e "${BROWN}[TMP BLOCK WALLET]$NCOLOR" >&2

    source $BC_APP_INSTALL_DIR/elements.sh 1 $NODE_CONF_FILE $CODE_CONF_FILE "" "" "" ""

    export BLOCK_LIST_CONF=$(wallet_gen "block" $BLOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
    export BLOCK_PUBKEY_LIST=$(createMultisigPubKeyList $BC_ENV "block" $BLOCK_PARTICIPANT_NUMBER $BC_CONF_DIR)
    export BLOCK_REDEEMSCRIPT=$(createMultisig $BC_ENV "block" $BLOCK_PUBKEY_LIST $BLOCK_PARTICIPANT_MIN $BC_CONF_DIR)

    echo "" >&2
    echo -e "${BROWN}[TMP PEG WALLET]$NCOLOR" >&2

    export PEG_LIST_CONF=$(wallet_gen "peg" $PEG_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
    export PEG_PUBKEY_LIST=$(createMultisigPubKeyList $BC_ENV "peg" $PEG_PARTICIPANT_NUMBER $BC_CONF_DIR)
    export PEG_REDEEMSCRIPT=$(createMultisig $BC_ENV "peg" $PEG_PUBKEY_LIST $PEG_PARTICIPANT_MIN $BC_CONF_DIR)

    I=$(pegBlockAddressesInfo $BC_ENV $BITCOIN_BLOCK_PARTICIPANT_NUMBER $BITCOIN_PEG_PARTICIPANT_NUMBER $BLOCK_PARTICIPANT_NUMBER $PEG_PARTICIPANT_NUMBER $BC_CONF_DIR)
    exit

    for a in `seq 1 $NUMBER_NODES`;
    do
        source $BC_APP_INSTALL_DIR/elements.sh "$a" $NODE_CONF_FILE $CODE_CONF_FILE $BLOCK_REDEEMSCRIPT $PEG_REDEEMSCRIPT "[$BLOCK_PUBKEY_LIST]" "[$PEG_PUBKEY_LIST]"

        if [ $a -eq 1 ];then

            echo "" >&2
            echo -e "${BROWN}[BLOCK WALLET]$NCOLOR" >&2

            declare -a CONF_FILE_LIST
            for i in `seq 1 $MULTISIG_PARTICIPANT_NUMBER`;
            do
                PRIVKEY=$(getWalletConfFileParam "block" $i "prvKey" $BC_CONF_DIR "" "" "")
                source $BC_APP_INSTALL_DIR/elementsCreateWallet.sh $E_BLOCK_GEN_CONF $i "block" $PRIVKEY
                CONF_FILE_LIST[$i]=$(elementsGetAddressConf "$BC_ENV" $a $i "block" $BC_CONF_DIR)
            done
            separator='","'
            regex="$( printf "${separator}%s" ${CONF_FILE_LIST[@]} )"
            regex="${regex:${#separator}}"
            CONF=$BC_CONF_DIR/${ADDRESS_TYPE}_wallets.json
            echo '["'$regex'"]' > $CONF
            BLOCK_LIST_CONF=$CONF

            echo "" >&2
            echo -e "${BROWN}[PEG WALLET]$NCOLOR" >&2

            declare -a CONF_FILE_LIST
            for i in `seq 1 $PEG_PARTICIPANT_NUMBER`;
            do
                PRIVKEY=$(getWalletConfFileParam "peg" $i "prvKey" $BC_CONF_DIR "" "" "")
                source $BC_APP_INSTALL_DIR/elementsCreateWallet.sh $E_BLOCK_GEN_CONF $i "peg" $PRIVKEY
                CONF_FILE_LIST[$i]=$(elementsGetAddressConf "$BC_ENV" $a $i "peg" $BC_CONF_DIR)
            done
            separator='","'
            regex="$( printf "${separator}%s" ${CONF_FILE_LIST[@]} )"
            regex="${regex:${#separator}}"
            CONF=$BC_CONF_DIR/${ADDRESS_TYPE}_wallets.json
            echo '["'$regex'"]' > $CONF
            PEG_LIST_CONF=$CONF
        fi
    done

    I=$(pegBlockAddressesInfo $BC_ENV $BITCOIN_BLOCK_PARTICIPANT_NUMBER $BITCOIN_PEG_PARTICIPANT_NUMBER $BLOCK_PARTICIPANT_NUMBER $PEG_PARTICIPANT_NUMBER $BC_CONF_DIR)

    echo "" >&2
    echo -e "${BROWN}[FIRST BLOCK]$NCOLOR" >&2

    export INDEX_E=1
    export INDEX_B_PEG=1
    export INDEX_B_BLOCK=1

    NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 "none")
    exit

    if [ $PEG -eq 1 ];then
        echo "" >&2
        echo -e "${BROWN}[FIRST PEG IN]$NCOLOR" >&2
        FIRSTPEG=$($BC_APP_SCRIPT_DIR/pegInProposal.sh $BC_ENV $INDEX_E $INDEX_B_PEG $INDEX_B_BLOCK)

        echo "" >&2
        echo -e "${BROWN}[FIRST PEG OUT]$NCOLOR" >&2
        FIRSTPEG=$($BC_APP_SCRIPT_DIR/pegOut.sh $BC_ENV $INDEX_E $INDEX_B_PEG $INDEX_B_BLOCK)
    fi
    export MAIN_LIST_CONF=$(wallet_gen "main" $NUMBER_NODES $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
    export LOCK_LIST_CONF=$(wallet_gen "lock" $LOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR" "$BC_ENV"  $BC_CONF_DIR)
    export BACKUP_LIST_CONF=$(wallet_gen "backup" $BACKUP_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
    export WITNESS_LIST_CONF=$(wallet_gen "witness" $WITNESS_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
else
    source $BC_APP_INSTALL_DIR/bitcoin.sh

    $BC_APP_INSTALL_DIR/bitcoinCreateWallet.sh $NODE_CONF_FILE 1 "block"
    B_BLOCK_CONF_FILE=$(bitcoinGetAddressConf "$BC_ENV" 1 1 "block" $BC_CONF_DIR)
    CONF=$BC_CONF_DIR/b_block_wallets.json
    echo '["'$B_BLOCK_CONF_FILE'"]' > $CONF

    $BC_APP_INSTALL_DIR/bitcoinCreateWallet.sh $NODE_CONF_FILE 1 "peg"
    B_PEG_CONF_FILE=$(bitcoinGetAddressConf "$BC_ENV" 1 1 "peg" $BC_CONF_DIR)
    CONF=$BC_CONF_DIR/b_peg_wallets.json
    echo '["'$B_PEG_CONF_FILE'"]' > $CONF

    echo '["'$regex'"]' > $CONF
    B_PEG_CONF_FILE=$CONF

    source $BC_APP_INSTALL_DIR/elements.sh 1 $NODE_CONF_FILE $CODE_CONF_FILE "" "" "" ""

    export MAIN_LIST_CONF=$(wallet_gen "main" $NUMBER_NODES $BC_APP_INSTALL_DIR $NODE_CONF_FILE_BACK "$CYAN" "$NCOLOR" "$BC_ENV" $BC_CONF_DIR)
    export LOCK_LIST_CONF=$(wallet_gen "lock" $LOCK_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE_BACK "$CYAN" "$NCOLOR" "$BC_ENV"  $BC_CONF_DIR)
    export BACKUP_LIST_CONF=$(wallet_gen "backup" $BACKUP_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE_BACK "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
    export WITNESS_LIST_CONF=$(wallet_gen "witness" $WITNESS_PARTICIPANT_NUMBER $BC_APP_INSTALL_DIR $NODE_CONF_FILE_BACK "$CYAN" "$NCOLOR"  "$BC_ENV" $BC_CONF_DIR)
fi

if [ $APT_UPDATE_UPGRADE -eq 1 ];then
  apt autoremove -y -q=2
fi
