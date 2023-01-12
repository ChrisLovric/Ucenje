<?php

$b1=isset($_GET['b1']) ? $_GET['b1'] : 0;
$b2=isset($_GET['b2']) ? $_GET['b2'] : 0;
$b3=isset($_GET['b3']) ? $_GET['b3'] : 0;
if($b1===$b2 && $b2===$b3){
    echo 'Jednaki su';
}else if($b1<=$b2 && $b1<=$b3){
    echo $b1;
}else if($b2<=$b1 && $b2<=$b3){
    echo $b2;
}else if($b3<=$b1 && $b3<=$b2){
    echo $b3;
}