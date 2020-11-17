<?php
function validate_mobile($mobile)
{
    return preg_match('/^[6-9]\d{9}$/', $mobile);
}

$mob = $_GET['mobile'];
$msg = urlencode($_GET['message']);

if (strlen($mob) == '10' && validate_mobile($mob)) {
$ch = curl_init( ); 
curl_setopt($ch, CURLOPT_URL, "http://mobicomm.dove-sms.com//submitsms.jsp?user=Justlook&key=4cd19c6053XX&mobile=$mob&message=$msg&senderid=DALERTr&accusage=1"); 
curl_setopt($ch, CURLOPT_POST, false); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 
$json1 = json_decode($output,true);
curl_close($ch);
//echo $output;
$mas = urldecode($msg);
$message = "An SMS Has Been Sent Successfullt To $mob With The Message $mas";

$array = array("status"=>"1","error"=>"false","message"=>"$message","Note"=>"Join Telegram Channel");

$json = json_encode($array,true);

echo $json;
}
else{
	$array = array("status"=>"0","error"=>"true","message"=>"There Is A Problem In The Mobile Number","Note"=>"Join Telegram Channel");

	$json = json_encode($array,true);

echo $json;
}