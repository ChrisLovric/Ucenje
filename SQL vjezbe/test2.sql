drop database if exists test2;
create database test2 default charset utf8;
use test2;

create table zupanija(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null
);

create table opcina(
    sifra int not null primary key auto_increment,
    zupanija int not null,
    naziv varchar(50) not null
);



insert into opcina (zupanija,naziv)
values
(1,'Osijek'),
(1,'Briješće'),
(2,'Vukovar'),
(3,'Zagreb');



insert into zupanija (naziv)
values
('osjecko-baranjska'),
('vukovarsko-srijemska'),
('grad-zagreb');


alter table opcina add foreign key (zupanija) references zupanija(sifra);