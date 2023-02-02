<?php

include 'Pomocno.php';

class Start{

    private $smjerovi;
    private $dev;

    public function __construct($argc,$argv){
        $this->smjerovi=[];
        if($argc>1 && $argv[1]=='dev'){
            $this->testPodaci();
            $this->dev=true;
        }else{
            $this->dev=false;
        }
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
        switch(Pomocno::rasponBroja('Odaberite opcije: ' ,1,5)){
            case 1:
                $this->smjerIzbornik();
                break;
            case 2:
                $this->grupaIzbornik();
                break;
            case 5:
                echo 'Doviđenja!' . PHP_EOL;
                break;
            default:
                $this->glavniIzbornik();
        }
    }


    private function grupaIzbornik(){
        echo 'Grupa izbornik' . PHP_EOL;
        echo '1 - Pregled' . PHP_EOL;
        echo '2 - Unos novog' . PHP_EOL;
        echo '3 - Promjena postojećeg' . PHP_EOL;
        echo '4 - Brisanje postojećeg' . PHP_EOL;
        echo '5 - Povratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijeGrupa();
}

    private function smjerIzbornik(){
        echo 'Smjer izbornik' . PHP_EOL;
        echo '1 - Pregled' . PHP_EOL;
        echo '2 - Unos novog' . PHP_EOL;
        echo '3 - Promjena postojećeg' . PHP_EOL;
        echo '4 - Brisanje postojećeg' . PHP_EOL;
        echo '5 - Povratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijeSmjer();
}

    private function odabirOpcijeSmjer(){
        switch(Pomocno::rasponBroja('Odaberite opcije: ' ,1,5)){
            case 1:
                $this->pregledSmjerova();
                break;
            case 2:
                $this->unosNovogSmjera();
                break;
            case 3:
                if(count($this->smjerovi)===0){
                    echo 'Nema smjerova u aplikaciji' . PHP_EOL;
                    $this->smjerIzbornik();
                }else{
                    $this->promjenaSmjera();
                }
                break;
            case 4:
                if(count($this->smjerovi)===0){
                    echo 'Nema smjerova u aplikaciji' . PHP_EOL;
                    $this->smjerIzbornik();
                }else{
                $this->brisanjeSmjera();
                }
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->smjerIzbornik();
    }
}
    private function brisanjeSmjera(){
        $this->pregledSmjerova(false);
        $rb=Pomocno::rasponBroja('Odaberite smjer: ',1,count($this->smjerovi));
        $rb--;
        if($this->dev){
            echo 'Prije' . PHP_EOL;
            print_r($this->smjerovi);
        }
        array_splice($this->smjerovi,$rb,1);
        if($this->dev){
            echo 'Poslije' . PHP_EOL;
        print_r($this->smjerovi);
    }

    $this->smjerIzbornik();
}

    private function promjenaSmjera(){
        $this->pregledSmjerova(false);
        $rb=Pomocno::rasponBroja('Odaberite smjer: ',1,count($this->smjerovi));
        $rb--;
        $this->smjerovi[$rb]->naziv=Pomocno::unosTeksta('Unesi naziv smjera (' . 
        $this->smjerovi[$rb]->naziv
        .'): ', $this->smjerovi[$rb]->naziv);
        // ostali atributi
        $this->smjerIzbornik();
    }

    private function odabirOpcijeGrupa(){
        switch(Pomocno::rasponBroja('Odaberite opcije: ' ,1,5)){
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
        $s->cijena=Pomocno::unosDecimalnogBroja('Unesi cijenu smjera (točka za decimalu):');
        $this->smjerovi[]=$s;
        $this->smjerIzbornik();
    }

    private function pregledSmjerova($prikaziIzbornik=true){
        echo '-----------' . PHP_EOL;
        echo 'Smjerovi u aplikaciji' . PHP_EOL;
        $rb=1;
        foreach($this->smjerovi as $smjer){
            echo $rb++ . '. ' . $smjer->naziv . PHP_EOL;
        }
        echo '-----------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->smjerIzbornik();
        }
        
    }
    
    private function testPodaci(){
        $this->smjerovi[]=$this->kreirajSmjer('PHP programiranje',897.99);
        $this->smjerovi[]=$this->kreirajSmjer('Java programiranje',897.99);
        $this->smjerovi[]=$this->kreirajSmjer('Serviser',897.99);
        $this->smjerovi[]=$this->kreirajSmjer('Knjigovodstvo',897.99);
    }

    private function kreirajSmjer($naziv,$cijena){
        $s=new stdClass();
        $s->naziv=$naziv;
        $s->cijena=$cijena;
        return $s;
    }

}
//echo $argv[1], PHP_EOL;
new Start($argc,$argv);

