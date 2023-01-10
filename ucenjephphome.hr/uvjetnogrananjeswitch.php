<?php

$grad='Split';
$ocjena=0;
switch($grad){
    case 'Zagreb':
        $ocjena=1;
        break;
    case 'Split':
        $ocjena=2;
        break;
    case 'Osijek':
    case 'Valpovo':
        $ocjena=5;
        break;
    default:
        $ocjena=-1;
}

echo $ocjena;