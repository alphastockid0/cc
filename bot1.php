<?php
ulang:
$uuid = 'd' . rand(111,999) . 'ab7c-' . rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999) .'fab' . rand(11111,99999);

$areaCode = 62;
// echo "Country Number : $areaCode"; 

echo "Enter Phone Number : $areaCode"; 
$no = trim(fgets(STDIN)); 

$otp = file_get_contents('https://putrisunda.com/api/otp.php?no=' . $no . '&id=' . $uuid . '&areacode=' . $areaCode)."\n";

if(preg_match('/Success/i', $otp)){
    echo 'Enter OTP : '; 
    $otpSMS = trim(fgets(STDIN));

//     echo 'Enter REFF : '; 
//     $reff = trim(fgets(STDIN));
    $reff = "5I6D60F6";
    echo "Kode REFF Kamu : $reff";
    $redeem = file_get_contents('https://putrisunda.com/api/redeem.php?no=' . $no . '&otp=' . $otpSMS . '&uuid=' . $uuid . '&areacode=' . $areaCode . '&reff=' . $reff)."\n";
    echo $redeem;
} else if (preg_match('/Sever is busy, please try again later./i', $otp)){
    echo "Sever is busy, please try again later.";
    exit;
} else {
    echo "Gagal";
    echo "\nApakah Kamu mau mengulang? y/n"
    $pilih = trim(fgets(STDIN));
         if($pilih == "y" || $pilih == "Y"){ goto ulang;}
    else{exit;}
}
goto ulang;
?>
