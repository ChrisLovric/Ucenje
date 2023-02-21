drop database if exists drzava;
create database drzava;
use drzava;

create table zupanija(
    sifra int not null primary key auto_increment,
    naziv varchar(50),
    zupan varchar(50)
);

create table opcina(
    sifra int not null primary key auto_increment,
    naziv varchar(50),
    zupanija int
);

alter table opcina add foreign key (zupanija) references zupanija(sifra);
