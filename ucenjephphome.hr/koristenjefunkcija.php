<?php

require_once 'mojeFunkcije.php';

l([2,3,4,]);

require_once 'Pomocno.php';

Pomocno::log([7,4,5]);

$p = new Pomocno();
$p->setIme('Pero');
// sleep(5);
$p->ispis(2);

echo Pomocno::validOib('98864571283') ? 'OK' : 'NE';