drop database if exists kolokvij10;
create database kolokvij10 default charset utf8;
use kolokvij10;

create table zarucnica(
    sifra int not null primary key auto_increment,
    treciputa datetime,
    prviputa datetime,
    suknja varchar(32) not null,
    eura decimal (16,10)
);

create table sestra(
    sifra int not null primary key auto_increment,
    suknja varchar(46) not null,
    bojaociju varchar(49),
    indiferentno boolean,
    dukserica varchar(32) not null,
    drugiputa datetime,
    prviputa datetime not null,
    zarucnica int
);

create table neprijatelj(
    sifra int not null primary key auto_increment,
    gustoca decimal(15,10) not null,
    dukserica varchar(32) not null,
    maraka decimal(15,7),
    stilfrizura varchar(49) not null
);

create table punac_neprijatelj(
    sifra int not null primary key auto_increment,
    punac int not null,
    neprijatelj int not null
);

create table punac(
    sifra int not null primary key auto_increment,
    lipa decimal(15,9),
    eura decimal(15,10) not null,
    stilfrizura varchar(37)
);

create table svekrva(
    sifra int not null primary key auto_increment,
    eura decimal(17,9),
    carape varchar(43),
    kuna decimal(13,9),
    majica varchar(30),
    introvertno boolean not null,
    punac int
);

create table mladic(
    sifra int not null primary key auto_increment,
    hlace varchar(48) not null,
    lipa decimal(18,6),
    stilfrizura varchar(35) not null,
    prstena int,
    maraka decimal(12,6) not null,
    svekrva int
);

create table zena(
    sifra int not null primary key auto_increment,
    bojaociju varchar(49) not null,
    maraka decimal(13,9) not null,
    majica varchar(45),
    indiferentno boolean,
    prviputa datetime,
    mladic int
);


alter table sestra add foreign key (zarucnica) references zarucnica(sifra);

alter table punac_neprijatelj add foreign key (neprijatelj) references neprijatelj(sifra);
alter table punac_neprijatelj add foreign key (punac) references punac(sifra);

alter table svekrva add foreign key (punac) references punac(sifra);

alter table mladic add foreign key (svekrva) references svekrva(sifra);

alter table zena add foreign key (mladic) references mladic(sifra);


# 1. zadatak

insert into neprijatelj (gustoca,dukserica,maraka,stilfrizura)
values
(15.10,'crna',null,'frizura01'),
(10.51,'crvena',null,'frizura02'),
(159.99,'bijela',null,'frizura03');

insert into punac (lipa,eura,stilfrizura)
values
(null,15.99,null),
(null,99.99,null),
(null,98.99,null);

insert into punac_neprijatelj (punac,neprijatelj)
values
(1,2),
(2,1),
(3,2);

insert into svekrva (eura,carape,kuna,majica,introvertno,punac)
values
(null,null,null,null,true,null),
(null,null,null,null,false,null),
(null,null,null,null,true,null);

insert into mladic (hlace,lipa,stilfrizura,prstena,maraka,svekrva)
values
('crne',null,'frizura01',null,12.60,null),
('bijele',null,'frizura02',null,112.80,null),
('smeđe',null,'frizura03',null,1226.78,null);

insert into zena (bojaociju,maraka,majica,indiferentno,prviputa,mladic)
values
('zelena',13.99,null,null,null,null),
('crvena',313.99,null,null,null,null),
('plava',113.99,null,null,null,null);


# 2. zadatak

update sestra set bojaociju='Osijek';


# 3. zadatak

delete from zena where maraka!=14.81;


# 4. zadatak

select kuna from svekrva where carape like '%ana&';


# 5. zadatak

select a.maraka, f.indiferentno, e.lipa
from neprijatelj a
inner join punac_neprijatelj b on a.sifra=b.neprijatelj
inner join punac c on b.punac=c.sifra
inner join svekrva d on c.sifra=d.punac
inner join mladic e on d.sifra=e.svekrva
inner join zena f on e.sifra=f.mladic
where d.carape like 'a%' and c.eura!=22
order by e.lipa desc;


# 6. zadatak

select a.eura, a.stilfrizura
from punac a
left join punac_neprijatelj b on a.sifra=b.punac
where b.punac is null;