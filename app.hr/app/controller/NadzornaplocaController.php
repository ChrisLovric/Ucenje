<?php

class nadzornaplocaController extends AutorizacijaController
{
    public function index()
    {
        $this->view->render('privatno' . DIRECTORY_SEPARATOR . 'nadzornaPloca');
    }



}