drop database if exists kolokvij4;
create database kolokvij4 default charset utf8;
use kolokvij4;

create table ostavljen(
    sifra int not null primary key auto_increment,
    modelnaocala varchar(43),
    introvertno boolean,
    kuna decimal(14,10)
);

create table punac(
    sifra int not null primary key auto_increment,
    treciputa datetime,
    majica varchar(46),
    jmbag char(11) not null,
    novcica decimal(18,7) not null,
    maraka decimal(12,6) not null,
    ostavljen int not null
);

create table mladic(
    sifra int not null primary key auto_increment,
    kuna decimal(15,9),
    lipa decimal(18,5),
    nausnica int,
    stilfrizura varchar(49),
    vesta varchar(34) not null
);

create table zena_mladic(
    sifra int not null primary key auto_increment,
    zena int not null,
    mladic int not null
);

create table zena(
    sifra int not null primary key auto_increment,
    suknja varchar(39) not null,
    lipa decimal(18,7),
    prstena int not null
);

create table snasa(
    sifra int not null primary key auto_increment,
    introvertno boolean,
    treciputa datetime,
    haljina varchar(44) not null,
    zena int not null
);

create table becar(
    sifra int not null primary key auto_increment,
    novcica decimal(14,8),
    kratkamajica varchar(48) not null,
    bojaociju varchar(36) not null,
    snasa int not null
);

create table prijatelj(
    sifra int not null primary key auto_increment,
    eura decimal(16,8),
    prstena int not null,
    gustoca decimal(16,5),
    jmbag char(11) not null,
    suknja varchar(47) not null,
    becar int not null
);


alter table punac add foreign key (ostavljen) references ostavljen(sifra);

alter table zena_mladic add foreign key (mladic) references mladic(sifra);
alter table zena_mladic add foreign key (zena) references zena(sifra);

alter table snasa add foreign key (zena) references zena(sifra);

alter table becar add foreign key (snasa) references snasa(sifra);

alter table prijatelj add foreign key (becar) references becar(sifra);


# 1. zadatak
insert into mladic (kuna,lipa,nausnica,stilfrizura,vesta)
values
(null,null,null,null,'crna'),
(null,null,null,null,'plava'),
(null,null,null,null,'crvena');

insert into zena (suknja,lipa,prstena)
values
('crna',null,12),
('crvena',null,55),
('plava',null,180);

insert into zena_mladic (zena,mladic)
values
(1,2),
(2,3),
(3,1);

insert into snasa (introvertno,treciputa,haljina,zena)
values
(null,null,'crvena',1),
(null,null,'plava',2),
(null,null,'zelena',3);

insert into becar (novcica,kratkamajica,bojaociju,snasa)
values
(null,'bijela','plava',1),
(null,'crvena','zelena',2),
(null,'crna','smedja',3);

insert into prijatelj (eura,prstena,gustoca,jmbag,suknja,becar)
values
(null,13,null,98564123549,'crna',1),
(null,65,null,45785412548,'crvena',2),
(null,98,null,45786523145,'plava',3);



# 2. zadatak
update punac set majica='Osijek';


# 3. zadatak
delete from prijatelj where prstena>17;


# 4. zadatak
select haljina from snasa where treciputa is null;


# 5. zadatak
select a.nausnica, f.jmbag, e.kratkamajica
from mladic a
inner join zena_mladic b on a.sifra=b.mladic
inner join zena c on b.zena=c.sifra
inner join snasa d on c.sifra=d.zena
inner join becar e on d.sifra=e.snasa
inner join prijatelj f on e.sifra=f.becar
where d.treciputa is not null and c.lipa!=29
order by e.kratkamajica desc;


# 6. zadatak
select a.lipa, a.prstena
from zena a
left join zena_mladic b on a.sifra=b.zena
where b.zena is null;