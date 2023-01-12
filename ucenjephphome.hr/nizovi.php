<?php

$t1=2;
$t2=-2;
$t3=5;

$t = [1,-1,2,5,6,19,30,32,25,17,19,1];

echo $t[0];
echo '<hr>';
echo $t[count($t)-1];
echo '<hr>';

for($i=0;$i<count($t);$i++){
    echo $t[$i], '<br>';
}

echo '<hr>';

echo '<pre>';
print_r($t);
echo '</pre>';

echo '<hr>';

$a = [
    'kljuc'=>'Vrijednost',
    'id'=>2,
    4=>'Pero'
];

echo $a['id'];

echo '<hr>';

echo '<pre>';
print_r($a);
echo '</pre>';

echo '<hr>';

$niz = [0,0,0,0,0,];

$niz = [
    [0,0,0],
    [0,5,0],
    [0,0,0]
];

echo $niz[1][1];

echo '<hr>';

$n=5;
$m=8;
$matrica=[];
for($i=0;$i<$n;$i++){
    $red=[];
    for($j=0;$j<$m;$j++){
        $red[]=0;
    }
    $matrica[]=$red;
}


for($i=3;$i<$n;$i++){
    for($j=1;$j<$m;$j++){
        echo $matrica[$i][$j] . ' ';
    }
    echo '<br>';
}