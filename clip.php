<?php
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

function color($color = "default" , $text) {
  $arrayColor = array(
    'grey'      => '1;30',
    'red'       => '1;31',
    'green'     => '1;32',
    'yellow'    => '1;33',
    'blue'      => '1;34',
    'purple'    => '1;35',
    'nevy'      => '1;36',
    'white'     => '1;0',
  );
  return "\033[".$arrayColor[$color]."m".$text."\033[0m";
}

awal:
$uuid = gen_uuid();
// echo 'Input Country Code (Ex: 1 / 62) : ';
$areaCode = "62";
// echo "Input Phone Number Tanpa 1 diawal\n";
echo "Input Phone Number : ";
$no = trim(fgets(STDIN));
$otp = file_get_contents('https://faridfac.herokuapp.com/clipclaps/otp.php?no='.$no.'&id='.$uuid.'&areacode='.$areaCode);
if(preg_match('/Success/i', $otp)){
    echo 'Input OTP Code : ';
    $otpSMS = trim(fgets(STDIN));
   
    $reff ="5I6D60F6"; 
    echo "Input Refferal Code : $reff";
    $redeem = file_get_contents('https://faridfac.herokuapp.com/clipclaps/redeem.php?no='.$no.'&otp='.$otpSMS.'&uuid='.$uuid.'&areacode='.$areaCode.'&reff='.$reff);
    echo color($color = "green" , "$redeem \n");
    goto awal;
} else {
    echo color($color = "red" , "$otp\n");
    exit;
}


?>
