<?php

// ulaz ?a=2&b=2&c=2
// izlaz: 6

// ulaz ?xxxx=2&sdf=2&c1=2
// izlaz: 6

$suma=0;
foreach($_GET as $k=>$v){
    if((int)$v===0){
        continue;
    }
    $suma+=$v;
}
echo $suma;

