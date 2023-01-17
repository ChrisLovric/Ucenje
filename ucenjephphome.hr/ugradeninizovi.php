<?php

echo '<pre>';
print_r($_GET);
echo '</pre>';

echo '<pre>';
print_r($_POST);
echo '</pre>';

echo '<pre>';
print_r($_REQUEST);
echo '</pre>';

echo '<pre>';
print_r($_FILES);
echo '</pre>';

echo '<pre>';
print_r($_SERVER);
echo '</pre>';

echo $_SERVER['HTTP_HOST'],'<hr />';

session_start();
$_SESSION['skola']='Edunova';
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

echo '<pre>';
print_r($_COOKIE);
echo '</pre>';