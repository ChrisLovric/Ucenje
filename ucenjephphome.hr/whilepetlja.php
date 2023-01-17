<?php

$uvjet=true;
$i=1;
while($uvjet){
    echo $i++, '<br>';
    if($i>10){
        $uvjet=false;
    }
}
echo '<hr>';

$j=10;
for($i=4;$i>$j;$i--){
    echo $i++, '<br>';
}
echo '&gt;' . $i;

echo '<hr>';

$i=0;

while($i<10){
    echo ++$i, '<br>';
}
echo '<hr>';

$broj=23234;
$znamenaka=0;
while($broj>0){
    $znamenaka++;
    $broj = (int)($broj/10);
    echo $broj, '<br />';
}

echo $znamenaka;
echo '<hr>';

while(true){
    break;
}

$datoteka='datoteka.txt';
$najveci=0;
$ukupno=0;
if (file_exists($datoteka)) {
    $dat = fopen($datoteka, 'r');
    while (($line = fgets($dat)) !==false) {
        //echo strlen($line), '<br>';
        if(strlen($line)===2){
            //echo $line, ',' . $ukupno, '<br>';
            if($ukupno>$najveci){
                $najveci=$ukupno;
            }
            $ukupno=0;
        }else{
            $ukupno+=(int)$line;
        }
       

    }
    fclose($dat);
}
echo $najveci;