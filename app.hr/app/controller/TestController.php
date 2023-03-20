<?php

class TestController 
{
    public function lozinka()
    {
        echo password_hash('edunova',PASSWORD_BCRYPT);
    }

    public function email()
    {
        echo Util::is_email('tjakopec@gmail.com') ? 'OK' : 'NE';
    }

    public function dodajpolaznike()
    {
        for($i=0;$i<300;$i++){
            Polaznik::create([
                'ime'=>'Polaznik ' . $i,
                'prezime'=>'Prezime ',
                'oib'=>'',
                'email'=>'',
                'brojugovora'=>'',
            ]);
            echo $i . '<br>';
        }
    }


}