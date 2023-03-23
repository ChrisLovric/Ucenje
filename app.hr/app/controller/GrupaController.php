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
                'podaci'=>$this->prilagodiPodatke(Grupa::read()),
            ]);   
    }

    private function prilagodiPodatke($grupe)
    {
        foreach($grupe as $g){
         
            if($g->datumpocetka==null){
                $g->datumpocetka = 'Nije definirano';
            }else{
                $g->datumpocetka=date('d. m. Y.',strtotime($g->datumpocetka));
            }
            if($g->predavac==null){
                $g->predavac = 'Nije definirano';
            }
        }
        return $grupe;
    }


    public function novi()
    {
       $smjerSifra = Smjer::prviSmjer();
       if($smjerSifra==0){
        header('location: ' . App::config('url') . 'smjer?p=1');
       }
       /*
        header('location: ' . 
        App::config('url') . 'grupa/promjena/' .
        Grupa::create([
            'naziv'=>'',
            'smjer'=>$smjerSifra,
            'predavac'=>null,
            'datumpocetka'=>null,
            'maksimalnopolaznika'=>20
        ]));
        */
        $this->promjena(Grupa::create([
            'naziv'=>'',
            'smjer'=>$smjerSifra,
            'predavac'=>null,
            'datumpocetka'=>null,
            'maksimalnopolaznika'=>20
        ]));
    }

    public function odustani($sifra='')
    {
        $e=Grupa::readOne($sifra);

        if($e->naziv=='' && 
        $e->predavac==null && 
        $e->datumpocetka==null &&
        count($e->polaznici)==0){
            Grupa::delete($e->sifra);
            
        }
        header('location: ' . App::config('url') . 'grupa');

    }

    public function promjena($sifra='')
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->promjena_GET($sifra);
            return;
        }


        $this->e = (object)$_POST;

        try {
            $this->e->sifra=$sifra;
            $this->kontrola();
            $this->pripremiZaBazu();
            Grupa::update((array)$this->e);
            header('location:' . App::config('url') . 'grupa');
           } catch (\Exception $th) {
            $this->view->render($this->viewPutanja .
            'detalji',[
                'poruke'=>$this->poruke,
                'e'=>$this->e
            ]);
           }        

    }

    private function kontrola()
    {

    }

    private function promjena_GET($sifra)
    {
        $this->e = Grupa::readOne($sifra);
       $predavaci = [];
       $p = new stdClass();
       $p->sifra=0;
       $p->ime='Nije';
       $p->prezime='Odabrano';
       $predavaci[]=$p;
       foreach(Predavac::read() as $predavac){
        $predavaci[]=$predavac;
       }

       if($this->e->datumpocetka!=null){
        $this->e->datumpocetka = date('Y-m-d',strtotime($this->e->datumpocetka));
       }
       $this->view->render($this->viewPutanja . 
       'detalji',[
           'e'=>$this->e,
           'smjerovi'=>Smjer::read(),
           'predavaci'=>$predavaci
       ]); 
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
        if($this->e->predavac==0){
            $this->e->predavac=null;
        }
        if($this->e->datumpocetka==''){
            $this->e->datumpocetka=null;
        }
   
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