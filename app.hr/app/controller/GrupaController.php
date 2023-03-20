<?php

class GrupaController 
extends AutorizacijaController
implements ViewSucelje
{

    private $viewPutanja = 'privatno' . 
    DIRECTORY_SEPARATOR . 'grupe' . 
    DIRECTORY_SEPARATOR;
    private $e;
    private $poruke=[];

    public function __construct()
    {
        parent::__construct();
   }


    public function index()
    {        
     $this->view->render($this->viewPutanja . 
            'index',[
                'podaci'=>Grupa::read(),
            ]);   
    }

    public function novi()
    {
       
    }

    public function promjena($sifra='')
    {
       
    }




    public function brisanje($sifra=0){
        $sifra=(int)$sifra;
        if($sifra===0){
            header('location: ' . App::config('url') . 'index/odjava');
            return;
        }
        Grupa::delete($sifra);
        header('location: ' . App::config('url') . 'grupa/index');
    }

   
    public function pripremiZaView()
    {
    }

    public function pripremiZaBazu()
    {
   
    }

   

    public function pocetniPodaci()
    {
        $e = new stdClass();
        $e->naziv='';
        $e->smjer=0;
        $e->predavac=0;
        $e->datumpocetka='';
        $e->maksimalnopolaznika=20;
        return $e;
    }
}