drop database if exists kolokvij9;
create database kolokvij9 default charset utf8;
use kolokvij9;

create table ostavljena(
    sifra int not null primary key auto_increment,
    modelnaocala varchar(34) not null,
    suknja varchar(32),
    eura decimal(18,7) not null,
    lipa decimal(15,7) not null,
    treciputa datetime not null,
    drugiputa datetime not null
);

create table snasa(
    sifra int not null primary key auto_increment,
    prstena int,
    drugiputa datetime not null,
    haljina varchar(38) not null,
    ostavljena int
);

create table prijateljica(
    sifra int not null primary key auto_increment,
    treciputa datetime,
    novcica decimal(16,7),
    kuna decimal(14,10) not null,
    drugiputa datetime,
    haljina varchar(45),
    kratkamajica varchar(49)
);

create table punac_prijateljica(
    sifra int not null primary key auto_increment,
    punac int not null,
    prijateljica int not null
);

create table punac(
    sifra int not null primary key auto_increment,
    narukvica int not null,
    modelnaocala varchar(30),
    kuna decimal(12,8),
    bojaociju varchar(33),
    suknja varchar(45)
);

create table cura(
    sifra int not null primary key auto_increment,
    vesta varchar(49) not null,
    ekstrovertno boolean,
    carape varchar(37),
    suknja varchar(37) not null,
    punac int not null
);

create table brat(
    sifra int not null primary key auto_increment,
    novcica decimal(18,9) not null,
    ekstrovertno boolean,
    vesta varchar(32) not null,
    cura int
);

create table zarucnik(
    sifra int not null primary key auto_increment,
    gustoca decimal(17,6),
    haljina varchar(40),
    kratkamajica varchar(48) not null,
    nausnica int not null,
    brat int not null
);


alter table snasa add foreign key (ostavljena) references ostavljena(sifra);

alter table punac_prijateljica add foreign key (punac) references punac(sifra);
alter table punac_prijateljica add foreign key  (prijateljica) references prijateljica(sifra);

alter table cura add foreign key (punac) references punac(sifra);

alter table brat add foreign key (cura) references cura(sifra);

alter table zarucnik add foreign key (brat) references brat(sifra);


# 1. zadatak

insert into prijateljica (treciputa,novcica,kuna,drugiputa,haljina,kratkamajica)
values
(null,null,14.10,null,null,null),
(null,null,10.14,null,null,null),
(null,null,144.99,null,null,null);

insert into punac (narukvica,modelnaocala,kuna,bojaociju,suknja)
values
(32,null,null,null,null),
(45,null,null,null,null),
(876,null,null,null,null);

insert into punac_prijateljica (punac,prijateljica)
values
(1,2),
(2,3),
(3,2);

insert into cura (vesta,ekstrovertno,carape,suknja,punac)
values
('crna',null,null,'bijela',1),
('bijela',null,null,'crna',2),
('crvena',null,null,'zelena',3);

insert into brat (novcica,ekstrovertno,vesta,cura)
values
(18.99,null,'crna',null),
(1018.99,null,'crvena',null),
(118.99,null,'bijela',null);

insert into zarucnik (gustoca,haljina,kratkamajica,nausnica,brat)
values
(null,null,'crna',53,1),
(null,null,'crvena',99,2),
(null,null,'zelena',654,3);


# 2. zadatak

update snasa set drugiputa='2020-04-24';


# 3. zadatak

delete from zarucnik where haljina='AB';


# 4. zadatak

select carape from cura where ekstrovertno is null;


# 5. zadatak

select a.kuna, f.nausnica, e.ekstrovertno
from prijateljica a
inner join punac_prijateljica b on a.sifra=b.prijateljica
inner join punac c on b.punac=c.sifra
inner join cura d on c.sifra=d.punac
inner join brat e on d.sifra=e.cura
inner join zarucnik f on e.sifra=f.brat
where d.ekstrovertno is not null and c.modelnaocala like '%ba%'
order by e.ekstrovertno desc;


# 6. zadatak

select a.modelnaocala, a.kuna
from punac a
left join punac_prijateljica b on a.sifra=b.punac
where b.punac is null;