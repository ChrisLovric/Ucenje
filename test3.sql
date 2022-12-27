drop database if exists test2;
create database test2 default charset utf8;
use test2;

create table zupanija(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    zupan int not null
);

create table opcina(
    sifra int not null primary key auto_increment,
    zupanija int not null,
    naziv varchar(50) not null
);

create table zupan(
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null
);

create table grad(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    opcina int not null
);



insert into opcina (zupanija,naziv)
values
(1,'Osijek'),
(1,'Đakovo'),
(2,'Vukovar'),
(3,'Zagreb');



insert into zupanija (naziv,zupan)
values
('osjecko-baranjska',1),
('vukovarsko-srijemska',1),
('grad-zagreb',2);

insert into zupan (ime,prezime)
values
('Mato','Marković'),
('Josip','Ormar');


insert into grad (naziv,opcina)
values
('Đakovo',2),
('Osijek',1),
('Vukovar',3);

alter table opcina add foreign key (zupanija) references zupanija(sifra);

alter table zupanija add foreign key (zupan) references zupan(sifra);

alter table grad add foreign key (opcina) references opcina(sifra);