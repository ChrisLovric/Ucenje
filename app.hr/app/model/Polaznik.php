<?php

class Polaznik
{
    public static function read($uvjet='',$stranica=1)
    {
        $uvjet = '%' . $uvjet . '%';
        $brps = App::config('brps');
        $pocetak = ($stranica * $brps) - $brps;


        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select 	a.sifra,
                b.ime,
                b.prezime,
                b.email,
                b.oib,
                a.brojugovora, 
                count(c.grupa) as clan
		from 
        polaznik a 
        inner join osoba b on a.osoba=b.sifra
        left join clan c on a.sifra=c.polaznik 
        where concat(b.ime, \' \', b.prezime, \' \', ifnull(b.oib,\'\'))
        like :uvjet
        group by a.sifra,
                b.ime,
                b.prezime,
                b.email,
                b.oib,
                a.brojugovora 
        order by b.prezime, b.ime
        limit :pocetak, :brps
        
        ');
        $izraz->bindValue('pocetak',$pocetak,PDO::PARAM_INT);
        $izraz->bindValue('brps',$brps,PDO::PARAM_INT);
        $izraz->bindParam('uvjet',$uvjet);

        $izraz->execute();

        return $izraz->fetchAll();
    }

    public static function readOne($sifra)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select 	a.sifra,
                b.ime,
                b.prezime,
                b.email,
                b.oib,
                a.brojugovora
		from 
        polaznik a 
        inner join osoba b on a.osoba=b.sifra
        where a.sifra=:sifra
        order by b.prezime, b.ime ;
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        return $izraz->fetch();
    }

    public static function ukupnoPolaznika($uvjet='')
    {
        
        $uvjet = '%' . $uvjet . '%';
        $veza = DB::getInstance();
        $izraz = $veza->prepare('
        
        select 	count(*)
        from 
        polaznik a 
        inner join osoba b on a.osoba=b.sifra 
        where concat(b.ime, \' \', b.prezime, \' \', 
        ifnull(b.oib,\'\'))
        like :uvjet;
        
        ');
        $izraz->execute([
            'uvjet'=>$uvjet
        ]);
        return $izraz->fetchColumn();
    }


    public static function create($parametri)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();

        $izraz = $veza->prepare('
        
        insert into osoba (ime,prezime,oib,email)
        values
        (:ime,:prezime,:oib,:email)
        
        ');
        $izraz->execute([
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'oib'=>$parametri['oib'],
            'email'=>$parametri['email']
        ]);
        $sifraOsoba = $veza->lastInsertId();

        $izraz=$veza->prepare('
        
        insert into polaznik (osoba,brojugovora) 
        values (:osoba,:brojugovora)
        
        ');
        $izraz->execute([
            'osoba'=>$sifraOsoba,
            'brojugovora'=>$parametri['brojugovora']
        ]);


        $veza->commit();
    }


    public static function update($parametri)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        
            select osoba from polaznik where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$parametri['sifra']
        ]);
        $sifraOsoba = $izraz->fetchColumn();

        $izraz = $veza->prepare('
        
            update osoba set
                ime=:ime,
                prezime=:prezime,
                oib=:oib,
                email=:email
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifraOsoba,
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'oib'=>$parametri['oib'],
            'email'=>$parametri['email']
        ]);

        $izraz = $veza->prepare('
        
            update polaznik set
                brojugovora=:brojugovora
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$parametri['sifra'],
            'brojugovora'=>$parametri['brojugovora']
        ]);


        $veza->commit();
    }


    public static function delete($sifra)
    {
        $veza = DB::getInstance();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        
            select osoba from polaznik where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $sifraOsoba = $izraz->fetchColumn();

        $izraz = $veza->prepare('
        
            delete from polaznik
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);

        $izraz = $veza->prepare('
        
            delete from osoba
            where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifraOsoba
        ]);


        $veza->commit();
    }


    public static function postojiIstiOIB($oib,$sifra=0)
    {
        if($sifra>0){
            $sql = ' select count(b.sifra) 
            from polaznik a inner join osoba b
            on a.osoba=b.sifra where b.oib=:oib ';
        }else{
            $sql = ' select count(a.sifra) 
            from osoba a where a.oib=:oib ';
        }

        if($sifra>0){
            $sql.=' and a.sifra!=:sifra';
        }

        $veza = DB::getInstance();
        $izraz = $veza->prepare($sql);

        $parametri=[];
        $parametri['oib']=$oib;

        if($sifra>0){
            $parametri['sifra']=$sifra;
        }

        $izraz->execute($parametri);
        $sifra=$izraz->fetchColumn();
        return $sifra==0;
    }
}