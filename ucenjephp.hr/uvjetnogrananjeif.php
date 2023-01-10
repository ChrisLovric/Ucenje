<?php

$uvjet=true;

if($uvjet){
    echo '1', '<br />';
}

if($uvjet)
    echo '2', '<br>';
    echo '3', '<br>';

if($uvjet){
        echo '4', '<br>';
    }else{
        echo  '5', '<br>';
    }

$i=10;
if($i>0){
    echo '6', '<br>';
}

$uvjet = $i>0;
if($uvjet){
    echo '7', '<br>';
}

$i=2; $j=4;

if($i===2 & $j===4){
    echo '8', '<br>';
}

$i=3;

if($i===2 && $j===4){
    echo '9', '<br>';
}

$i=2; $j=1;

if($i>0 | $j<2){
    echo '10', '<br>';
}

$i=2; $j=1;

if($i>0 || $j<2){
    echo '11', '<br>';
}

if(!($i>4 && $j>0)){
    echo '12', '<br>';
}

if($i>0){
    if($j>0){
        echo '13', '<br>';
    }
}

if($i===1){
    echo '14', '<br>';
}else if ($i===2){
    echo '15', '<br>';
}else{
    echo '16', '<br>';
}

$godine=19;

if($godine>18){
    echo 'Punoljetan', '<br>';
}else{
    echo 'Maloljetan', '<br>';
}

echo $godine>=18 ? 'Punoljetan' : 'Maloljetan', '<br>';



if(isset($_GET['broj'])){
    echo $_GET['broj'], '<br>';
}else{
    echo 'Postavite GET parametar broj', '<br>';
}

$b = isset($_GET['b']) ? $_GET['b'] : 0;

echo $b, '<br>';


