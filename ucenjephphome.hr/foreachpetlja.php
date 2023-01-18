<?php

$indeksniNiz = [2,3,3,2];

for($i=0;$i<count($indeksniNiz);$i++){
    echo $indeksniNiz[$i], '<br>';
}

echo '<hr>';

foreach($indeksniNiz as $vrijednost){
    echo $vrijednost, '<br>';
}

echo '<hr>';

$asocijativniNiz=[
    'visina'=>12,
    'duzina'=>15,
    'sirina'=>10
];

foreach($asocijativniNiz as $vrijednost){
    echo $vrijednost, '<br>';
}

echo '<hr>';

foreach($asocijativniNiz as $kljuc=>$vrijednost){
    echo 'Ključ ' . $kljuc . ' ima vrijednost ' . $vrijednost, '<br>';
}

echo '<hr>';

$slovo='A';
foreach($_SERVER as $k=>$v){
    //echo $k, ': ', strpos($k,'a'), '<br>';
    if(strpos(strtoupper($k),$slovo)>0){
        echo 'Ključ ' . str_replace($slovo,
        '<span style="font-weight: bold; color: red">' . $slovo . '</span>',strtoupper($k)) 
        . ' ima vrijednost ' . $v, '<br>';
    }
}

echo '<hr>';

