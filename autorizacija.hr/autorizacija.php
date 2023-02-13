<?php

if($_POST['email']==='edunova@edunova.hr' && 
    $_POST['lozinka']==='edunova'){
        session_start();
        $_SESSION['auth']=true;
        setcookie('email',$_POST['email']);
        header('location: zasticeno.php');

    }else{
        header('location: index.php?email=' . $_POST['email']);
    }

