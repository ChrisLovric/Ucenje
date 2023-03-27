<?php

class SmjerController 
extends AutorizacijaController
implements ViewSucelje
{

    private $viewPutanja = 'privatno' . 
    DIRECTORY_SEPARATOR . 'smjerovi' . 
    DIRECTORY_SEPARATOR;
    private $nf;
    private $e;
    private $poruke=[];

    public function __construct()
    {
        parent::__construct();
        $this->nf = new NumberFormatter('hr-HR',NumberFormatter::DECIMAL);
        $this->nf->setPattern(App::config('formatBroja'));
    }


    public function index()
    {     
        
        $poruka='';
        if(isset($_GET['p'])){
            switch ((int)$_GET['p']) {
                case 1:
                    $poruka='Prvo kreirajte smjer da bi mogli kreirati grupu';
                    break;
                
                default:
                    $poruka='';
                    break;
            }
        }
     $this->view->render($this->viewPutanja . 
            'index',[
                'podaci'=>$this->prilagodiPodatke(Smjer::read()),
                'poruka'=>$poruka
            ]);   
    }

    public function novi()
    {
       if($_SERVER['REQUEST_METHOD']==='GET'){
        $this->pozoviView([
            'e'=>$this->pocetniPodaci(),
            'poruke'=>$this->poruke,
        ]);
        return;
       } //ovdje sam siguran da nije GET, za nas je onda POST
       $this->pripremiZaView();
       if(!$this->kontrolaNovi()){// kontrolirati podatke, ako nešto ne valja vratiti na view s porukom 
        $this->pozoviView([
            'e'=>$this->e,
            'poruke'=>$this->poruke
        ]);
        return;
       }
       $this->pripremiZaBazu(); // priprema za bazu
       Smjer::create((array)$this->e);  //ako je sve OK spremiti u bazu
       header('location: ' . App::config('url') . 'smjer');
    }

    public function promjena($sifra='')
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->provjeraIntParametra($sifra);

            $this->e = Smjer::readOne($sifra);

            if($this->e==null){
                header('location: ' . App::config('url') . 'index/odjava');
                return;
            }

            $this->e->cijena=$this->nf->format($this->e->cijena);
            $this->e->upisnina=$this->nf->format($this->e->upisnina);

            $this->view->render($this->viewPutanja . 
            'promjena',[
                'e'=>$this->e,
                'poruke'=>'Promjenite podatke po želji'
            ]);  
            return;
        }


        // ovdje je POST
        $this->pripremiZaView();
        if(!$this->kontrolaPromjena()){// kontrolirati podatke, ako nešto ne valja vratiti na view s porukom 
            $this->view->render($this->viewPutanja . 
            'promjena',[
                'e'=>$this->e,
                'poruke'=>$this->poruke
            ]);  
         return;
        }

        $this->e->sifra=$sifra;
        $this->pripremiZaBazu(); // priprema za bazu
        Smjer::update((array)$this->e);
        $this->poruke['poruka']='Uspješno promjenjeno';
        $this->view->render($this->viewPutanja . 
        'promjena',[
            'e'=>$this->e,
            'poruke'=>$this->poruke
        ]);  


    }

    public function brisanje($sifra=0){
        $sifra=(int)$sifra;
        if($sifra===0){
            header('location: ' . App::config('url') . 'index/odjava');
            return;
        }
        Smjer::delete($sifra);
        header('location: ' . App::config('url') . 'smjer/index');
    }

    private function pozoviView($parametri)
    {
        $this->view->render($this->viewPutanja . 
       'novi',$parametri);  
    }

    public function pripremiZaView()
    {
        $this->e = (object)$_POST;
        $this->e->certificiran = $this->e->certificiran==='true' ? true : false;
    }

    public function pripremiZaBazu()
    {
        $this->e->cijena = $this->nf->parse($this->e->cijena);
       $this->e->upisnina = $this->nf->parse($this->e->upisnina);
       $this->e->trajanje = $this->nf->parse($this->e->trajanje);

    }

    private function kontrolaNovi()
    {
        return $this->kontrolaNaziv() 
        & $this->kontrolaCijena()
        & $this->kontrolaTrajanje();
    }

    private function kontrolaPromjena()
    {
       return $this->kontrolaNovi();
    }

    private function kontrolaNaziv()
    {
        $s = $this->e->naziv;
        if(strlen(trim($s))===0){
            $this->poruke['naziv']='Naziv obavezno';
            return false;
        }

        if(strlen(trim($s))>50){
            $this->poruke['naziv']='Naziv ne smije imati više od 50 znakova';
            return false;
        }


        if(Smjer::postojiIstiNazivUBazi($s)){
            $this->poruke['naziv']='Isti naziv postoji u bazi';
            return false; 
        }

        return true;
    }

    private function kontrolaCijena()
    {

        if(strlen(trim($this->e->cijena))===0){
            $this->poruke['cijena']='Cijena obavezno';
            return false;
        }

        $cijena = $this->nf->parse($this->e->cijena);
        //Log::info($cijena);
        if(!$cijena){
            $this->poruke['cijena']='Cijena nije u dobrom formatu';
            return false;
        }

        if($cijena<=0){
            $this->poruke['cijena']='Cijena mora biti veća od nule';
            return false;  
        }

        if($cijena>3000){
            $this->poruke['cijena']='Cijena ne smije biti veća od 3000';
            return false;  
        }


        return true;
    }

    private function kontrolaTrajanje()
    {
        $s = $this->e->trajanje;
        if(strlen(trim($s))===0){
            return true;
        }

        $broj = (int)$s;

        if($broj===0){
            $this->poruke['trajanje']='Trajanje mora biti cijeli broj veći od 0';
            return false;  
        }

        if($broj<0){
            $this->poruke['trajanje']='Trajanje ne smije biti manje od 0';
            return false;  
        }

        if($broj>1000){
            $this->poruke['trajanje']='Maksimalno trajanje je 1000 sati';
            return false;  
        }

        return true;
    }

    public function pocetniPodaci()
    {
        $e = new stdClass();
        $e->naziv='';
        $e->cijena='';
        $e->upisnina='';
        $e->trajanje='';
        $e->certificiran=false;
        return $e;
    }

    private function prilagodiPodatke($smjerovi)
    {

    
        foreach($smjerovi as $s){
            $s->cijena=$this->formatIznosa($s->cijena);
            $s->upisnina=$this->formatIznosa($s->upisnina);
            $s->certificiran=$s->certificiran ? 'check' : 'x';
            $s->title=$s->naziv;
            if(strlen($s->naziv)>20){
                $s->naziv = substr($s->naziv,0,15) . '...' . substr($s->naziv,strlen($s->naziv)-5);
            }
        }
        return $smjerovi;
    }

    private function formatIznosa($broj)
    {
        if($broj==null){
            return $this->nf->format(0);
        }
        return $this->nf->format($broj); 
    }

    public function v1($ruta)
    {
        switch($ruta){
            case 'read':
                $this->view->api(Smjer::read());
            break;
        }
    }
}