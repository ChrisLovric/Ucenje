<?php

abstract class AutorizacijaController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!App::auth()){
        header('location: ' . App::config('url') . 'index/prijava?poruka=Prvo se prijavite');
        }
    }

}