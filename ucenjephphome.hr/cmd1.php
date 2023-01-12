<?php

for(;;){
    $i = readline('unesi broj');
    if(strlen($i)===0){
        echo 'Nisi unio broj';
        continue;
    }
    break;
}

echo 'Unio si: ' . $i;