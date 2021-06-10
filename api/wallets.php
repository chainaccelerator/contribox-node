<?php

require_once 'lib/_require.php';

function infoType(string $network, string $type):string{

    $BC_CONF_DIR = Conf::$BC_CONF_DIR;
    if ( $type == "block" || $type == "peg" || $type == "node" ) {
        $BC_CONF_DIR = $BC_CONF_DIR .'/federation';
    }
    else {
        $BC_CONF_DIR = $BC_CONF_DIR.'/local';
    }
    $basename = $network.'_'.$type.'.wallets.json';
    $file = $BC_CONF_DIR.'/'.$basename;

    if(is_file($file) === false) return '';

    $files0 = glob($file);
    $content = array();

    foreach($files0 as $k => $addressFile0) {

        $i0 = json_decode(file_get_contents($addressFile0));

        foreach ($i0 as $k => $addressFile) {

            $i = json_decode(file_get_contents($addressFile));
            $cmd = '';
            if ($network === 'e') $cmd = $i->E_CLI_GETWALLETINFO;
            if ($network === 'b') $cmd = $i->B_CLI_GETWALLETINFO;
            $args = '';
            $result = '';
            exec($cmd . ' ' . $args, $result, $result_code);
            $a = implode('', $result);
            $a = json_decode($a);
            $walletName = $a->walletname;
            $address = $i->pubAddress;

            if ($network === 'b') {

                $balance = (string)$a->balance;
                $unconfirmed_balance = (string)$a->unconfirmed_balance;
                $immature_balance = (string)$a->immature_balance;
            } else {

                $balance = (string)$a->balance->bitcoin;
                $unconfirmed_balance = (string)$a->unconfirmed_balance->bitcoin;
                $immature_balance = (string)$a->immature_balance->bitcoin;
            }


            $content[$i->walletInstance] = '<p class="wallet">';
            $content[$i->walletInstance] .= '<span class="walletname">' . $walletName . '</span>';
            $content[$i->walletInstance] .= '<span class="address">' . $address . '</span>';
            $content[$i->walletInstance] .= '<span class="balance">' . $balance . '</span>';
            $content[$i->walletInstance] .= '<span class="unconfirmed_balance">' . $unconfirmed_balance . '</span>';
            $content[$i->walletInstance] .= '<span class="immature_balance">' . $immature_balance . '</span>';
            $content[$i->walletInstance] .= '</p>';
        }
    }
    ksort($content);

    return implode('', $content);
}
function infoTypeHTml(string $network, string $type):string{

    $html = '<h3>BITCOIN '.$type.'</h3>';
    $html .= '<p class="wallet">';
    $html .= '<span class="walletname">walletName</span>';
    $html .= '<span class="address">address</span>';
    $html .= '<span class="balance">balance</span>';
    $html .= '<span class="unconfirmed_balance">unconfirmed_balance</span>';
    $html .= '<span class="immature_balance">immature_balance</span>';
    $html .= '</p>';
    $html .= infoType($network, $type);

    return $html;
}

$BC_ENV = 'regtest';
$conf = new Conf($BC_ENV);
$b_block = infoTypeHTml('b', 'block');
$b_peg = infoTypeHTml('b', 'peg');
$b_main = infoTypeHTml('b', 'main');
$b_node = infoTypeHTml('b', 'node');
$block = infoTypeHTml('e', 'block');
$peg = infoTypeHTml('e', 'peg');
$main = infoTypeHTml('e', 'main');
$node = infoTypeHTml('e', 'node');
$lock = infoTypeHTml('e', 'lock');
$backup = infoTypeHTml('e', 'backup');
$witness = infoTypeHTml('e', 'witness');
$share = infoTypeHTml('e', 'share');
$convert = infoTypeHTml('e', 'convert');
$share = infoTypeHTml('e', 'share');
$post = infoTypeHTml('e', 'post');
$get = infoTypeHTml('e', 'get');

?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
span, p {
    padding-top: 2px;
    padding-bottom: 2px;
    margin-top: 0px;
    margin-bottom: 0px;
}
aside {
    display: block;
    float: left;
    width: 200px;
}
.wallet {}
.address {
    font-size: 10px;
    display: inline-block;
    width: 400px;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-top: 0px;
    margin-bottom: 0px;
}
.walletname {
    font-size: 10px;
    display: inline-block;
    width: 260px;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-top: 0px;
    margin-bottom: 0px;
}
.balance {
    font-size: 10px;
    display: inline-block;
    width: 170px;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-top: 0px;
    margin-bottom: 0px;
}
.unconfirmed_balance {
    font-size: 10px;
    display: inline-block;
    width: 180px;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-top: 0px;
    margin-bottom: 0px;
}
.immature_balance {
    font-size: 10px;
    display: inline-block;
    width: 200px;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-top: 0px;
    margin-bottom: 0px;
}
    </style>
</head>
<body>
<section>
    <p>Sats - LSats</p>
