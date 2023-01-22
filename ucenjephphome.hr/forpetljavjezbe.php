<?php

for($i=30;$i>20;$i=$i-4){
    echo 'Osijek ' . $i-1, '<br>';
}

echo '<hr>';

for($i=12;$i<20;$i=$i+3){
    echo 'Osijek ' . $i+2, '<br>';
}

echo '<hr>';

$poc = 15;
$kraj = 30;
for($i=$poc;$i<=$kraj;$i=$i+1){
    if($i%5===0){
        echo $i, '<br>';
    }
}

echo '<hr>';

$zbroj=0;
for($i=1;$i<=200;++$i){
    $zbroj += $i;
}
echo $zbroj;

echo '<hr>';

$zauzeto=18;

for($i=10;$i<51;$i=$i+4){
    if($i===$zauzeto){
        continue;
    }
    echo $i, '<br>';
}

echo '<hr>';

//aritmeticka sredina dva broja

$a = readline('unesi broj veći od 0: ');
$b = readline('unesi broj veći od 0: ');

$aritsredina = ($a + $b) / 2;

echo $aritsredina;

echo '<hr>';

echo '<table>';
for($i=1;$i<21;$i++){
    echo '<tr>';
    for($j=1;$j<21;$j++){
        echo '<td style="text-align: right;">' . $i * $j, '</td>';
    }
    echo '</tr>';
}
echo '</table>';

echo '<hr>';

$zbroj=0;
for($i=1;$i<30;$i++){
    $zbroj += $i;
}
echo $zbroj;

echo '<hr>';

for($i=1;$i<=5;$i++){
    for($j=1;$j<=$i;$j++){
        echo "*";
        if($j<$i){
            echo " ";
        }
    }
    echo "<br>";
}

echo '<hr>';

for($i=1;$i<=10;$i++){
    if($i<10){
        echo "$i-";
    }
    else{
        echo $i;
    }
}