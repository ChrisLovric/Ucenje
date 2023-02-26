<?php

require_once 'funkcija.php';

$errorporuka='';

if($_POST){
    $ime1=$_POST['prvoime'];
    $ime2=$_POST['drugoime'];
    if($ime1==='' && $ime2===''){
        $errorporuka='OBAVEZAN UNOS OBA IMENA!';
    }else if($ime1==='' && $ime2!==''){
        $errorporuka='OBAVEZAN UNOS OBA IMENA!';
    }else if($ime1!=='' && $ime2===''){
        $errorporuka='OBAVEZAN UNOS OBA IMENA!';
    }else{
    $ukupno=Zbroj($ime1,$ime2);
    $postotak=Postotak($ukupno);
    $postotak=$postotak . '%';
    }
}else{
    $ime1='';
    $ime2='';
    $errorporuka='';
}



?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <?php include_once 'head.php'; ?>
</head>
<body>

<div class="grid-container">
<div class="grid-x grid-padding-x">
    <div class="large-12 medium-6 small-6 cell">
        <div class="row text-center">
          <h1>Ljubavni kalkulator</h1>
        </div>

      <div class="container">
        <div class="row text-center">
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
    <h3><?=$errorporuka?></h3>
</div>
</div>
</div>
</div>
</div>

<?php include_once 'podnozje.php'; ?>

<?php include_once 'skripte.php'; ?>
</body>
</html>