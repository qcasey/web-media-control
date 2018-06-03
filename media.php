<?php
// Controller for BT media
error_reporting(E_ALL);
ini_set('display_errors', 1);

$output = array();
exec("dbus-send --system --print-reply --type=method_call --dest=org.bluez /org/bluez/hci0/dev_4C_32_75_AD_98_24/player0 org.freedesktop.DBus.Properties.Get string:org.bluez.MediaPlayer1 string:Track", $output);
print_r($output);
$real_output = array();

$onKey = True;
foreach($output as $key => $item) {

    // Only get keys, skip values of this weird array
    if($onKey) {
        if (preg_match('/\"(.*?)\"/', $item, $m)) {

            // Get the value if we've matched a key
            preg_match('/\"(.*?)\"/', $output[$key+1], $m2) || preg_match('/variant uint32 (.*?)\/', $output[$key+1], $m);
            //print $m[1];
            //$item_parse = explode($item, " ");
            $real_output[$m[1]] = $m2;
        }
    } else {
        $onKey = True;
    }
}

print_r($real_output);

?>