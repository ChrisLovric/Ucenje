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
        $povrce=$_POST['povrce']}{
    


}else{
    $pb='';
    $db='';
    $rez='';
    $voce='';
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
            method="post">
        
            <label> Prvi broj
                <input type="text" name="pb">
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

            <input type="radio" name="voce" <?php if($voce==='jabuka'):?>
                checked="checked"
                <?php endif;?>
                id="kruska" value="kruska">
            <label for="kruska">Kruška</label>

            <br>
            <?=$voce?>

            <hr>

            <input type="checkbox" name="povrce[]" id="kupus" value="kupus">
            <label for="kupus">Kupus</label>

            <input type="checkbox" name="povrce[]" id="mrkva" value="mrkva">
            <label for="mrkva">Mrkva</label>

            <hr>

            <label for="grad">Grad</label>
            <select name="grad" id="grad">
                <?php foreach($gradovi as $g): ?>
                    <option value="<?"></option>
                    <?php endforeach; ?>
            </select>

            <input class="success button expanded" type="submit" value="Izraćunaj">

            </form>
        


          </div> 
        </div>
        <?php include_once 'podnozje.php'; ?>
      </div>
    </div>
    <?php include_once 'skripte.php'; ?>
  </body>
</html>
