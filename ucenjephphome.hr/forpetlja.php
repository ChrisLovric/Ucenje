<?php
/*
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
echo 'Osijek', '<br>';
*/

for($i=0;$i<10;$i=$i+1){
    echo 'Osijek', '<br>';
}

echo '<hr>';

for($i=0;$i<10;$i=$i+1){
    echo 'Osijek ' . ($i+1), '<br>';
}

echo '<hr>';

for($i=0;$i<10;$i=$i+3){
    echo 'Osijek ' . ($i+1), '<br>';
}

echo '<hr>';

for($i=10;$i>0;$i=$i-1){
    echo 'Osijek ' . $i, '<br>';
}

echo '<hr>';

$poc = 1;
$kraj = 20;
for($i=$poc;$i<=$kraj;$i=$i+1){
    if($i%2===0){
        echo $i, '<br>';
    }
}

/*
echo '<hr>';

$zbroj=0;
for($i=1;$i<=100;$i=$i++){
    $zbroj += $i;
}
echo $zbroj;
*/
echo '<hr>';


$broj = 68924;
$prim=true;
for($i=2;$i<$broj;$i++){
    echo 'Provjeravam za ' . $i , '<br>';
    if($broj%$i===0){
        $prim=false;
        break;
    }
}
echo $broj .  ($prim ? ' JE' : ' NIJE') . ' prim broj';

echo '<hr>';

$zauzeto=3;

for($i=0;$i<10;$i++){
    if($i===$zauzeto){
        continue;
    }
    echo $i, '<br>';
}

echo '<hr>';

echo '<table>';
for($i=1;$i<=10;$i++){
    echo '<tr>';
    for($j=1;$j<=10;$j++){
        echo '<td style="text-align: right;">' . $i * $j, '</td>';
    }
    echo '</tr>';
}
echo '</table>';

for($i=1;$i<=10;$i++){
    for($j=1;$j<=10;$j++){
        if($j===3){
            break 2;
        }
    }
}


for(;;){
break;
}