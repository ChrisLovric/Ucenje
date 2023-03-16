<?php


interface ViewSucelje
{
    public function index();
    public function novi();
    public function promjena($sifra=0);
    public function brisanje($sifra=0);
    public function pocetniPodaci();
    public function pripremiZaView();
    public function pripremiZaBazu();
}