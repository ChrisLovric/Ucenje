<?php

include 'Pomocno.php';

class Start{

    private $smjerovi;
    private $polaznici;
    private $predavaci;
    private $grupe;
    private $dev;

    public function __construct($argc,$argv){
        $this->smjerovi=[];
        $this->polaznici=[];
        $this->predavaci=[];
        $this->grupe=[];
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
        echo '2 - Unos nove' . PHP_EOL;
        echo '3 - Promjena postojeće' . PHP_EOL;
        echo '4 - Brisanje postojeće' . PHP_EOL;
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
            case 1:
                $this->pregledGrupa();
                break;
            case 2:
                $this->unosNoveGrupe();
                break;
            case 3:
                if(count($this->smjerovi)===0){
                    echo 'Nema grupa u aplikaciji' . PHP_EOL;
                    $this->grupaIzbornik();
                }else{
                    $this->promjenaGrupe();
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

    private function promjenaGrupe(){
        $this->pregledGrupa(false);
        $rb=Pomocno::rasponBroja('Odaberite grupu: ',1,count($this->smjerovi));
        $rb--;
        $this->grupe[$rb]->naziv=Pomocno::unosTeksta('Unesi naziv smjera (' . 
        $this->grupe[$rb]->naziv
        .'): ', $this->grupe[$rb]->naziv);
        
        $this->pregledSmjerova(false);
        $rbs=Pomocno::rasponBroja('Odaberite smjer: ',1,count($this->smjerovi));
        $rbs--;
        $this->grupe[$rb]=$smjer=$this->smjerovi[$rbs];

        $this->pregledPredavaca(false);
        $rbpr=Pomocno::rasponBroja('Odaberite predavača: ',1,count($this->smjerovi));
        $rbpr--;
        $this->grupe[$rb]->predavac=$this->predavaci[$rbpr];


        //brisanje polaznika
        while(true){
            echo 'Brisanje polaznika na grupi' . PHP_EOL;
            $this->pregledPolaznikaGrupe($this->grupe[$rb]->polaznici);
            $rbp=Pomocno::rasponBroja('Odaberite polaznika: ',1,count($this->grupe[$rb]->polaznici));
            $rbp--;
            array_splice($this->grupe[$rb]->polaznici,$rbp,1);

            if(Pomocno::rasponBroja('1 za dalje, 0 za kraj: ',0,1)===0){
                break;
            }
        }



        //dodavanje polaznika
        while(true){
            echo 'Dodavanje polaznika na grupu' . PHP_EOL;
            $this->pregledPolaznika();
            $rbp=Pomocno::rasponBroja('Odaberite polaznika: ',1,count($this->polaznici));
            $rbp--;
            if(!in_array($this->polaznici[$rbp],$this->grupe[$rb]->polaznici)){
                $this->grupe[$rb]->polaznici[]=$this->polaznici[$rbp];
            }else{
                echo 'Odabrani polaznik već postoji u grupi' . PHP_EOL;

            }
            
            if(Pomocno::rasponBroja('1 za dalje, 0 za kraj: ',0,1)===0){
                break;
            }
        }


        $this->grupaIzbornik();
}

    private function unosNoveGrupe(){
        $o=new stdClass();
        $o->naziv=Pomocno::unosTeksta('Unesi naziv grupe: ');

        $this->pregledSmjerova(false);
        $rb=Pomocno::rasponBroja('Odaberite smjer: ',1,count($this->smjerovi));
        $rb--;
        $o->smjer=$this->smjerovi[$rb];

        $this->pregledPredavaca(false);
        $rb=Pomocno::rasponBroja('Odaberite predavača: ',1,count($this->predavaci));
        $rb--;
        $o->predavac=$this->predavaci[$rb];
        $o->polaznici=[];
        while(true){
            $this->pregledPolaznika();
            $rb=Pomocno::rasponBroja('Odaberite polaznika: ',1,count($this->polaznici));
            $rb--;
            if(!in_array($this->polaznici[$rb],$o->polaznici)){
                $o->polaznici[]=$this->polaznici[$rb];
            }else{
                echo 'Odabrani polaznik već postoji u grupi' . PHP_EOL;

            }
            
            if(Pomocno::rasponBroja('1 za dalje, 0 za kraj: ',0,1)===0){
                break;
            }
        }



        $this->grupe[]=$o;
        $this->grupaIzbornik();


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

    private function pregledGrupa($prikaziIzbornik=true){
        echo '-----------' . PHP_EOL;
        echo 'Grupe u aplikaciji' . PHP_EOL;
        $rb=1;
        foreach($this->grupe as $v){
            echo $rb++ . '. ' . $v->naziv . 
            ' (' . $v->smjer->naziv . '), ' . count($v->polaznici) 
            . ' polaznika' . PHP_EOL;
            $rbp=0;
            foreach($v->polaznici as $p){
                echo "\t" . ++$rbp . '. ' . $p->ime . ' ' . $p->prezime . PHP_EOL;
            }
        }
        echo '-----------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->grupaIzbornik();
        }
        
    }

    private function pregledPredavaca($prikaziIzbornik=true){
        echo '-----------' . PHP_EOL;
        echo 'Predavači u aplikaciji' . PHP_EOL;
        $rb=1;
        foreach($this->predavaci as $v){
            echo $rb++ . '. ' . $v->ime . ' ' . $v->prezime . PHP_EOL;
        }
        echo '-----------' . PHP_EOL;
        if($prikaziIzbornik){
           // $this->grupaIzbornik();
        }
        
    }

    private function pregledPolaznika($prikaziIzbornik=true){
        echo '-----------' . PHP_EOL;
        echo 'Polaznici u aplikaciji' . PHP_EOL;
        $rb=1;
        foreach($this->polaznici as $v){
            echo $rb++ . '. ' . $v->ime . ' ' . $v->prezime . PHP_EOL;
        }
        echo '-----------' . PHP_EOL;
        if($prikaziIzbornik){
          //  $this->grupaIzbornik();
        }
        
    }

    private function pregledPolaznikaGrupe($polaznici){
        echo '-----------' . PHP_EOL;
        echo 'Polaznici u grupi' . PHP_EOL;
        $rb=1;
        foreach($polaznici as $v){
            echo $rb++ . '. ' . $v->ime . ' ' . $v->prezime . PHP_EOL;
        }
        echo '-----------' . PHP_EOL;
        
    }
    
    private function testPodaci(){
        $this->smjerovi[]=$this->kreirajSmjer('PHP programiranje',897.99);
        $this->smjerovi[]=$this->kreirajSmjer('Java programiranje',897.99);
        $this->smjerovi[]=$this->kreirajSmjer('Serviser',897.99);
        $this->smjerovi[]=$this->kreirajSmjer('Knjigovodstvo',897.99);

        $this->polaznici[]=$this->kreirajPolaznik('Pero', 'Perić');
        $this->polaznici[]=$this->kreirajPolaznik('Zrinka', 'Perić');
        $this->polaznici[]=$this->kreirajPolaznik('Karlo', 'Lot');
        $this->polaznici[]=$this->kreirajPolaznik('Maja', 'Kasalo');

        $this->predavaci[]=$this->kreirajPredavac('Pero', 'Perić');
        $this->predavaci[]=$this->kreirajPredavac('Maja', 'Kasalo');
    }

    private function kreirajSmjer($naziv,$cijena){
        $s=new stdClass();
        $s->naziv=$naziv;
        $s->cijena=$cijena;
        return $s;
    }

    private function kreirajPolaznik($ime,$prezime){
        $o=new stdClass();
        $o->ime=$ime;
        $o->prezime=$prezime;
        return $o;
    }

    private function kreirajPredavac($ime,$prezime){
        $o=new stdClass();
        $o->ime=$ime;
        $o->prezime=$prezime;
        return $o;
    }

}
//echo $argv[1], PHP_EOL;
new Start($argc,$argv);

