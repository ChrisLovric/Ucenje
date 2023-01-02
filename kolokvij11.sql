drop database if exists kolokvij11;
create database kolokvij11 default charset utf8;
use kolokvij11;

create table neprijatelj(
    sifra int not null primary key auto_increment,
    narukvica int not null,
    novcica decimal(12,8) not null,
    bojakose varchar(39) not null,
    gustoca decimal(14,10),
    introvertno boolean not null,
    asocijalno boolean
);

create table muskarac(
    sifra int not null primary key auto_increment,
    maraka decimal(16,5),
    novcica decimal(13,10),
    nausnica int,
    narukvica int not null,
    gustoca decimal(12,6),
    neprijatelj int not null
);

create table mladic(
    sifra int not null primary key auto_increment,
    ogrlica int not null,
    stilfrizura varchar(35),
    drugiputa datetime not null,
    hlace varchar(41) not null
);

create table punac_mladic(
    sifra int not null primary key auto_increment,
    punac int not null,
    mladic int not null
);

create table punac(
    sifra int not null primary key auto_increment,
    jmbag char(11),
    kuna decimal (16,5),
    vesta varchar(45)
);

create table svekrva(
    sifra int not null primary key auto_increment,
    narukvica int not null,
    carape varchar(39) not null,
    haljina varchar(31),
    punac int not null
);

create table punica(
    sifra int not null primary key auto_increment,
    carape varchar(33) not null,
    drugiputa datetime,
    majica varchar(40) not null,
    haljina varchar(30) not null,
    bojakose varchar(37) not null,
    djevojka int not null
);

create table djevojka(
    sifra int not null primary key auto_increment,
    kratkamajica varchar(45) not null,
    prstena int,
    ekstrovertno boolean not null,
    majica varchar(42) not null,
    introvertno boolean not null,
    svekrva int
);


alter table muskarac add foreign key (neprijatelj) references neprijatelj(sifra);

alter table punac_mladic add foreign key (mladic) references mladic(sifra);
alter table punac_mladic add foreign key (punac) references punac(sifra);

alter table svekrva add foreign key (punac) references punac(sifra);

alter table djevojka add foreign key (svekrva) references svekrva(sifra);

alter table punica add foreign key (djevojka) references djevojka(sifra);


# 1. zadatak

insert into mladic (ogrlica,stilfrizura,drugiputa,hlace)
values
(33,null,'2018-12-04 05:22:47','crvene'),
(33,null,'2019-07-11 06:23:48','crne'),
(33,null,'2015-10-22 07:24:49','zelene');

insert into punac (jmbag,kuna,vesta)
values
(null,159.99,'crna'),
(null,1199.99,'bijela'),
(null,198.99,'zelena');

insert into punac_mladic (punac,mladic)
values
(1,3),
(3,1),
(2,1);

insert into svekrva (narukvica,carape,haljina,punac)
values
(43,'bijele',null,1),
(143,'crvene',null,2),
(423,'crne',null,3);

insert into djevojka (kratkamajica,prstena,ekstrovertno,majica,introvertno,svekrva)
values
('bijela',null,true,'crna',true,null),
('crvena',null,false,'bijela',true,null),
('zelena',null,true,'siva',false,null);

insert into punica (carape,drugiputa,majica,haljina,bojakose,djevojka)
values
('crne',null,'bijela','plava','crvena',1),
('plave',null,'crna','siva','crna',1),
('crvene',null,'zelena','zuta','smeđa',1);


# 2. zadatak

update muskarac set novcica=15.70;


# 3. zadatak

delete from punica where drugiputa='2019-04-08';


# 4. zadatak

select haljina from svekrva where carape like '%ana&';


# 5. zadatak

select a.drugiputa, f.haljina, e.prstena
from mladic a
inner join punac_mladic b on a.sifra=b.mladic
inner join punac c on b.punac=c.sifra
inner join svekrva d on c.sifra=d.punac
inner join djevojka e on d.sifra=e.svekrva
inner join punica f on e.sifra=f.djevojka
where d.carape like 'a%' and c.kuna!=21
order by e.prstena desc;


# 6. zadatak

select a.kuna, a.vesta
from punac a
left join punac_mladic b on a.sifra=b.punac
where b.punac is null;