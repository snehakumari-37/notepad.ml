<?php
    require "../security.php";
    if(isset($_POST['msg'])){
        $msg = $_POST['msg'];
        echo "<h1 style='color:red;'>$msg</h1>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE MANAGER</title>
</head>

<body>
    <div>

    <form action="create.php" method="POST">
            <span style="font-size: 32.5px;font-style: italic;font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;letter-spacing: 3px; display:inline-block;">FILE NAME :</span>
            <input onclick="select();" id="input" style="width:80%;display: inline-block;" type="text" name="filename" value="( ENTER FILENAME )" autofocus>
            <input style="width:99%;display: inline-block; background-color: purple;" type="submit" value="CREATE FILE">
    </form>
    
    <form action="open.php" method="POST">
<?php
    $path = '../saved/';
    $files = glob($path."*.txt");
    $msg = 'SELECT FILES TO OPEN :';
    if(count($files)==0){
        $msg = 'NO EXISTING FILES TO OPEN (PLEASE <SPAN style="color:blue;">CREATE</SPAN> A FILE)';
    }
    echo '<h1 style="color: crimson;">'.$msg.'</h1>';
    echo '<form action="open.php" method="POST">';
    foreach ($files as $file) {
      $pure =str_replace(".txt","",str_replace($path,"",$file));
      echo '<input name="filename" type="submit" value="'. $pure .'"></input>

      <input hidden  id="del'.$pure.'" style="background-color: red;"type="submit" name="delete" value="'. $pure .'"></input>
      <label style="background-color:red; font-weight: bold; font-style: italic; width: 48.5%;color: white;padding: 14px 20px;margin: 8px 0;border: none;border-radius: 4px; cursor: pointer;" 
      for="del'. $pure.'" >DELETE</label>
      <br>';
    }
    echo "</form>";
?>
    </form>
    </div>
    <script>
        document.querySelector('#input').select();
    </script>
</body>

</html>