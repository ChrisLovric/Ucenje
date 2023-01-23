<?php
/*
phpinfo();

echo '<hr>';

print_r($_GET);

echo '<hr>';

$t = time();
echo $t, '<hr>';

if(!isset($_GET['ime'])){
    echo 'Ime nije postavljeno', '<hr>';
}

*/


function pozdraviSvijet(){
    echo '<hr>Hello world';
    echo '<br>';
    echo 'Pozdrav svijetu';
    echo '<hr>';
}

pozdraviSvijet();
echo '22';
pozdraviSvijet();


function l($v){
    echo '<pre>';
    print_r($v);
    echo '</pre>';
    echo '<hr>';
}

$niz=[2,2,2,3];
l($niz);
l('Pero');
l([7,3,2]);


function slucajniBroj(){
    $prvi= rand(1,10);
    $drugi= rand(-10,-1);
    return abs($prvi+$drugi);
}

$s = 0;

for($i=0;$i<100;$i++){
    $s+= slucajniBroj();
}
l($s);


function primBroj($broj){
    $p=true;
    for($i=2;$i<$broj;$i++){
        if($broj % $i===0){
            $p=false;
            return false;
        }
    }
    return true;
}

$trenutni=1;
$suma=0;
$ukupno=0;
while(true){
    if(primBroj(++$trenutni)){
        $suma+=$trenutni;
        $ukupno++;
    }
    if($ukupno===13){
        break;
    }
}
echo $ukupno, '=>', $suma;


$i=2;

function funkcija($broj){
    // Warning: Undefined variable $i
    // return $i + $broj;
    return $broj;
}

l (funkcija($i + 5));