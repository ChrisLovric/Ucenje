drop database if exists kolokvij1;
create database kolokvij1 default charset utf8;
use kolokvij1;

create table svekar(
    sifra int not null primary key auto_increment,
    bojaociju varchar(40) not null,
    prstena int,
    dukserica varchar(41),
    lipa decimal(13,8),
    eura decimal(12,7),
    majica varchar(35)
);

create table sestra_svekar(
    sifra int not null primary key auto_increment,
    sestra int not null,
    svekar int not null
);

create table sestra(
    sifra int not null primary key auto_increment,
    intovertno boolean,
    haljina varchar(31) not null,
    maraka decimal(16,6),
    hlace varchar(46) not null,
    narukvica int not null
);

create table zena(
    sifra int not null primary key auto_increment,
    treciputa datetime,
    hlace varchar(46),
    kratkamajica varchar(31) not null,
    jmbag char(11) not null,
    bojaociju varchar(39) not null,
    haljina varchar(44),
    sestra int not null
);

create table muskarac(
    sifra int not null primary key auto_increment,
    bojaociju varchar(50) not null,
    hlace varchar(30),
    modelnaocala varchar(43),
    maraka decimal(14,5) not null,
    zena int not null
);

create table mladic(
    sifra int not null primary key auto_increment,
    suknja varchar(50) not null,
    kuna decimal(16,8) not null,
    drugiputa datetime,
    asocijalno boolean,
    ekstrovertno boolean not null,
    dukserica varchar(48) not null,
    muskarac int
);

create table punac(
    sifra int not null primary key auto_increment,
    ogrlica int,
    gustoca decimal(14,9),
    hlace varchar(41) not null
);

create table cura(
    sifra int not null primary key auto_increment,
    novcica decimal(16,5) not null,
    gustoca decimal(18,6) not null,
    lipa decimal(13,10),
    ogrlica int not null,
    bojakose varchar(38),
    suknja varchar(36),
    punac int
);




alter table sestra_svekar add foreign key (svekar) references svekar(sifra);
alter table sestra_svekar add foreign key (sestra) references sestra(sifra);

alter table zena add foreign key (sestra) references sestra(sifra);

alter table muskarac add foreign key (zena) references zena(sifra);

alter table mladic add foreign key (muskarac) references muskarac(sifra);

alter table cura add foreign key (punac) references punac(sifra);


insert into sestra (haljina,hlace,narukvica)
values
('zelena','crvene',12),
('plava','zelene',55),
('rozna','bijele',14);

insert into zena (treciputa,hlace,kratkamajica,jmbag,bojaociju,haljina,sestra)
values
('2022-11-30 19:00:00','jeans','crvena','12345678912','plava','kratka',1),
('2020-05-12 14:55:00','plave','plava','98756325412','zelena','crvena',2),
('2018-04-10 12:10:00','smedje','crna','45693254785','bijela','ljubicasta',3);


insert into muskarac (bojaociju,hlace,modelnaocala,maraka,zena)
values 
('zelena','jeans','aviator',500.00,1),
('plava','plave','aviator',459.10,2),
('crvena','zelene','aviator',888.88,3);

insert into svekar (bojaociju)
values
('plava'),
('zelena'),
('smedja');



insert into sestra_svekar (sestra,svekar)
values
(1,1),
(2,2),
(3,3);


insert into cura (gustoca)
values (15.77);


delete from mladic where kuna>15.78;


select kratkamajica from zena 
where hlace like '%ana%';


select a.dukserica, f.asocijalno, e.hlace
from svekar a
inner join sestra_svekar b on a.sifra=b.svekar
inner join sestra c on b.sestra=c.sifra
inner join zena d on c.sifra=d.sestra
inner join muskarac e on d.sifra=e.zena
inner join mladic f on e.sifra=f.muskarac
where d.hlace like 'a%' and c.haljina like '$ba%'
order by e.hlace desc;


select a.haljina, a.maraka
from sestra a
left join sestra_svekar b on a.sifra=b.sestra
where b.sestra is null;