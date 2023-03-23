<?php

class Grupa
{
    // CRUD operacije

    public static function read()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select
        a.sifra,
        a.naziv,
        b.naziv as smjer,
        concat(d.ime, \' \', d.prezime) as predavac,
        a.datumpocetka,
        a.maksimalnopolaznika,
        count(e.polaznik) as polaznika
        from grupa a 
        inner join smjer b on a.smjer =b.sifra 
        left join predavac c on a.predavac =c.sifra 
        left join osoba d on c.osoba =d.sifra 
        left join clan e on a.sifra =e.grupa 
        group by 
        a.sifra,
        a.naziv,
        b.naziv,
        concat(d.ime, \' \', d.prezime),
        a.datumpocetka,
        a.maksimalnopolaznika 
        
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            select * from grupa
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $grupa = $izraz->fetch();

        $izraz = $veza->prepare('
        
        select b.sifra, 
        concat(c.ime, \' \', c.prezime) as imeprezime
        from clan a inner join polaznik b
        on a.polaznik  = b.sifra 
        inner join osoba c on b.osoba =c.sifra 
        where a.grupa=:sifra;
    
    ');
    $izraz->execute([
        'sifra'=>$sifra
    ]);

    $grupa->polaznici = $izraz->fetchAll();

        return $grupa;
    }

    public static function create($parametri)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            insert into grupa
            (naziv,smjer,predavac,
            datumpocetka,maksimalnopolaznika) values
            (:naziv,:smjer,:predavac,
            :datumpocetka,:maksimalnopolaznika);
        
        ');
        $izraz->execute($parametri);
        return $veza->lastInsertId();
    }

    public static function update($parametri)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            update grupa set
            naziv=:naziv,
            smjer=:smjer,
            predavac=:predavac,
            datumpocetka=:datumpocetka,
            maksimalnopolaznika=:maksimalnopolaznika
            where sifra=:sifra
        
        ');
        $izraz->execute($parametri);
    }

    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
            delete from grupa
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $izraz->execute();
    }
}