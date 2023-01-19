<?php
$gradovi=['Valpovo','Osijek','Zagreb','Donji Miholjac'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $pb=(int)$_POST['pb'];
    $db=(int)$_POST['db'];
    if($pb===0){
        $pb='';
    }
    if($db===0){
        $db='';
    }
    if($pb!==''  && $db!==''){
        $rez=$pb + $db;
    }else{
        $rez='';
    }

    if(isset($_POST['voce'])){
        $voce=$_POST['voce'];
    }else{
        $voce='';
    }

    if(isset($_POST['povrce'])){
        $povrce=$_POST['povrce'];
    }else{
      $povrce=[];
    }
    
$grad=$_POST['grad'];

$opis=$_POST['opis'];

$datum=$_POST['datum'];

}else{
    $pb='';
    $db='';
    $rez='';
    $voce='';
    $povrce=[];
    $grad=$gradovi[0];
    $opis='';
    $datum=date('Y-m-d',time());
}




?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once 'head.php'; ?>
  </head>
<body>
    <div class="grid-container">
      <?php require_once 'izbornik.php'; ?>
      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <div class="callout" id="tijelo">
          
          
            <form action="<?=$_SERVER['PHP_SELF']?>"
            method="post"
            enxctype="multipart/form-data">
        
            <label> Prvi broj
                <input type="text" name="pb" value="<?=$pb?>">
            </label>


            <label for="db">Drugi broj</label>
            <input type="text" name="db" id="db" value="<?=$db?>">
            <h1><?=$rez?></h1>


            <input type="radio" name="voce" <?php if($voce==='jabuka'):?>
                checked="checked"
                <?php endif;?>
                id="jabuka" value="jabuka">
            <label for="jabuka">Jabuka</label>

            <br>

            <input type="radio" name="voce" <?php if($voce==='kruska'):?>
                checked="checked"
                <?php endif;?>
                id="kruska" value="kruska">
            <label for="kruska">Kruška</label>

            <br>
            <?=$voce?>

            <hr>

            <input type="checkbox" name="povrce[]"
            <?php if(in_array('kupus',$povrce)):?>
              checked="checked"
              <?php endif;?>
              id="kupus" value="kupus">
            <label for="kupus">Kupus</label>

            <input type="checkbox" name="povrce[]"
            <?php if(in_array('mrkva',$povrce)):?>
              checked="checked"
              <?php endif;?>
              id="mrkva" value="mrkva">
            <label for="mrkva">Mrkva</label>

            <hr>

            <label for="grad">Grad</label>
            <select name="grad" id="grad">
                <?php foreach($gradovi as $g): ?>
                    <option
                    <?php if($grad===$g):?>
                      selected="selected"
                      <?php endif;?>
                      value="<?=$g?>"><?=$g?></option>
                    <?php endforeach; ?>
            </select>

            <label for="opis">Opis</label>
            <textarea name="opis" id="opis"
            cols="30" rows="10"><?=$opis?></textarea>

            <label for="slika1">Slika1</label>
            <input type="file" name="slika1" id="slika1">

            <br>

            <label for="slika2">Slika2</label>
            <input type="file" name="slika2" id="slika2">

            <label for="datum">Datum</label>
            <input type="date" name="datum" id="datum"
            value="<?=$datum?>">

            <input class="success button expanded" type="submit" value="Izračunaj">

            </form>
        


          </div> 
        </div>
        <?php include_once 'podnozje.php'; ?>
      </div>
    </div>
    <?php include_once 'skripte.php'; ?>
  </body>
</html>
