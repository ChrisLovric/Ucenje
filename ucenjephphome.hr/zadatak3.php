<?php

$b1 = isset($_GET['b1']) ? $_GET['b1'] : 0;
$b2 = isset($_GET['b2']) ? $_GET['b2'] : 0;
if($b1===$b2){
  echo 'Jednaki su';
}else if($b1>$b2){
  echo$b1;
}else{
    echo$b2;
  }