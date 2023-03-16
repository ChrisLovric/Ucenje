<?php

class Predavac
{
    public static function read()
    {
        $veza=DB::getInstance();
        $izraz=$veza->prepare('
        
        select	a.sifra,
		        b.ime,
		        b.prezime,
		        b.email,
		        b.oib,
		        a.iban,
		        count(c.sifra) as grupa
        from
        predavac a
        inner join osoba b on a.osoba=b.sifra
        left join grupa c on a.sifra=c.predavac
        group by a.sifra,
		        b.ime,
		        b.prezime,
		        b.email,
		        b.oib,
		        a.iban
        order by b.prezime, b.ime;
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function readOne($sifra)
    {
        $veza=DB::getInstance();
        $izraz=$veza->prepare('
        
        select	a.sifra,
		        b.ime,
		        b.prezime,
		        b.email,
		        b.oib,
		        a.iban
        from
        predavac a
        inner join osoba b on a.osoba=b.sifra
        where a.sifra=:sifra
        order by b.prezime, b.ime;

        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        return $izraz->fetch();
    }

    public static function create($parametri)
    {
        $veza=DB::getInstance();
        $veza->beginTransaction();

        $izraz=$veza->prepare('
        
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
        $sifraOsoba=$veza->lastInsertId();

        $izraz=$veza->prepare('
        
        insert into predavac (osoba,iban)
        values (:osoba,:iban);
        
        ');
        $izraz->execute([
            'osoba'=>$sifraOsoba,
            'iban'=>$parametri['iban'],
        ]);

        $veza->commit();
    }

    public static function update($parametri)
    {
        $veza=DB::getInstance();
        $veza->beginTransaction();

        $izraz=$veza->prepare('
        
        select osoba from predavac where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$parametri['sifra']
        ]);
        $sifraOsoba=$izraz->fetchColumn();

        $izraz=$veza->prepare('
        
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
            'email'=>$parametri['email'],
        ]);

        $izraz=$veza->prepare('
        
        update predavac set
            iban=:iban
        where sifra=:sifra
        ');
        $izraz->execute([
            'sifra'=>$parametri['sifra'],
            'iban'=>$parametri['iban']
        ]);

        $veza->commit();
    }

    public static function delete($sifra)
    {
        $veza=DB::getInstance();
        $veza->beginTransaction();

        $izraz=$veza->prepare('
        
        select osoba from predavac where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);
        $sifraOsoba=$izraz->fetchColumn();

        $izraz=$veza->prepare('
        
        delete from predavac
        where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);

        $izraz=$veza->prepare('
        
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
            from predavac a inner join osoba b
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

    public static function postojiIstiMail($email,$sifra=0)
    {
        if($sifra>0){
            $sql = ' select count(b.sifra) 
            from predavac a inner join osoba b
            on a.osoba=b.sifra where b.email=:email ';
        }else{
            $sql = ' select count(a.sifra) 
            from osoba a where a.email=:email ';
        }

        if($sifra>0){
            $sql.=' and a.sifra!=:sifra';
        }

        $veza = DB::getInstance();
        $izraz = $veza->prepare($sql);

        $parametri=[];
        $parametri['email']=$email;

        if($sifra>0){
            $parametri['sifra']=$sifra;
        }

        $izraz->execute($parametri);
        $sifra=$izraz->fetchColumn();
        return $sifra==0;
    }
}