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

    public function brisanje($sifra=0){
        $sifra=(int)$sifra;
        if($sifra===0){
            header('location: ' . App::config('url') . 'index/odjava');
            return;
        }
        Predavac::delete($sifra);
        header('location: ' . App::config('url') . 'predavac/index');
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




           $this->view->render($this->viewPutanja .
            'detalji',[
                'legend'=>'Unos novog predavača',
                'akcija'=>'Dodaj',
                'poruka'=>$this->poruka,
                'e'=>$this->e
            ]);


    }

    public function promjena($sifra=0)
    {

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