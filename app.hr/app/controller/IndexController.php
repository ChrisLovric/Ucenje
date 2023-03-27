<?php

class IndexController extends Controller
{

    public function index()
    {
        $this->view->render('index');
    }

    public function prijava()
    {
        if(App::auth()){
            $np=new NadzornaplocaController();
            $np->index();
            return;
        }

        $this->view->render('prijava',[
            'poruka'=>'',
            'email'=>''
        ]);
    }

    public function odjava()
    {
        unset($_SESSION['auth']);
        session_destroy();
        header('location:' . App::config('url'));
    }

    public function jsosnove()
    {
        $this->view->render('jsosnove');
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
                    'prezime'=>'Perić',
                ]
            ]
        ]);
    }


}