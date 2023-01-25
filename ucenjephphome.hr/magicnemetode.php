<?php

include_once 'Pomocno.php';

class Osoba{
    private $ime;
    private $podaci;

    public function __construct($ime){
        $this->ime = $ime;
        $this->podaci=[];
    }

    public function getIme(){
		return $this->ime;
	}

	public function setIme($ime){
		$this->ime = $ime;
	}

    public function __get($naziv){
        if(isset($this->podaci[$naziv])){
            return $this->podaci[$naziv];
        }else{
            return 'ključ ' . $naziv . ' nije postavljen';
        }
    }

    public function __set($naziv,$vrijednost){
        Pomocno::log($naziv);
        Pomocno::log($vrijednost);
        $this->podaci[$naziv]=$vrijednost;
    }
}

$o = new Osoba('Pero');
$o->prezime='Kartaš';
Pomocno::log($o->getIme());
Pomocno::log($o->prezime);

Pomocno::log($o->grad);