<?php

require_once 'ciklicna.php';

?>


<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once 'head.php'; ?>
  </head>
<body>

    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <div class="row text-center">
          <h1>Ciklična tablica</h1><br>
            </div>
        </div>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <div class="row text-center">
          <div id="unos">Unesite broj redaka i stupaca</div><br>
    <div>
        <form action="" method="POST">
        <label for="rows">Broj redaka</label><br>
        <input type="number" name="rows" value="<?=$rows?>" id="rows"><br><br>
        <label for="columns">Broj stupaca</label><br>
        <input type="number" name="columns" value="<?=$columns?>" id="columns"><br><br>
        <input type="submit" value="KREIRAJ TABLICU" id="kreiraj">
        </form><br>
    </div>

<table id="tab">
<?php
    for($i=0;$i<$rows;$i++){
        echo '<tr>';
        for($j=0;$j<$columns;$j++){
            echo '<td>' . $ciklicna[$i][$j] . '</td>';
        }
        echo '</tr>';
    }
?>
</table>

<h3><?=$errorporuka?></h3>

          </div>
        </div>
      </div>
    </div>

    <?php include_once 'podnozje.php'; ?>

    <?php include_once 'skripte.php'; ?>
  </body>
</html>