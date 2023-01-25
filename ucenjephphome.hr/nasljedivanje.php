<?php

include_once 'Pomocno.php';

abstract class Osoba{
        private $ime;
        protected $status;
    
        public function __construct($ime='',$brojUgovora=''){
            $this->ime= $ime;
        }
    
        public function getIme(){
            return $this->ime;
        }
    
        public function setIme($ime){
            $this->ime= $ime;
        }

        public function __tostring(){
            return $this->ime;
        }
    }

    class Polaznik extends Osoba{
        public function __construct($ime='',$brojUgovora=''){
            parent::__construct($ime);
            $this->BrojUgovora= $brojUgovora;
            $this->status=1;
        }
        public function getBrojUgovora(){
            return $this->brojUgovora;
        }
    
        public function setBrojUgovora($brojUgovora){
            $this->brojUgovora = $brojUgovora;
        }

        public function setIme($ime){
            parent::setIme($ime . ' Pregaženo');
        }
    }

class Predavac extends Osoba{
    
    private $iban;

    public function __construct($ime='',$iban=''){
        parent::__construct($ime);
        $this->iban = $iban;
        $this->status=2;
    }

    public function getIban(){
		return $this->iban;
	}

	public function setIban($iban){
		$this->iban = $iban;
	}

    public function __toString(){
        return $this->status . ': ' . $this->getIme();
    }
}

class Ravnatelj extends Osoba{

}


$polaznik = new Polaznik('Pero','12/2023');
$polaznik->setIme('Karlo');

Pomocno::log($polaznik->getIme());

$predavac = new Predavac('Marija','12547956325');
$predavac->setIme('Zrinka');

echo $predavac;
echo '<hr>';
echo $polaznik;

