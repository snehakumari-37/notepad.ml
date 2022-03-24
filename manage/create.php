<?php
require "../security.php";
$die1 ="<form action='../manage/' method='POST' id='form' hidden><input type='text' name='msg' value ='";
$die2 = "'></form><script>document.querySelector('#form').submit();</script>";


if(!isset($_POST['filename'])){
    $msg = "FILENAME IS REQUIRED";
    die("$die1$msg$die2");
}

if(empty($_POST['filename']) || $_POST['filename']=="( ENTER FILENAME )"){
    $msg = "FILENAME IS REQUIRED <br> EMPTY!";
    die("$die1$msg$die2");
}

$forbidden = array('/','\\',':','*','?','<','>','|');
$filename = $_POST['filename'];

foreach($forbidden as $no){
    $filename = str_replace($no,'',$filename);
}

if(empty($filename)){
    die("$die1".'SORRY YOU CANNOT MAKE A FILE WITH FORBIDDEN CHAR <span style="color:blue" >/ \\ : * ? < > |</span>'."$die2");
}

$filename = $filename.".txt";

$dir = "../saved/";
if(!is_dir($dir)){
    mkdir($dir);
}

if(file_exists("$dir$filename")){
    $msg = 'FILENAME ALREADY EXISTS (<span style="color:blue;">'.str_replace('.txt','',$filename)."</span>)";
    die("$die1$msg$die2");

}

$file = fopen("$dir$filename", 'w');
$empty_text = "THIS IS ONLINE NOTEPAD!";
fwrite($file, $empty_text);
fclose($file);

$msg = 'CREATED FILE : ( <span style="color:blue;">'.str_replace('.txt','',$filename)."</span> )";
die("$die1$msg$die2");
?>