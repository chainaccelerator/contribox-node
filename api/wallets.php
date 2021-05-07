<?php

require_once 'lib/_require.php';

function infoType(string $network, string $type):string{

    $prefix=$network.'_a_'.$type.'_';
    $files = glob(Conf::$BC_CONF_DIR.'/'.$prefix.'*');
    $content = array();

    foreach($files as $k => $addressFile) {

        $i = json_decode(file_get_contents($addressFile));
        if($network === 'e') $cmd = $i->E_CLI_GETWALLETINFO;
        if($network === 'b') $cmd = $i->B_CLI_GETWALLETINFO;
        $args = '';
        $result = '';
        exec($cmd.' '.$args, $result, $result_code);
        $a = implode('', $result);
        $a = json_decode($a);

        if($network === 'b') {

            $walletName = $a->walletname;
            $address = $a->pubAddress;
            $balance = (string) $a->balance;
            $unconfirmed_balance = (string) $a->unconfirmed_balance;
            $immature_balance = (string) $a->immature_balance;
        }
        else {

            $walletName = $a->walletname;
            $address = $a->pubAddress;
            $balance = (string) $a->balance->bitcoin;
            $unconfirmed_balance = (string) $a->unconfirmed_balance->bitcoin;
            $immature_balance = (string) $a->immature_balance->bitcoin;
        }
        $content[$i->walletInstance] = '<p class="wallet">';
        $content[$i->walletInstance] .= '<span class="walletname">'.$walletName.'</span>';
        $content[$i->walletInstance] .= '<span class="address">'.$address.'</span>';
        $content[$i->walletInstance] .= '<span class="balance">'.$balance.'</span>';
        $content[$i->walletInstance] .= '<span class="unconfirmed_balance">'.$unconfirmed_balance.'</span>';
        $content[$i->walletInstance] .= '<span class="immature_balance">'.$immature_balance.'</span>';
        $content[$i->walletInstance] .= '</p>';
    }
    ksort($content);

    return implode('', $content);
}
$BC_ENV = 'regtest';
$conf = new Conf($BC_ENV);

$b_block = '<h3>BITCOIN BLOCK</h3>';
$b_block .= '<p class="wallet">';
$b_block .= '<span class="walletname">walletName</span>';
$b_block .= '<span class="address">address</span>';
$b_block .= '<span class="balance">balance</span>';
$b_block .= '<span class="unconfirmed_balance">unconfirmed_balance</span>';
$b_block .= '<span class="immature_balance">immature_balance</span>';
$b_block .= '</p>';
$b_block .= infoType('b', 'block');

$b_peg = '<h3>BITCOIN PEG</h3>';
$b_peg .= '<p class="wallet">';
$b_peg .= '<span class="walletname">walletName</span>';
$b_peg .= '<span class="address">address</span>';
$b_peg .= '<span class="balance">balance</span>';
$b_peg .= '<span class="unconfirmed_balance">unconfirmed_balance</span>';
$b_peg .= '<span class="immature_balance">immature_balance</span>';
$b_peg .= '</p>';
$b_peg .= infoType('b', 'peg');

$block = '<h3>ELEMENTS BLOCK</h3>';
$block .= '<p class="wallet">';
$block .= '<span class="walletname">walletName</span>';
$block .= '<span class="address">address</span>';
$block .= '<span class="balance">balance</span>';
$block .= '<span class="unconfirmed_balance">unconfirmed_balance</span>';
$block .= '<span class="immature_balance">immature_balance</span>';
$block .= '</p>';
$block .= infoType('e', 'block');

$peg = '<h3>ELEMENTS PEG</h3>';
$peg .= '<p class="wallet">';
$peg .= '<span class="walletname">walletName</span>';
$peg .= '<span class="address">address</span>';
$peg .= '<span class="balance">balance</span>';
$peg .= '<span class="unconfirmed_balance">unconfirmed_balance</span>';
$peg .= '<span class="immature_balance">immature_balance</span>';
$peg .= '</p>';
$peg .= infoType('e', 'peg');

?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
.wallet {}
.address {
    display: inline-block;
    width: 260px;
}
.walletname {
    display: inline-block;
    width: 260px;
}
.balance {
    display: inline-block;
    width: 170px;
}
.unconfirmed_balance {
    display: inline-block;
    width: 180px;
}
.immature_balance {
    display: inline-block;
    width: 200px;
}
    </style>
</head>
<body>
<?php echo $b_block; ?>
<?php echo $b_peg; ?>
<?php echo $block; ?>
<?php echo $peg; ?>
</body>
</html>

