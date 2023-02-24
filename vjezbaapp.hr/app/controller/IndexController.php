<?php

class IndexController extends Controller
{

    public function index()
    {
        $this->view->render('index',[
            'iznos'=>12,
            'podaci'=>[
                2,3,4,5,6
            ]
            ]);
    }

    public function kontakt()
    {
        $this->view->render('kontakt');
    }

    public function api()
    {
        $this->view->api([
            'podaci'=>[
                'id'=>2,
                'osoba'=>[
                    'ime'=>'Pero',
                    'prezime'=>'Perić'
                ]
            ]
        ]);
    }
}