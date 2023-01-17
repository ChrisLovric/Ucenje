
<?php

$i=2; $j=0; $k=1;

$i += $k++ + --$j; // na ovoj linij desno 1 + -1   k=2, j=-1, i=2
$k = $i + $j; // i=2, j=-1, k=1

echo $i + --$j; // i=2, j=-2

echo '<hr>';

for($i=0;$i<10;$i=$i+1){
    echo 'Osijek', '<br>';
}