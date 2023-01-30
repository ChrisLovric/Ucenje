<?php

include 'Pomocno.php';

class Start{

    private $smjerovi;

    public function __construct(){
        $this->smjerovi=[];
        $this->pozdravnaPoruka();
        $this->glavniIzbornik();
    }

    private function pozdravnaPoruka(){
        echo 'Dobrodošli u Edunova terminal APP' . PHP_EOL;
    }

    private function glavniIzbornik(){
        echo 'Glavni izbornik' . PHP_EOL;
        echo '1 - Smjerovi' . PHP_EOL;
        echo '2 - Grupe' . PHP_EOL;
        echo '3 - Polaznici' . PHP_EOL;
        echo '4 - Predavači' . PHP_EOL;
        echo '5 - Izlaz iz programa' . PHP_EOL;
        $this->odabirOpcijeGlavniIzbornik();
    }

    private function odabirOpcijeGlavniIzbornik(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ' ,1,5)){
            case 1:
                $this->smjerIzbornik();
                break;
            case 2:
                $this->grupaIzbornik();
            case 5:
                echo 'Doviđenja!' . PHP_EOL;
                break;
            default:
                $this->glavniIzbornik();
        }
    }


    private function smjerIzbornik(){
        echo 'Smjer izbornik' . PHP_EOL;
        echo '1 - Pregled' . PHP_EOL;
        echo '2 - Uos novog' . PHP_EOL;
        echo '3 - Promjena postojećeg' . PHP_EOL;
        echo '4 - Brisanje postojećeg' . PHP_EOL;
        echo '5 - Povaratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijeSmjer();
}

    private function odabirOpcijeSmjer(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ' ,1,5)){
            case 1:
                $this->pregledSmjerova();
                break;
            case 2:
                $this->unosNovogSmjera();
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->smjerIzbornik();
    }
}

    private function unosNovogSmjera(){
        $s=new stdClass();
        $s->naziv=Pomocno::unosTeksta('Unesi naziv smjera: ');
        $s->cijena=Pomocno::unosDecimalnogBroja('Unesi cijenu smjera (točka za decimalni dio');
        $this->smjerovi[]=$s;
        $this->smjerIzbornik();
    }

    private function pregledSmjerova(){
        echo '-----------' . PHP_EOL;
        echo 'Smjerovi u aplikaciji' . PHP_EOL;
        foreach($this->smjerovi as $smjer){
            echo $smjer->naziv . PHP_EOL;
        }
        $this->smjerIzbornik();
    }
    
    private function testPodaci(){
        $s=newstdClass();
        $s->naziv='PHP programiranje';
        $s->cijena=987.99;
        $this->smjerovi[]=$s;
    }

    private function kreirajSmjer($naziv,$cijena){
        
    }

}

new Start();

