<?php

class Smjer
{
    public static function  read()
    {
        $veza=DB::getInstance();
        $izraz=$veza->prepare('
        
        select * from smjer
        order by naziv asc
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function create($parametri)
    {
        $veza=DB::getInstance();
        $izraz=$veza->prepare('
        
        insert into smjer (naziv,cijena,upisnina,trajanje,certificiran) values (:naziv,:cijena,:upisnina,:trajanje,:certificiran);
        
        ');
        $izraz->execute($parametri);
    }

    public static function postojiIstiNazivUBazi($s)
    {
        $veza=DB::getInstance();
        $izraz=$veza->prepare('
        
        select sifra from smjer
        where naziv=:naziv
        
        ');
        $izraz->execute([]);
        $sifra=$izraz->fetchColumn();
        return $sifra>0;
    }
}
