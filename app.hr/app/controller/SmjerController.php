<?php

class SmjerController 
extends AutorizacijaController
implements ViewSucelje
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
            $this->pozoviView([
                'e'=>$this->pocetniPodaci(),
                'poruka'=>$this->poruka
            ]);
            return;
        }

        $this->pripremiZaView();
        if(!$this->kontrolaNovi()){
            $this->pozoviView([
                'e'=>$this->e,
                'poruka'=>$this->poruka
            ]);
            return;
        }
        $this->pripremiZaBazu();
        Smjer::create((array)$this->e);
        $this->pozoviView([
            'e'=>$this->pocetniPodaci(),
            'poruka'=>'Uspješno spremljeno'
        ]);
    }

    public function promjena($sifra='')
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->provjeraIntParametra($sifra);

            $this->e=Smjer::readOne($sifra);

            if($this->e==null){
                header('location: ' . App::config('url') . 'index/odjava');
                return;
            }

            $this->e->cijena=$this->nf->format($this->e->cijena);
            $this->e->upisnina=$this->nf->format($this->e->upisnina);

            $this->view->render($this->viewPutanja . 'promjena',[
                'e'=>$this->e,
                'poruka'=>'Promijenite podatke po želji'
            ]);
            return;
        }

        $this->pripremiZaView();
        if(!$this->kontrolaPromjena()){
            $this->view->render($this->viewPutanja . 'promjena',[
                'e'=>$this->e,
                'poruka'=>$this->poruka
            ]);
            return;
        }

        $this->e->sifra=$sifra;
        $this->pripremiZaBazu();
        Smjer::update((array)$this->e);
        $this->view->render($this->viewPutanja . 'promjena',[
            'e'=>$this->e,
            'poruka'=>'Uspješno promijenjeno'
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
        $this->view->render($this->viewPutanja . 'novi',$parametri);
    }

    public function pripremiZaView()
    {
        $this->e=(object)$_POST;
        $this->e->certificiran=$this->e->certificiran==='true' ? true : false;
    }

    public function pripremiZaBazu()
    {
        $this->e->cijena=$this->nf->parse($this->e->cijena);
        $this->e->upisnina=$this->nf->parse($this->e->upisnina);
        $this->e->trajanje=$this->nf->parse($this->e->trajanje);
    }

    private function kontrolaNovi()
    {
        return $this->kontrolaNaziv() && $this->kontrolaCijena() && $this->kontrolaUpisnina();
    }

    private function kontrolaPromjena()
    {
        return $this->kontrolaNazivPromjena() && $this->kontrolaCijena() && $this->kontrolaUpisnina() && $this->kontrolaTrajanje();
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

    private function kontrolaNazivPromjena()
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

        return true;
    }

    private function kontrolaCijena()
    {
        if(strlen(trim($this->e->cijena))===0){
            $this->poruka='Cijena obavezno';
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

    private function kontrolaUpisnina()
    {
        if(strlen(trim($this->e->upisnina))===0){
            $this->poruka='Upisnina obavezno';
            return false;
        }

        $upisnina=$this->nf->parse($this->e->upisnina);
        if(!$upisnina){
            $this->poruka='Upisnina nije u dobrom formatu';
            return false;
        }

        if($upisnina<=0){
            $this->poruka='Upisnina mora biti veća od nule';
            return false;
        }

        if($upisnina>3000){
            $this->poruka='Upisnina ne smije biti veća od 3000';
            return false;
        }

        return true;
    }

    private function kontrolaTrajanje()
    {
        if(strlen(trim($this->e->trajanje))===0){
            $this->poruka='Trajanje obavezno';
            return false;
        }

        $trajanje=$this->nf->parse($this->e->trajanje);
        if(!$trajanje){
            $this->poruka='Trajanje nije u dobrom formatu';
            return false;
        }

        if($trajanje<=0){
            $this->poruka='Trajanje mora biti veće od nule';
            return false;
        }

        if($trajanje>130){
            $this->poruka='Trajanje ne smije biti veće od 130';
            return false;
        }

        return true;
    }



    public function pocetniPodaci()
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