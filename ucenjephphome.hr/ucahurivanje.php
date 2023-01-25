<?php

include_once 'Pomocno.php';

class Osoba{
    private $ime;
    private $prezime;

    
    public function getIme(){
		return $this->ime;
	}

	public function setIme($ime){
		$this->ime = $ime;
	}

	public function getPrezime(){
		return $this->prezime;
	}

	public function setPrezime($prezime){
		$this->prezime = $prezime;
	}

}

$o = new Osoba();
$o->setIme('Pero');

Pomocno::log($o->getIme());

