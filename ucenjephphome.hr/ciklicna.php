<div>Unesite broj redaka i stupaca</div><br>
    <div>
        <form action="" method="POST">
        <label for="rows">Broj redaka</label><br>
        <input type="number" name="rows" value="<?=$rows?>"><br><br>
        <label for="columns">Broj stupaca</label><br>
        <input type="number" name="columns" value="<?=$columns?>"><br><br>
        <input type="submit" value="KREIRAJ TABLICU">
        </form>
    </div>

<div>OUTPUT</div><br>


<?php
$rows=null;
$columns=null;

if($_SERVER['REQUEST_METHOD']==='POST'){
    $rows=(int)$_POST['rows'];
    $columns=(int)$_POST['columns'];
    if($rows===0){
        $rows='';
    }
    if($columns===0){
        $columns='';
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

echo '<table>';
    for($i=0;$i<$rows;$i++){
        echo '<tr>';
        for($j=0;$j<$columns;$j++){
            echo '<td style="text-align: right;">' . $ciklicna[$i][$j] . '</td>';
        }
        echo '</tr>';
    }
echo '</table>';
?>