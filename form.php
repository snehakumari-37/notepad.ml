<?php
require "security.php";
$text = $_POST['text'];
if(!isset($_POST['filename'])){
    die("no filename");
}
$filename = $_POST['filename'];

$dir = "saved";
if(!is_dir($dir)){
    mkdir($dir);
}
if(!file_exists($filename)){
    $edit = fopen($filename,"w");
    $empty_mgs = "THIS IS ONLINE NOTEPAD!";
    fwrite($edit,$empty_mgs);
    fclose($edit);
}
$open = fopen($filename,'w');
fwrite($open, $text);

if(empty($text)){
    $empty_mgs = "THIS IS ONLINE NOTEPAD!";
    fwrite($open, $empty_mgs);
}

$location = "../";
$func = $_POST['func'];
if($func=="save"){
$location = "../";
}
elseif($func=="manage"){
    $location ="manage/";
}
header("Location: ".$location);

// $dir = 'saved/';
// $main = "../"; // index.php
// $name = "openfile";
// echo '
// <HEAD>
//     <form id="form" action="'.$main.'" method="POST">
//     <input HIDDEN name="'.$name.'" type="text" value="'. $dir.$filename .'">
//     </form>
//     <script>
//     document.querySelector("#form").submit();
//     </script>
// </HEAD>
// ';
?>
<h1>PROCESSING YOUR REQUEST</h1>