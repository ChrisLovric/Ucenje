<?php

$i=4; $j=4;
$i += ++$j - $i; //j=5 i=5
$j = --$i + $j; //j=10
echo ++$i + $j--; //14

echo '<hr>';

$i=10; $j=1;
$i += $j + $i; //j=1 i=21
$j += $i + $j; //j=23
echo $i + $j--; //44

echo '<hr>';

$i=12; $j=4;
$i = ++$j - $i; //j=5 i=-7
$j += --$i + $j; //j=2
echo ++$i + $j--; //-5

echo '<hr>';

$i=2; $j=4;
$i += $j - $i++; //j=4 i=4
$j += $i-- + $j; //j=13
echo --$i * ++$j; //42

echo '<hr>';

$i=7; $j=5;
$i += $j-- * $i++; //j=5 i=42
$j += $i-- + $j++; //j=52
echo $i++ - $j--; //-10

echo '<hr>';

$i=7; $j=5;
$i += $j++ * $i--; //j=5 i=42
$j += $i++ + $j--; //j=52
echo $i++ + $j--; //94

echo '<hr>';

$i=5; $j=6;
$i += $j++ - $i--; //j=6 i=6
$j += --$i * --$j; //j=30
echo ++$i + $j--; //35

echo '<hr>';

$i=5; $j=6;
$i += $j++ - $i; //j=6 i=6
$j += --$i * --$j; //j=36
echo ++$i + $j--; //42

echo '<hr>';

$i=4; $j=7;
$i += $j++ - $i++; //j=7 i=7
$j += $i++ * $j++; //j=71
echo ++$i + $j--; //83

echo '<hr>';

$i=6; $j=8;
$i += $j++ - $i++; //j=8 i=8
$j += $i++ * $j++; //j=89
echo ++$i + $j--; //102

echo '<hr>';

$i=3; $j=2;
$i += $j++ * $i--; //j=2 i=9
$j += $i-- - $j++; //j=7
echo $i++ + --$j; //15

echo '<hr>';