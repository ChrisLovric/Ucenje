drop database if exists kolokvij2;
create database kolokvij2 default charset utf8;
use kolokvij2;

create table decko(
    sifra int not null primary key auto_increment,
    indiferentno boolean,
    vesta varchar(34),
    asocijalno boolean not null
);

create table decko_zarucnica(
    sifra int not null primary key auto_increment,
    decko int not null,
    zarucnica int not null
);

create table zarucnica(
    sifra int not null primary key auto_increment,
    narukvica int,
    bojakose varchar(37) not null,
    novcica decimal(15,9),
    lipa decimal(15,8) not null,
    indiferentno boolean not null
);

create table cura(
    sifra int not null primary key auto_increment,
    haljina varchar(33) not null,
    drugiputa datetime not null,
    suknja varchar(38),
    narukvica int,
    introvertno boolean,
    majica varchar(40) not null,
    decko int
);

create table neprijatelj(
    sifra int not null primary key auto_increment,
    majica varchar(32),
    haljina varchar(43) not null,
    lipa decimal(16,8),
    modelnaocala varchar(49) not null,
    kuna decimal(12,6) not null,
    jmbag char(11),
    cura int
);

create table brat(
    sifra int not null primary key auto_increment,
    suknja varchar(47),
    ogrlica int not null,
    asocijalno boolean not null,
    neprijatelj int not null
);

create table prijatelj(
    sifra int not null primary key auto_increment,
    modelnaocala varchar(37),
    treciputa datetime not null,
    ekstrovertno boolean not null,
    prviputa datetime,
    svekar int not null
);

create table svekar(
    sifra int not null primary key auto_increment,
    stilfrizura varchar(48),
    ogrlica int not null,
    asocijalno boolean not null
);



alter table cura add foreign key (decko) references decko(sifra);
alter table decko_zarucnica add foreign key (decko) references decko(sifra);
alter table decko_zarucnica add foreign key (zarucnica) references zarucnica(sifra);

alter table neprijatelj add foreign key (cura) references cura(sifra);

alter table brat add foreign key (neprijatelj) references neprijatelj(sifra);

alter table prijatelj add foreign key (svekar) references svekar(sifra);

# 1. zadatak
insert into neprijatelj (majica,haljina,lipa,modelnaocala,kuna,jmbag,cura)
values
(null,'crvena',null,'aviator',555.55,null,null),
(null,'plava',null,'aviator',1825.45,null,null),
(null,'zelena',null,'aviator',12.57,null,null);


insert into cura (haljina,drugiputa,suknja,narukvica,introvertno,majica,decko)
values
('ljubicasta','2022-10-05 15:00:00',null,null,null,'crna',null),
('crvena','2021-12-12 12:15:00',null,null,null,'zelena',null),
('plava','2020-01-04 09:30:00',null,null,null,'zuta',null);

insert into decko (indiferentno,vesta,asocijalno)
values
(null,null,true),
(null,null,false),
(null,null,true);

insert into zarucnica (narukvica,bojakose,novcica,lipa,indiferentno)
values
(null,'plava',null,15.55,true),
(null,'crvena',null,110.99,false),
(null,'crna',null,99.98,false);

insert into decko_zarucnica (decko,zarucnica)
values
(1,1),
(2,2),
(3,3);

insert into svekar (stilfrizura,ogrlica,asocijalno)
values
(null,118,true),
(null,12,false),
(null,10,false);


# 2. zadatak
insert into prijatelj (treciputa,svekar)
values ('2020-04-30',1);



# 3. zadatak
delete from brat where ogrlica!=14;


# 4. zadatak
select suknja from cura where drugiputa is null;


# 5. zadatak
select a.novcica, f.neprijatelj, e.haljina
from zarucnica a
inner join decko_zarucnica b on a.sifra=b.zarucnica
inner join decko c on b.decko=c.sifra
inner join cura d on c.sifra=d.decko
inner join neprijatelj e on d.sifra=e.cura
inner join brat f on e.sifra=f.neprijatelj
where d.drugiputa is not null and c.vesta like '%ba%'
order by e.haljina desc;


# 6. zadatak
select a.vesta, a.asocijalno
from decko a
left join decko_zarucnica b on a.sifra=b.decko
where b.decko is null;