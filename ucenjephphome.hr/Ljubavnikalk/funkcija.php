<?php

function Zbroj($ime1,$ime2){
    $obaimena='';
    $ukupno=[];
    $obaimena=(strtoupper($ime1)) . (strtoupper($ime2));

    $array=str_split($obaimena);
    for($i=0;$i<(strlen($obaimena));$i++){
        $ukupno[]=substr_count($obaimena,$array[$i]);
    }
    $ukupno=implode('',$ukupno);

    return $ukupno;
}

function Postotak($unos){
    $postotak=[];
    if($unos<100){
        return $unos;
    }
    if(strlen($unos)%2===0){
        $j=1;
        $k=(int)((strlen($unos))/2);
        for($j=1;$j<=$k;$j++){
            $b=$unos[$j-1];
            $a=$unos[strlen($unos)-$j];
            $postotak[]=($a+$b);
        }
    }else{
        $l=1;
        $k=(int)((strlen($unos))/2);
        for($l=1;$l<=$k;$l++){
            $b=$unos[$l-1];
            $a=$unos[strlen($unos)-$l];
            $postotak[]=($a+$b);
        }
            $postotak[]=$unos[$k];
    }
    $postotak=implode('',$postotak);

    return Postotak($postotak);
}

?>