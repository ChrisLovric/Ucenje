drop database if exists kolokvij6;
create database kolokvij6 default charset utf8;
use kolokvij6;

create table punac(
    sifra int not null primary key auto_increment,
    ekstrovertno boolean not null,
    suknja varchar(30) not null,
    majica varchar(44) not null,
    prviputa datetime not null
);

create table svekrva(
    sifra int not null primary key auto_increment,
    hlace varchar(48) not null,
    suknja varchar(42) not null,
    ogrlica int not null,
    treciputa datetime not null,
    dukserica varchar(32) not null,
    narukvica int not null,
    punac int
);

create table ostavljena(
    sifra int not null primary key auto_increment,
    prviputa datetime not null,
    kratkamajica varchar(39) not null,
    drugiputa datetime,
    maraka decimal(14,10)
);

create table prijatelj_ostavljena(
    sifra int not null primary key auto_increment,
    prijatelj int not null,
    ostavljena int not null
);

create table prijatelj(
    sifra int not null primary key auto_increment,
    haljina varchar(35),
    prstena int not null,
    introvertno boolean,
    stilfrizura varchar(36) not null
);

create table brat(
    sifra int not null primary key auto_increment,
    nausnica int not null,
    treciputa datetime not null,
    narukvica int not null,
    hlace varchar(31),
    prijatelj int
);

create table zena(
    sifra int not null primary key auto_increment,
    novcica decimal(14,8) not null,
    narukvica int not null,
    dukserica varchar(40) not null,
    haljina varchar(30),
    hlace varchar(32),
    brat int not null
);

create table decko(
    sifra int not null primary key auto_increment,
    prviputa datetime,
    modelnaocala varchar(41),
    nausnica int,
    zena int not null
);


alter table svekrva add foreign key (punac) references punac(sifra);

alter table prijatelj_ostavljena add foreign key (ostavljena) references ostavljena(sifra);
alter table prijatelj_ostavljena add foreign key (prijatelj) references prijatelj(sifra);

alter table brat add foreign key (prijatelj) references prijatelj(sifra);

alter table zena add foreign key (brat) references brat(sifra);

alter table decko add foreign key (zena) references zena(sifra);


# 1. zadatak

insert into ostavljena (prviputa,kratkamajica)
values
('2022-12-11 16:33:22','crvena'),
('2022-12-11 16:33:22','zelena'),
('2022-12-11 16:33:22','plava');

insert into prijatelj (prstena,stilfrizura)
values
(11,'frizura01'),
(33,'frizura02'),
(22,'frizura03');

insert into prijatelj_ostavljena (prijatelj,ostavljena)
values
(1,1),
(2,2),
(2,1);

insert into brat (nausnica,treciputa,narukvica,hlace,prijatelj)
values
(66,'2018-07-06 15:00:00',196,null,null),
(99,'2015-11-14 12:12:13',785,null,null),
(74,'2008-07-15 07:25:00',4,null,null);

insert into zena (novcica,narukvica,dukserica,haljina,hlace,brat)
values
(12.22,33,'crna',null,null,1),
(99.99,25,'zelena',null,null,2),
(118.47,45,'plava',null,null,3);

insert into decko (zena)
values
(1),
(2),
(3);



# 2. zadatak

update svekrva set suknja='Osijek';


# 3. zadatak

delete from decko where modelnaocala<'AB';


# 4. zadatak

select narukvica from brat where treciputa is null;


# 5. zadatak

select a.drugiputa, f.zena, e.narukvica
from ostavljena a
inner join prijatelj_ostavljena b on a.sifra=b.ostavljena
inner join prijatelj c on b.prijatelj=c.sifra
inner join brat d on c.sifra=d.prijatelj
inner join zena e on d.sifra=e.brat
inner join decko f on e.sifra=f.zena
where d.treciputa is not null and c.prstena=219
order by e.narukvica desc;


# 6. zadatak

select a.prstena, a.introvertno
from prijatelj a
left join prijatelj_ostavljena b on a.sifra=b.prijatelj
where b.prijatelj is null;