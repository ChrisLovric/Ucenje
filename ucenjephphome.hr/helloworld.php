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
          
            echo 'Hello world<br>', PHP_EOL;
            echo "Edunova\n";

            echo '<p>' . 3 . '</p>';

            print '<p>Osijek</p>';

            echo '<p>O\'Neal</p>';

            echo '<p style="color: red;">X</p>'
          
          
          ?>
          </div> 
        </div>
        <?php include_once 'podnozje.php'; ?>
      </div>
    </div>
    <?php include_once 'skripte.php'; ?>
  </body>
</html>
