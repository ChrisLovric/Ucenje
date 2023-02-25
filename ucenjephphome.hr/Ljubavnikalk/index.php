<?php

require_once 'funkcija.php';

if($_POST){
    $ime1=$_POST['prvoime'];
    $ime2=$_POST['drugoime'];
    if($ime1==='' && $ime2===''){
        echo "OBAVEZAN UNOS OBA IMENA!";
    }elseif($ime1==='' && $ime2!==''){
        echo "OBAVEZAN UNOS OBA IMENA!";
    }elseif($ime1!=='' && $ime2===''){
        echo "OBAVEZAN UNOS OBA IMENA!";
    }else{
    $ukupno=Zbroj($ime1,$ime2);
    $postotak=Postotak($ukupno);
    $postotak=$postotak . '%';
    }
}else{
    $ime1='';
    $ime2='';
}



?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ljubavni Kalkulator</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

<div class="grid-container">
<div class="grid-x grid-padding-x">
    <div class="large-12 medium-8 small-6 cell">
        <div class="row text-center">
          <h1>Ljubavni kalkulator</h1>
        </div>
    
      <div class="container">
        <div class="row text-center">
          <div class="large-8 cell">
    <form action="index.php" method="post">
        <label for="prvoime">Unesi prvo ime:</label><br>
        <input type="text" name="prvoime" value="<?=$ime1?>" placeholder="prvo ime" id="prvoime"><br><br>
        <label for="drugoime">Unesi drugo ime:</label><br>
        <input type="text" name="drugoime" value="<?=$ime2?>" placeholder="drugo ime" id="drugoime"><br><br><br>
        <input type="submit" value="Izračunaj postotak zaljubljenosti" id="postotak">
    </form><br>
    <h2>
        <?php
        if(isset($postotak)){
            echo $postotak;
        }
        ?>
    </h2>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>