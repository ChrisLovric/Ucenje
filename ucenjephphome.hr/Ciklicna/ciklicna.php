<?php
$rows=null;
$columns=null;
$errorporuka='';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $rows=(int)$_POST['rows'];
    $columns=(int)$_POST['columns'];
    if($rows===0){
        $rows='';
    }if($columns===0){
        $columns='';
    }if($rows==='' && $columns===''){
        $errorporuka='OBAVEZAN UNOS REDAKA I STUPACA!';
    }if($rows!=='' && $columns===''){
        $errorporuka='OBAVEZAN UNOS REDAKA I STUPACA!';
    }if($rows==='' && $columns!==''){
        $errorporuka='OBAVEZAN UNOS REDAKA I STUPACA!';
    }
}

$maxRows=(int)$rows-1;
$maxCol=(int)$columns-1;
$output=1;
$ciklicna=[];
$minCol=0;
$minRows=0;

while($output<=(int)$rows*(int)$columns)
{
    for($j=$maxCol;$j>=$minCol;$j--){
        $ciklicna[$maxRows][$j]=$output++;
    }
        $maxRows--;
        if($output>$rows*$columns)
        break;

    for($i=$maxRows;$i>=$minRows;$i--){
        $ciklicna[$i][$minCol]=$output++;
    }
        $minCol++;
        if($output>$rows*$columns)
        break;

    for($j=$minCol;$j<=$maxCol;$j++){
        $ciklicna[$minRows][$j]=$output++;
    }
        $minRows++;
        if($output>$rows*$columns)
        break;

    for($i=$minRows;$i<=$maxRows;$i++){
        $ciklicna[$i][$maxCol]=$output++;
    }
        $maxCol--;
}


?>