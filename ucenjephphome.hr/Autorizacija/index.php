<?php

$email=isset($_GET['email']) ? $_GET['email'] : (isset($_COOKIE['email']) ? $_COOKIE['email'] : '');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorizacija</title>
</head>
<body>
    Registriraj se
    <form action="autorizacija.php" method="post">
        <input type="text" name="email" value="<?=$email?>" placeholder="email" id="">
        <input type="password" name="lozinka" id="">
        <input type="submit" value="Registriraj se">
    </form>
</body>
</html>