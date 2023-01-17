<?php

$brojevi=[];

for(;;){
    $i = readline('unesi broj veći od 0: ');
    if(strlen($i)===0){
        echo 'Nisi unio vrijednost' . PHP_EOL;
        continue;
    }
    $i=(int)$i;
    if($i<=0){
        echo 'Nisi unio broj veći od 0' . PHP_EOL;
        continue;
    }
    $brojevi[]=$i;

    if(readline('X za prekid')=='X'){
        break;
    }
}

echo 'Unio si: ' . count($brojevi) . ' brojeva';