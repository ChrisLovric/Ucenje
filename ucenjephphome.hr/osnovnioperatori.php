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

            echo 'prvo ' . 'drugo', '<hr>';

            /*
            9 : 2 = 4
            8
            1 <- ovo je modulo
            9%2=1
            */

            echo 9%2, '<hr>';

            echo 9 / 2, '<hr>';

            



          ?>



          </div> 
        </div>
        <?php include_once 'podnozje.php'; ?>
      </div>
    </div>
    <?php include_once 'skripte.php'; ?>
  </body>
</html>
