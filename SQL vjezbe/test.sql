drop database if exists test;
create database test default charset utf8;
use test;

create table zupanija(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    zupan int
);

create table zupan(
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null
);

create table opcina(
    sifra int not null primary key auto_increment,
    zupanija int,
    naziv varchar(50) not null
);

create table mjesto(
    sifra int not null primary key auto_increment,
    opcina int,
    naziv varchar(50) not null  
);

alter table zupanija add foreign key (zupan) references zupan(sifra);

alter table opcina add foreign key (zupanija) references zupanija(sifra);

alter table mjesto add foreign key (opcina) references opcina(sifra);

insert into zupanija (sifra,naziv,zupan)
values
(null,'osjecko-baranjska',null),
(null,'vukovarsko-srijemska',null),
(null,'grad-zagreb',null);

insert into zupan (ime,prezime)
values
('Marko','Marković'),
('Pero','Peroć'),
('Mate','Matić');

insert into mjesto (naziv)
values
('Piškorevci'),
('Đakovo'),
('Osijek'),
('Brijest'),
('Briješće'),
('Višnjevac');

insert into opcina (zupanija,naziv)
values
(null,'Đakovo'),
(null,'Osijek'),
(null,'Otok'),
(null,'Grad Zagreb');