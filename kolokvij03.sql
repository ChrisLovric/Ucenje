drop database if exists kolokvij3;
create database kolokvij3 default charset utf8;
use kolokvij3;

create table cura(
    sifra int not null primary key auto_increment,
    dukserica varchar(49),
    maraka decimal(13,7),
    drugiputa datetime,
    majica varchar(49),
    novcica decimal(15,8),
    ogrlica int not null
);

create table svekar(
    sifra int not null primary key auto_increment,
    novcica decimal(16,8) not null,
    suknja varchar(44) not null,
    bojakose varchar(36),
    prstena int,
    narukvica int not null,
    cura int not null
);

create table brat(
    sifra int not null primary key auto_increment,
    jmbag char(11),
    ogrlica int not null,
    ekstrovertno boolean not null
);

create table prijatelj_brat(
    sifra int not null primary key auto_increment,
    prijatelj int not null,
    brat int not null
);

create table prijatelj(
    sifra int not null primary key auto_increment,
    kuna decimal(16,10),
    haljina varchar(37),
    lipa decimal(13,10),
    dukserica varchar(31),
    indiferentno boolean not null
);

create table ostavljena(
    sifra int not null primary key auto_increment,
    kuna decimal(17,5),
    lipa decimal(15,6),
    majica varchar(36),
    modelnaocala varchar(31) not null,
    prijatelj int
);

create table snasa(
    sifra int not null primary key auto_increment,
    introvertno boolean,
    kuna decimal(15,6) not null,
    eura decimal(13,9) not null,
    treciputa datetime,
    ostavljena int not null
);

create table punica(
    sifra int not null primary key auto_increment,
    asocijalno boolean,
    kratkamajica varchar(44),
    kuna decimal(13,8) not null,
    vesta varchar(32) not null,
    snasa int
);


alter table prijatelj_brat add foreign key (brat) references brat(sifra);
alter table prijatelj_brat add foreign key (prijatelj) references prijatelj(sifra);

alter table ostavljena add foreign key (prijatelj) references prijatelj(sifra);

alter table snasa add foreign key (ostavljena) references ostavljena(sifra);

alter table punica add foreign key (snasa) references snasa(sifra);

alter table svekar add foreign key (cura) references cura(sifra);


# 1. zadatak
insert into brat (jmbag,ogrlica,ekstrovertno)
values
(null,12,true),
(null,10,false),
(null,8,true);

insert into prijatelj (kuna,haljina,lipa,dukserica,indiferentno)
values
(null,null,null,null,true),
(null,null,null,null,true),
(null,null,null,null,false);

insert into prijatelj_brat (prijatelj,brat)
values
(1,1),
(2,2),
(3,3);

insert into ostavljena (kuna,lipa,majica,modelnaocala,prijatelj)
values
(null,null,null,'aviator',null),
(null,null,null,'aviator',null),
(null,null,null,'wayfarer',null);

insert into snasa (introvertno,kuna,eura,treciputa,ostavljena)
values
(null,25.99,100.00,null,1),
(null,99.99,150.45,null,2),
(null,1559.78,118.47,null,3);

insert into punica (asocijalno,kratkamajica,kuna,vesta,snasa)
values
(null,null,555.22,'bijela',null),
(null,null,112.00,'crna',null),
(null,null,1999.98,'zelena',null);



# 2. zadatak
update svekar set suknja='Osijek';


# 3. zadatak
delete from punica where kratkamajica='AB';


# 4. zadatak
select majica from ostavljena where lipa not in (9,10,20,30,35);


# 5. zadatak
select a.ekstrovertno, f.vesta, e.kuna
from brat a
inner join prijatelj_brat b on a.sifra=b.brat
inner join prijatelj c on b.prijatelj=c.sifra
inner join ostavljena d on c.sifra=d.prijatelj
inner join snasa e on d.sifra=e.ostavljena
inner join punica f on e.sifra=f.snasa
where d.lipa!=91 and c.haljina like '%ba%'
order by e.kuna desc;


# 6. zadatak
select a.haljina, a.lipa
from prijatelj a
left join prijatelj_brat b on a.sifra=b.prijatelj
where b.prijatelj is null;