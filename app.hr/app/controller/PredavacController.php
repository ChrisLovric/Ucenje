<?php

class PredavacController 
extends AutorizacijaController
implements ViewSucelje
{
    private $viewPutanja='privatno' . DIRECTORY_SEPARATOR . 'predavaci' . DIRECTORY_SEPARATOR;
    private $e;
    private $poruka='';

    public function index()
    {
        $this->view->render($this->viewPutanja . 'index',[
            'podaci'=>Predavac::read()
        ]);
    }

    public function novi()
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->view->render($this->viewPutanja .
            'detalji',[
                'legend'=>'Unos novog predavača',
                'akcija'=>'Dodaj',
                'poruka'=>'Popunite sve tražene podatke',
                'e'=>$this->pocetniPodaci()
            ]);
            return;
           }

           $this->pripremiZaView();

           try {
            $this->kontrola();
            $this->pripremiZaBazu();
            Predavac::create((array)$this->e);
            header('location:' . App::config('url') . 'predavac');
           } catch (\Exception $th) {
            $this->view->render($this->viewPutanja .
            'detalji',[
                'legend'=>'Unos novog predavača IMATE GREŠKE',
                'akcija'=>'Dodaj',
                'poruka'=>$this->poruka,
                'e'=>$this->e
            ]);
           }
    }

    public function promjena($sifra=0)
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->provjeraIntParametra($sifra);
 
             $this->e = Predavac::readOne($sifra);
 
             if($this->e==null){
                 header('location: ' . App::config('url') . 'index/odjava');
                 return;
             }
 
             $this->view->render($this->viewPutanja .
             'detalji',[
                 'legend'=>'Promjena predavača',
                 'akcija'=>'Promjeni',
                 'poruka'=>'Promjenite željene podatke',
                 'e'=>$this->e
             ]);
             return;
         }
 
 
         $this->pripremiZaView();
            
            try {
             $this->e->sifra=$sifra;
             $this->kontrola();
             $this->pripremiZaBazu();
             Predavac::update((array)$this->e);
             header('location:' . App::config('url') . 'predavac');
            } catch (\Exception $th) {
             $this->view->render($this->viewPutanja .
             'detalji',[
                 'legend'=>'Promjena predavača IMATE GREŠKE',
                 'akcija'=>'Promjena',
                 'poruka'=>$this->poruka . ' ' . $th->getMessage(),
                 'e'=>$this->e
             ]);
            }
    }

    public function kontrola()
    {
        $this->kontrolaIme();
        $this->kontrolaOIB();
        $this->kontrolaMail();
        $this->kontrolaOIBIstiUBazi();
        $this->kontrolaMailIstiUBazi();
    }

    private function kontrolaMail()
    {
        $s = $this->e->email;
        if(strlen(trim($s))===0){
            $this->poruka='Email adresa obavezna';
            throw new Exception();
        }

        if(strlen(trim($s))>50){
            $this->poruka='Email adresa ne smije imati više od 50 znakova';
            throw new Exception();
        }

    }

    private function kontrolaMailIstiUBazi()
    {
        if(isset($this->e->sifra)){
            if(!Predavac::postojiIstiMail($this->e->email,$this->e->sifra)){
                $this->poruka='Ista email adresa postoji u bazi';
                throw new Exception();
            }
        }else{
            if(!Predavac::postojiIstiMail($this->e->email)){
                $this->poruka='Ista email adresa postoji u bazi';
                throw new Exception();
            }
        }
        
    }

    private function kontrolaOIBIstiUBazi()
    {
        if(isset($this->e->sifra)){
            if(!Predavac::postojiIstiOIB($this->e->oib,$this->e->sifra)){
                $this->poruka='Isti OIB postoji u bazi';
                throw new Exception();
            }
        }else{
            if(!Predavac::postojiIstiOIB($this->e->oib)){
                $this->poruka='Isti OIB postoji u bazi';
                throw new Exception();
            }
        }
        
    }

    private function kontrolaIme()
    {
        $s = $this->e->ime;
        if(strlen(trim($s))===0){
            $this->poruka='Ime obavezno';
            throw new Exception();
        }

        if(strlen(trim($s))>50){
            $this->poruka='Ime ne smije imati više od 50 znakova';
            throw new Exception();
        }

    }

    private function kontrolaOIB()
    {
        $oib = $this->e->oib;

        if (strlen($oib) != 11 || !is_numeric($oib)) {
            $this->poruka='OIB mora imati 11 znakova, sve brojevi';
            throw new Exception();
        }
    
        $a = 10;
    
        for ($i = 0; $i < 10; $i++) {
    
            $a += (int)$oib[$i];
            $a %= 10;
    
            if ( $a == 0 ) { $a = 10; }
    
            $a *= 2;
            $a %= 11;
    
        }
    
        $kontrolni = 11 - $a;
    
        if ( $kontrolni == 10 ) { $kontrolni = 0; }
    
        if($kontrolni != intval(substr($oib, 10, 1), 10)){
            $this->poruka='OIB nije strukturno ispravan';
            throw new Exception();
        }

    }


    public function brisanje($sifra=0)
    {
        $sifra=(int)$sifra;
        if($sifra===0){
            header('location: ' . App::config('url') . 'index/odjava');
            return;
        }
        Predavac::delete($sifra);
        header('location: ' . App::config('url') . 'predavac/index');
    }


    public function pocetniPodaci()
    {
        $e = new stdClass();
        $e->ime='';
        $e->prezime='';
        $e->email='';
        $e->oib='';
        $e->iban='';
        return $e;

    }
    public function pripremiZaView()
    {
        $this->e = (object)$_POST;
    }
    public function pripremiZaBazu()
    {

    }
}