</section>
<section>
    <form>
        <fieldset><legend>To sign</legend>
            <input type="integer" name="xxxxxx[amount]" readonly> LSat following <select name="xxxxxx[template]"> readonly</select> to <input type="text" name="xxxxxx[address]" value="address to" readonly> sign with <input type="text" name="xxxxxx[value]"> <input type="submit" name="xxxxxx[sign]" value="Sign"><br>
            <input type="integer" name="yyyyyy[amount]" readonly> LSat following <select name="yyyyyy[template]" readonly></select> to <input type="text" name="yyyyyy[address]" value="address to" readonly> sign with <input type="text" name="yyyyyy[value]"> <input type="submit" name="yyyyyy[sign]" value="Sign"><br>
        </fieldset>
        <fieldset><legend>To complete</legend>
            <input type="integer" name="xxxxxx[amount]" readonly> LSat following <select name="xxxxxx[template]"> readonly</select><br>
            <input type="text" name="xxxxxx[address]" value="address to" readonly> sign with <input type="text" name="xxxxxx[value]" readonly><br>
            <input type="text" name="xxxxxx[address]" value="address to" readonly> sign with <input type="text" name="xxxxxx[value]" readonly><br>
            to sign <input type="text" name="xxxxxx[address]" value="address to" readonly><br>
            to sign <input type="text" name="xxxxxx[address]" value="address to" readonly>
            <br>
            <input type="integer" name="xxxxxx[amount]" readonly> LSat following <select name="xxxxxx[template]"> readonly</select><br>
            <input type="text" name="xxxxxx[address]" value="address to" readonly> signed with <input type="text" name="xxxxxx[value]" readonly><br>
            <input type="text" name="xxxxxx[address]" value="address to" readonly> signed with <input type="text" name="xxxxxx[value]" readonly><br>
            to sign <input type="text" name="xxxxxx[address]" value="address to" readonly><br>
            to sign <input type="text" name="xxxxxx[address]" value="address to" readonly>
        </fieldset>
        <fieldset><legend>Send</legend>
            <input type="integer" name="to[amount]"> LSat with <select name="to[utxo]" multiple></select> following <select name="to[template]"></select> to <input type="text" name="to[address]" value="address to"> for
            <input type="checkbox" name="mine[state]"> propose (min 5 000 LSats) <input type="integer" name="mine[amount]" min="5000" value="5000"> LSats with <select name="mine[utxo]" multiple></select> following <select name="mine[template]"></select> to <select name="mine[address]" multiple></select> for mine (each)<br>
            <input type="checkbox" name="pegIn[state]"> propose (min 5 000 LSats) <input type="integer" name="pegIn[amount]" min="5000" value="5000"> Sats with <select name="pegIn[utxo]" multiple></select> following <select name="pegIn[template]"></select> to <select name="pegIn[address]" multiple></select> for peg in (each)<br>
            <input type="checkbox" name="pegOut[state]"> propose (min 10 000 LSats) <input type="integer" name="pegOut[amount]" min="10000" value="10000"> Sats with <select name="pegOut[utxo]" multiple></select> following <select name="pegOut[template]"></select> to <select name="pegOut[address]" multiple></select> for for peg out (each)<br>
            <input type="checkbox" name="share[state]"> propose (min 10 000 LSats) <input type="integer" name="share[amount]" min="10000" value="100000"> LSats with <select name="share[utxo]" multiple></select> following <select name="share[template]"></select> to <select name="share[address]" multiple></select> for share <input type="file" name="tempalte">  (each)<br>
            <input type="checkbox" name="backup[state]"> propose (min 1 000 LSats) <input type="integer" name="backup[amount]" min="1000" value="1000"> LSats with <select name="backup[utxo]" multiple></select> following <select name="backup[template]"></select> to <select name="backup[address]" multiple></select> for backup (each)<br>
            <input type="checkbox" name="lock[state]"> propose (min 10 000 LSats) <input type="integer" name="lock[amount]" min="10000" value="10000"> LSats with <select name="lock[utxo]" multiple></select> following <select name="lock[template]"></select> to <select name="lock[address]" multiple></select> for lock (each)<br>
            <input type="checkbox" name="witness[state]"> propose (min 10 LSats) <input type="integer" name="witness[amount]" min="10" value="10"> LSats with <select name="witness[utxo]" multiple></select> following <select name="witness[template]"></select> to <select name="witness[address]" multiple></select> for witness (each)<br>
            <input type="checkbox" name="node[state]"> propose (min 10 LSats) <input type="integer" name="node[amount]" min="10" value="10"> LSats with <select name="node[utxo]" multiple></select> following <select name="node[template]"></select> to <select name="node[address]" multiple></select> for processing (each nodes)<br>
            <br>
            <p>By the way:</p>
            <input type="checkbox" name="proposal_template[state]"> propose (min 10 LSats) <input type="integer" name="proposal_template[amount]" min="10" value="10"> LSats with <select name="proposal_template[utxo]" multiple></select> following <select name="proposal_template[template]"></select> for add <select name="proposal_template[proposal]"></select> template<br>
            <input type="checkbox" name="proposal_share[state]"> propose (min 10 000 LSats) <input type="integer" name="proposal_share[amount]" min="10000" value="10000"> LSats with <select name="proposal_share[utxo]" multiple></select> following <select name="proposal_share[template]"></select> for add <select name="proposal_share[proposal]"></select> node for sharing<br>
            <input type="checkbox" name="proposal_backup[state]"> propose (min 1 000 LSats) <input type="integer" name="proposal_backup[amount]" min="1000" value="1000"> LSats with <select name="proposal_backup[utxo]" multiple></select> following <select name="proposal_backup[template]"></select> for add <select name="proposal_backup[proposal]"></select> address for backup<br>
            <input type="checkbox" name="proposal_lock[state]"> propose (min 10 000 LSats) <input type="integer" name="proposal_lock[amount]" min="10000" value="10000"> LSats with <select name="proposal_lock[utxo]" multiple></select> following <select name="proposal_lock[template]"></select> for add <select name="proposal_lock[proposal]"></select> address for lock<br>
            <input type="checkbox" name="proposal_witness[state]"> propose (min 10 LSats) <input type="integer" name="proposal_witness[amount]" min="10" value="10"> LSats with <select name="proposal_witness[utxo]" multiple></select> following <select name="proposal_witness[template]"></select> for add <select name="proposal_witness[proposal]"></select> address for witness<br>
            <input type="checkbox" name="proposal_node[state]"> propose (min 10 LSats) <input type="integer" name="proposal_node[amount]" min="10" value="10"> LSats with <select name="proposal_node[utxo]" multiple></select> following <select name="proposal_node[template]"></select> for add <select name="proposal_node[proposal]"></select> node for processing<br>
            <input type="checkbox" name="proposal_convertSAT[state]"> propose (min 10 000 Sats) <input type="integer" name="proposal_convertSAT[amount]" min="10000" value="10000"> Sats with <select name="proposal_convertSAT[utxo]" multiple></select> following <select name="proposal_convertSAT[template]"></select> for add <select name="proposal_convertSAT[proposal]"></select> address for converting to SAT<br>
            <input type="checkbox" name="proposal_convertLSAT[state]"> propose (min 10 000 Sats) <input type="integer" name="proposal_convertLSAT[amount]" min="10000" value="10000"> Sats with <select name="proposal_convertLSAT[utxo]" multiple></select> following <select name="proposal_convertLSAT[template]"></select> for add <select name="proposal_convertLSAT[proposal]"></select> address for converting to LSAT<br>
            <p></p>
            <input type="submit" name="transaction" value="Send"><br>
        </fieldset>
        <fieldset><legend>Convert</legend>
            <input type="integer" name="convertSat[amount]"> Sats with <select name="convertSat[utxo]" multiple></select> following <select name="convertSat[template]"></select> to <select name="convertSat[address]" multiple></select> for convert into LSAT (each)<br>
            <input type="integer" name="convertLSat[amount]"> LSats with <select name="convertLSAT[utxo]" multiple></select> following <select name="convertLSat[template]"></select> to <select name="convertLSAT[address]" multiple></select> for convert into SAT (each)<br>
            <input type="submit" name="conversion" value="Send"><br>
        </fieldset>
        <fieldset><legend>Upgrade</legend>
            Pay to mine: <input type="integer" name="payToMine[amount]" value="100000" min="100000" max="100000" readonly> Sats with <select name="payToMine[utxo]" multiple></select> following <select name="payToMine[template]"></select> to <select name="payToMine[address]" multiple></select> for be able to mine (each)<br>
            Pay to pegOut: <input type="integer" name="payToPegOut[amount]" value="100000" min="1000000" max="100000" readonly> Sats with <select name="payToPegOut[utxo]" multiple></select> following <select name="payToPegOut[template]"></select> to <select name="payToPegOut[address]" multiple></select> for be able to pegOut (each)<br>
            <input type="submit" name="conversion" value="Send"><br>
        </fieldset>
    </form>
</section>
<section>
<?php echo $b_block = infoTypeHTml('b', 'block'); ?>
<?php echo $b_peg = infoTypeHTml('b', 'peg'); ?>
<?php echo $b_main = infoTypeHTml('b', 'main'); ?>
<?php echo $b_node = infoTypeHTml('b', 'node'); ?>
<?php echo $block = infoTypeHTml('e', 'block'); ?>
<?php echo $peg = infoTypeHTml('e', 'peg'); ?>
<?php echo $main = infoTypeHTml('e', 'main'); ?>
<?php echo $node = infoTypeHTml('e', 'node'); ?>
<?php echo $lock = infoTypeHTml('e', 'lock'); ?>
<?php echo $backup = infoTypeHTml('e', 'backup'); ?>
<?php echo $witness = infoTypeHTml('e', 'witness'); ?>
<?php echo $share = infoTypeHTml('e', 'share'); ?>
<?php echo $convert = infoTypeHTml('e', 'convert'); ?>
<?php echo $share = infoTypeHTml('e', 'share'); ?>
<?php echo $post = infoTypeHTml('e', 'post'); ?>
<?php echo $get = infoTypeHTml('e', 'get'); ?>
</section>
</body>
</html>

