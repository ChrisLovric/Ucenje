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
          
          <?php
          
        try{
            
            $dsn='mysql:host=localhost;dbname=edunovapp266;charset=utf8';

            $parametri=[
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];

            $veza=new PDO($dsn,'root','',$parametri);
  
            $izraz=$veza->prepare('select * from smjer');
  
            $izraz->execute();
  
            $rs=$izraz->fetchAll();
  
          foreach($rs as $red): 
              ?>
              <h1><?=$red->naziv ?>, <?=$red->trajanje ?></h1>
              <?php
          endforeach;

        }catch(Exception $e){
            switch($e->getCode()){
                case 1049:
                    echo 'Provjerite naziv baze podataka';
                    break;
                case 2002:
                    echo 'Provjerite naziv računala ili domene gdje se nalazi baza';
                    break;
                    default:
                    echo 'Dogodio se problem. Kontaktirajte nas na XXXXXX';
                    break;
            }
            //echo '<pre>';
            //print_r($e);
            //echo '</pre>';
        }


          
          ?>






          </div> 
        </div>
        <?php include_once 'podnozje.php'; ?>
      </div>
    </div>
    <?php include_once 'skripte.php'; ?>
  </body>
</html>