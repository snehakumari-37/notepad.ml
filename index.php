<?php
require "security.php"; //GETS THE IP OF USER AND CHECKS IT WITH (WHITE-LIST)

$die1 ="<form action='manage/' method='POST' id='form' hidden><input type='text' name='msg' value ='";
$die2 = "'></form><script>document.querySelector('#form').submit();</script>";
$msg = 'PLEASE OPEN OR CREATE A FILE BEFORE OPENING <SPAN style="color: blue;">"NOTEPAD"<SPAN>';
$name_opened_txt ="opened.txt";
if(!file_exists($name_opened_txt)){
    $opened = fopen($name_opened_txt,"w");
    fwrite($opened,'');
    fclose($opened);
    die("$die1$msg$die2");
}
if(filesize($name_opened_txt)==0){
    die("$die1$msg$die2");
}




$read_opened_txt = fopen("opened.txt","r");

$p = fread($read_opened_txt,filesize($name_opened_txt));
fclose($read_opened_txt);

$openedName = "opened.txt";
$opened = fopen($openedName, "r");  
$opened_txt = fread($opened, filesize($openedName));

if(!file_exists($opened_txt)){
    die("$die1$msg$die2");
}
    $txtFileName = $opened_txt; // OPEN DEFAULT PATH
    $purefilename = str_replace("saved/","",$txtFileName);
    $purefilename = str_replace('.txt','',$purefilename);

$dir = "saved/";
if(!is_dir($dir)){  //   IF "saved/" path doesnt exist 
    mkdir($dir);    //   MAKE A NEW "saved/" DIR
}

$txtFile = fopen($txtFileName,"r"); // OPEN "saved/fileName.txt" FOR READING
$text = fread( $txtFile, filesize($txtFileName) ); 
fclose($txtFile);

echo 'OPENED : ( <l style="color:blue;"> '.$purefilename.'</l> )';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="fileSaver.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" user-scalable="no">
    <title>Saved Notes</title>
</head>

<body>
    <?php 
echo  "<span hidden>". $txtFileName ."</span>"; // PASS VAR $txtFileName TO JAVASCRIPT
?>

        <form action="form.php" method="POST">

        <textarea name="text" id="text" cols="999" rows="999"><?php echo $text;?></textarea>
            <td>
                <tr>
                    <button name="func" type="submit" value="save">SAVE</button>
                </tr>
                <input type="hidden" name="filename" value="<?php echo $opened_txt; ?>"></input>
                <tr>
                    <button style="background-color:cadetblue;" type="submit" name="func" value="save" onclick="savu()">DOWNLOAD (.txt)</button>
                </tr>

            <td>
                <tr>
                    <button style="background-color: purple; width:98%;" type="submit" name="func" value="manage">MANAGE/ (OPEN) FILES</button>
                </tr>
            </td>
        </form>

    </div>
    <script>
        const textArea = document.querySelector("textarea");
        function savu() {
            var blob = new Blob([textArea.value], { type: "text/plain;charset=utf-8;", endings: "native" });
            saveAs(blob, filename);
        }

        var getFileName = document.querySelector("span");
        var filename = getFileName.innerText;
        getFileName.remove();
        var splitLength = filename.split("/").length - 1;
        filename = filename.split("/")[splitLength];

        const font_size = 5; // in %
        const submit_button_height = 150;
        var availHeight = window.innerHeight - submit_button_height;

        textArea.style.height = (availHeight) + "px";
        textArea.style.fontSize = ((window.innerHeight * font_size) / 100) + "px";
    </script>
</body>

</html>