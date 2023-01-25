<?php

include_once 'Pomocno.php';

//Klasa je opisnik objekta
class Osoba{
    public $ime;
    public $prezime;
}

$o = new Osoba();

$o->ime='Pero';

Pomocno::log($o);

$o = new stdClass();
$o->ime='Pero';
Pomocno::log($o->ime);

