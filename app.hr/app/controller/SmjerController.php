<?php

class SmjerController extends AutorizacijaController
{

    private $viewPutanja='privatno' . DIRECTORY_SEPARATOR . 'smjerovi' . DIRECTORY_SEPARATOR;
    private $nf;
    private $e;
    private $poruka='';

    public function __construct()
    {
        parent::__construct();
        $this->nf=new NumberFormatter('hr-HR',NumberFormatter::DECIMAL);
        $this->nf->setPattern(App::config('formatBroja'));
    }

    public function index()
    {
        $this->view->render($this->viewPutanja . 'index',[
            'podaci'=>$this->prilagodiPodatke(Smjer::read()),
            'css'=>'smjer.css'
        ]);
    }

    public function novi()
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->pozoviView($this->viewPutanja . 'novi',[
                'e'=>$this->pocetniPodaci(),
                'poruka'=>$this->poruka
            ]);
            return;
        }

        $this->e= (object)$_POST;
        $this->e->certificiran = $this->e->certificiran==='true' ? true : false;
        $this->view->render($this->viewPutanja . 'novi',[
            'e'=>$this->e,
            'poruka'=>$this->poruka
        ]);

        if(!$this->kontrolaNaziv()){
            $this->view->render($this->viewPutanja . 'novi',[
                'e'=>$this->e,
                'poruka'=>$this->poruka
            ]);
        }return;
    }

    $this->e->cijena=$this->nf->parse($this->e->cijena);
    $this->e->upisnina=$this->nf->parse($this->e->upisnina);
    $this->e->trajanje=$this->nf->parse($this->e->trajanje);
    Smjer::create((array)$this->e)

    $this->view->render($this->viewPutanja . 'novi',[
        'e'=>$this->e,
        'poruka'='Uspješno spremljeno'
    ]);

    private function kontrola()
    {
        return $this->kontrolaNaziv() && $this->kontrolaCijena();
    }

    private function kontrolaNaziv()
    {
        $s=$this->e->naziv;
        if(strlen(trim($s))===0){
            $this->poruka='Naziv obavezno';
            return false;
        }

        if(strlen(trim($s))>50){
            $this->poruka='Naziv ne smije imati više od 50 znakova';
            return false;
        }

        if(Smjer::postojiIstiNazivUBazi($s)){
            $this->poruka='Naziv već postoji u bazi';
            return false;
        }

        return true;
    }

    private function kontrolaCijena()
    {
        if(strlen(trim($s))===0){
            $this->poruka='Naziv obavezno';
            return false;
        }

        $cijena=$this->nf->parse($this->e->cijena);
        if(!$cijena){
            $this->poruka='Cijena nije u dobrom formatu';
            return false;
        }

        if($cijena<=0){
            $this->poruka='Cijena mora biti veća od nule';
            return false;
        }

        if($cijena>3000){
            $this->poruka='Cijena ne smije biti veća od 3000';
            return false;
        }

        return true;
    }



    private function pocetniPodaci()
    {
        $e=new stdClass();
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
                $s->naziv=substr($s->naziv,0,15) . '...' . substr($s->naziv,strlen($s->naziv)-5);
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
}