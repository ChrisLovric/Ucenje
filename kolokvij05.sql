drop database if exists kolokvij5;
create database kolokvij5 default charset utf8;
use kolokvij5;

create table zarucnik(
    sifra int not null primary key auto_increment,
    jmbag char(11),
    lipa decimal(12,8),
    indiferentno boolean not null
);

create table mladic(
    sifra int not null primary key auto_increment,
    kratkamajica varchar(48) not null,
    haljina varchar(30) not null,
    asocijalno boolean,
    zarucnik int
);

create table cura(
    sifra int not null primary key auto_increment,
    carape varchar(41) not null,
    maraka decimal(17,10) not null,
    asocijalno boolean,
    vesta varchar(47) not null
);

create table svekar_cura(
    sifra int not null primary key auto_increment,
    svekar int not null,
    cura int not null
);

create table svekar(
    sifra int not null primary key auto_increment,
    bojakose varchar(33),
    majica varchar(31),
    carape varchar(31) not null,
    haljina varchar(43),
    narukvica int,
    eura decimal(14,5)
);

create table punac(
    sifra int not null primary key auto_increment,
    dukserica varchar(33),
    prviputa datetime not null,
    majica varchar(36),
    svekar int not null
);

create table punica(
    sifra int not null primary key auto_increment,
    hlace varchar(43) not null,
    nausnica int not null,
    ogrlica int,
    vesta varchar(49) not null,
    modelnaocala varchar(31) not null,
    treciputa datetime not null,
    punac int not null
);

create table ostavljena(
    sifra int not null primary key auto_increment,
    majica varchar(33),
    ogrlica int not null,
    carape varchar(44),
    stilfrizura varchar(42),
    punica int not null
);


alter table mladic add foreign key (zarucnik) references zarucnik(sifra);

alter table svekar_cura add foreign key (svekar) references svekar(sifra);
alter table svekar_cura add foreign key (cura) references cura(sifra);

alter table punac add foreign key (svekar) references svekar(sifra);

alter table punica add foreign key (punac) references punac(sifra);

alter table ostavljena add foreign key (punica) references punica(sifra);


# 1. zadatak

insert into cura (carape,maraka,asocijalno,vesta)
values
('crne',15.55,null,'zelena'),
('bijele',199.99,null,'plava'),
('zelene',1569.45,null,'crvena');

insert into svekar (bojakose,majica,carape,haljina,narukvica,eura)
values
(null,null,'crne',null,null,99.99),
(null,null,'zelene',null,null,0.45),
(null,null,'crvene',null,null,1459.74);

insert into svekar_cura (svekar,cura)
values
(1,2),
(2,1),
(2,2);

insert into punac (dukserica,prviputa,majica,svekar)
values
(null,'1980-10-13 12:12:12',null,1),
(null,'1991-03-22 13:17:15',null,2),
(null,'1958-02-29 17:13:58',null,3);

insert into punica (hlace,nausnica,ogrlica,vesta,modelnaocala,treciputa,punac)
values
('crne',77,null,'plava','model01','2022-12-10 15:12:45',1),
('sive',12,null,'zelena','model02','2022-10-05 23:22:11',2),
('bijele',32,null,'crvena','model03','2022-01-01 00:04:32',3);

insert into ostavljena (majica,ogrlica,carape,stilfrizura,punica)
values
(null,22,null,null,1),
(null,45,null,null,2),
(null,12,null,null,3);



# 2. zadatak

update mladic set haljina='Osijek';


# 3. zadatak

delete from ostavljena where ogrlica=17;


# 4. zadatak

select majica from punac where prviputa is null;


# 5. zadatak

select a.asocijalno, f.stilfrizura, e.nausnica
from cura a
inner join svekar_cura b on a.sifra=b.cura
inner join svekar c on b.svekar=c.sifra
inner join punac d on c.sifra=d.svekar
inner join punica e on d.sifra=e.punac
inner join ostavljena f on e.sifra=f.punica
where d.prviputa is not null and c.majica like '%ba%'
order by e.nausnica desc;


# 6. zadatak

select a.majica, a.carape
from svekar a
left join svekar_cura b on a.sifra=b.svekar
where b.sifra is null;