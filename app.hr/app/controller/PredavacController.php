<?php

class PredavacController extends AutorizacijaController
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
}