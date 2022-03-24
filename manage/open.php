<?php   
 require "../security.php";
 $die1 ="<form action='../manage/' method='POST' id='form' hidden><input type='text' name='msg' value ='";
 $die2 = "'></form><script>document.querySelector('#form').submit();</script>";


if(isset($_POST['filename'])){
 $filename = $_POST["filename"];
 $filename =  $filename.".txt";
 fwrite(fopen('../opened.txt','w'),"saved/$filename");
 header("Location: ../");
}
elseif(isset($_POST['delete'])){
    $filename = $_POST['delete'];

    unlink("../saved/$filename.txt");
    $r = fopen("../opened.txt",'w');
    fwrite($r,'');
    fclose($r);
  

    $msg = 'DELETED FILE : ( <span style="color: blue;">'.$filename.'</span> )';
    die("$die1$msg$die2");
}
else{
    $msg = "PLEASE CHOOSE A FILE TO OPEN";
    die("$die1$msg$die2");
}
?>