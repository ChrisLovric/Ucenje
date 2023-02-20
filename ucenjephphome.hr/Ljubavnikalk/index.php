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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ljubavni Kalkulator</title>
</head>
<body>
    <h1>Ljubavni kalkulator</h1>
    
<div>
    <form action="index.php" method="post">
        <label for="prvoime">Unesi prvo ime:</label><br>
        <input type="text" name="prvoime" value="<?=$ime1?>" placeholder="prvo ime" id="prvoime"><br><br>
        <label for="drugoime">Unesi drugo ime:</label><br>
        <input type="text" name="drugoime" value="<?=$ime2?>" placeholder="drugo ime" ide="drugoime"><br><br><br>
        <input type="submit" value="Izračunaj postotak zaljubljenosti">
    </form><br>
    <h1>
        <?php
        if(isset($postotak)){
            echo $postotak;
        }
        ?>
    </h1>
</div>
</body>
</html>