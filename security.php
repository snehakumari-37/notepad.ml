<?php
//whether ip is from share internet
function ip(){
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
return $ip_address;
}
$ip = ip();
$allow = false;

$wifi = "103.164.46.160";
$appi = "106.202.71.215";
$maa = "47.32.170.137";

$good = array($wifi, $appi, $maa); // ::1 in LOCALHOST
foreach($good as $i){ 
    if($i == $ip){
        $allow = true;
    }
}
if(!$allow){
die("<h1>403 : FORBIDDEN</h1> $ip");
}
?>
