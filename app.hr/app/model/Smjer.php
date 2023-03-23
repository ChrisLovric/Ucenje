<?php

class Smjer
{
    // CRUD operacije

    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select 	a.sifra, 
                a.naziv,
                a.cijena,
                a.upisnina,
                a.trajanje,
                a.certificiran,
                count(b.sifra) as grupa
        from smjer a 
        left join grupa b on a.sifra=b.smjer
        group by 	a.sifra, 
                    a.naziv,
                    a.cijena,
                    a.upisnina,
                    a.trajanje,
                    a.certificiran
        order by a.naziv asc;
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from smjer
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        return $izraz->fetch();
    }

    public static function create($parametri)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            insert into smjer(naziv,cijena,upisnina,
            trajanje,certificiran) values
            (:naziv,:cijena,:upisnina,
            :trajanje,:certificiran);
        
        ');
        $izraz->execute($parametri);
    }

    public static function update($parametri)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            update smjer set
            naziv=:naziv,
            cijena=:cijena,
            upisnina=:upisnina,
            trajanje=:trajanje,
            certificiran=:certificiran
            where sifra=:sifra
        
        ');
        $izraz->execute($parametri);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            delete from smjer
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $izraz->execute();
    }

    public static function postojiIstiNazivUBazi($s)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select sifra from smjer
            where naziv=:naziv
        
        ');
        $izraz->execute([
            'naziv'=>$s
        ]);
        $sifra=$izraz->fetchColumn();
        return $sifra>0;
    }

    public static function prviSmjer()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select sifra from smjer
            order by sifra limit 1
        
        ');
        $izraz->execute();
        $sifra=$izraz->fetchColumn();
        return $sifra;
    }

}