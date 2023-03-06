<?php

class SmjerController extends AutorizacijaController
{

    private $viewPutanja='privatno' . DIRECTORY_SEPARATOR . 'smjerovi' . DIRECTORY_SEPARATOR;
    private $nf;

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