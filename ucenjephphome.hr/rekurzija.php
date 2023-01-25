<?php

include_once 'mojeFunkcije.php';

$suma=0;
for($i=1;$i<=100;$i++){
    $suma+=$i;
}

l($suma);

function zbroji($broj){
    if($broj===1){
        return 1;
    }
    return $broj + zbroji($broj-1);
}

l(zbroji(100));

