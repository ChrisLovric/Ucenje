drop database if exists kolokvij8;
create database kolokvij8 default charset utf8;
use kolokvij8;

create table prijateljica(
    sifra int not null primary key auto_increment,
    vesta varchar(50),
    nausnica int not null,
    introvertno boolean not null
);

create table cura(
    sifra int not null primary key auto_increment,
    nausnica int not null,
    indiferentno boolean,
    ogrlica int not null,
    gustoca decimal(12,6),
    drugiputa datetime,
    vesta varchar(33),
    prijateljica int
);

create table decko(
    sifra int not null primary key auto_increment,
    kuna decimal(12,10),
    lipa decimal(17,10),
    bojakose varchar(44),
    treciputa datetime not null,
    ogrlica int not null,
    ekstrovertno boolean not null
);

create table muskarac_decko(
    sifra int not null primary key auto_increment,
    muskarac int null,
    decko int not null
);

create table muskarac(
    sifra int not null primary key auto_increment,
    haljina varchar(47),
    drugiputa datetime not null,
    treciputa datetime
);

create table becar(
    sifra int not null primary key auto_increment,
    eura decimal(15,10) not null,
    treciputa datetime,
    prviputa datetime,
    muskarac int not null
);

create table neprijatelj(
    sifra int not null primary key auto_increment,
    kratkamajica varchar(44),
    introvertno boolean,
    indiferentno boolean,
    ogrlica int not null,
    becar int not null
);

create table brat(
    sifra int not null primary key auto_increment,
    introvertno boolean,
    novcica decimal(14,7) not null,
    treciputa datetime,
    neprijatelj int
);

alter table cura add foreign key (prijateljica) references prijateljica(sifra);

alter table muskarac_decko add foreign key (muskarac) references muskarac(sifra);
alter table muskarac_decko add foreign key (decko) references decko(sifra);

alter table becar add foreign key (muskarac) references muskarac(sifra);

alter table neprijatelj add foreign key (becar) references becar(sifra);

alter table brat add foreign key  (neprijatelj) references neprijatelj(sifra);


# 1. zadatak

insert into decko (kuna,lipa,bojakose,treciputa,ogrlica,ekstrovertno)
values
(null,null,null,'2019-02-07 02:15:36',12,true),
(null,null,null,'2020-02-07 02:15:36',13,false),
(null,null,null,'2021-02-07 02:15:36',15,true);

insert into muskarac (haljina,drugiputa,treciputa)
values
(null,'2018-04-01 14:17:55',null),
(null,'2019-04-01 14:17:55',null),
(null,'2020-04-01 14:17:55',null);

insert into muskarac_decko (muskarac,decko)
values
(1,2),
(2,1),
(3,1);

insert into becar (eura,treciputa,prviputa,muskarac)
values
(15.10,null,null,1),
(10.15,null,null,2),
(11.11,null,null,3);

insert into neprijatelj (kratkamajica,introvertno,indiferentno,ogrlica,becar)
values
('crna',null,null,123,1),
('zelena',null,null,321,2),
('crvena',null,null,213,3);

insert into brat (introvertno,novcica,treciputa,neprijatelj)
values
(null,14.70,null,null),
(null,17.40,null,null),
(null,70.14,null,null);


# 2. zadatak

update cura set indiferentno=false;


# 3. zadatak

delete from brat where novcica!=12.75;


# 4. zadatak

select prviputa from becar where treciputa is null;


# 5. zadatak

select a.bojakose, f.neprijatelj, e.introvertno
from decko a
inner join muskarac_decko b on a.sifra=b.decko
inner join muskarac c on b.muskarac=c.sifra
inner join becar d on c.sifra=d.muskarac
inner join neprijatelj e on d.sifra=e.becar
inner join brat f on e.sifra=f.neprijatelj
where d.treciputa is not null and c.drugiputa is not null
order by e.introvertno desc;


# 6. zadatak

select a.drugiputa, a.treciputa
from muskarac a
left join muskarac_decko b on a.sifra=b.muskarac
where b.muskarac is null;