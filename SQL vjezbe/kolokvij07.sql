drop database if exists kolokvij7;
create database kolokvij7 default charset utf8;
use kolokvij7;

create table cura(
    sifra int not null primary key auto_increment,
    lipa decimal(12,9) not null,
    introvertno boolean,
    modelnaocala varchar(40),
    narukvica int,
    treciputa datetime,
    kuna decimal(14,9)
);

create table punica(
    sifra int not null primary key auto_increment,
    majica varchar(40),
    eura decimal(12,6) not null,
    prstena int,
    cura int not null
);

create table mladic(
    sifra int not null primary key auto_increment,
    prstena int,
    lipa decimal(14,5) not null,
    narukvica int not null,
    drugiputa datetime not null
);

create table zarucnik_mladic(
    sifra int not null primary key auto_increment,
    zarucnik int not null,
    mladic int not null
);

create table zarucnik(
    sifra int not null primary key auto_increment,
    vesta varchar(34),
    asocijalno boolean not null,
    modelnaocala varchar(43),
    narukvica int not null,
    novcica decimal(15,5) not null
);

create table ostavljen(
    sifra int not null primary key auto_increment,
    lipa decimal(14,6),
    introvertno boolean,
    kratkamajica varchar(38) not null,
    prstena int not null,
    zarucnik int
);

create table prijateljica(
    sifra int not null primary key auto_increment,
    haljina varchar(45),
    gustoca decimal(15,10) not null,
    ogrlica int,
    novcica decimal(12,5),
    ostavljen int
);

create table sestra(
    sifra int not null primary key auto_increment,
    bojakose varchar(34) not null,
    hlace varchar(36) not null,
    lipa decimal(15,6),
    stilfrizura varchar(40) not null,
    maraka decimal(12,8),
    prijateljica int
);


alter table punica add foreign key (cura) references cura(sifra);

alter table zarucnik_mladic add foreign key (mladic) references mladic(sifra);
alter table zarucnik_mladic add foreign key (zarucnik) references zarucnik(sifra);

alter table ostavljen add foreign key (zarucnik) references zarucnik(sifra);

alter table prijateljica add foreign key (ostavljen) references ostavljen(sifra);

alter table sestra add foreign key (prijateljica) references prijateljica(sifra);


# 1. zadatak

insert into mladic (prstena,lipa,narukvica,drugiputa)
values
(null,14.55,76,'2020-12-14 17:45:33'),
(null,32.32,99,'2018-01-25 06:14:25'),
(null,7665.44,103,'1990-05-13 05:11:11');

insert into zarucnik (vesta,asocijalno,modelnaocala,narukvica,novcica)
values
(null,true,null,33,15.15),
(null,true,null,55,33.33),
(null,false,null,22,34.40);

insert into zarucnik_mladic (zarucnik,mladic)
values
(1,1),
(2,2),
(2,1);

insert into ostavljen (lipa,introvertno,kratkamajica,prstena,zarucnik)
values
(null,true,'crvena',43,null),
(null,false,'zelena,',111,null),
(null,true,'crna',77,null);

insert into prijateljica (haljina,gustoca,ogrlica,novcica,ostavljen)
values
(null,156.55,null,null,null),
(null,1.11,null,null,null),
(null,99.99,null,null,null);

insert into sestra (bojakose,hlace,lipa,stilfrizura,maraka,prijateljica)
values
('crvena','crne',null,'frizura01',12.88,null),
('crna','crvene',null,'frizura02',111.44,null),
('zelena','bijele',null,'frizura03',99.89,null);


# 2. zadatak

update punica set eura=15.77;


# 3. zadatak

delete from sestra where hlace<'AB';


# 4. zadatak

select kratkamajica from ostavljen where introvertno is null;


# 5. zadatak

select a.narukvica, f.stilfrizura, e.gustoca
from mladic a
inner join zarucnik_mladic b on a.sifra=b.mladic
inner join zarucnik c on b.zarucnik=c.sifra
inner join ostavljen d on c.sifra=d.zarucnik
inner join prijateljica e on d.sifra=e.ostavljen
inner join sestra f on e.sifra=f.prijateljica
where d.introvertno is not null and c.asocijalno is not null
order by e.gustoca desc;


# 6. zadatak

select a.asocijalno, a.modelnaocala
from zarucnik a
left join zarucnik_mladic b on a.sifra=b.zarucnik
where b.zarucnik is null;