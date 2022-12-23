drop database if exists muzej;
create database muzej default charset utf8;
use muzej;

create table izlozba(
    sifra int not null primary key auto_increment,
    naziv varchar(50),
    djelo int,
    kustos int,
    sponzor int
);

create table kustos(
    sifra int not null primary key auto_increment,
    ime varchar(50),
    prezime varchar(50),
    oib char(11),
    iban varchar(20)
);

create table djelo(
    sifra int not null primary key auto_increment,
    naziv varchar(50),
    brojdjela int
);

create table sponzor(
    sifra int not null primary key auto_increment,
    naziv varchar(50)
);

alter table izlozba add foreign key (djelo) references djelo(sifra);
alter table izlozba add foreign key (kustos) references kustos(sifra);
alter table izlozba add foreign key (sponzor) references sponzor(sifra);

insert into djelo (naziv,brojdjela)
values
('monaliza',1),
('lizamona',2),
('vangogovodjelo',3),
('mocart',4);

insert into kustos (ime,prezime)
values
('Mato','Marić'),
('Pero','Perić');

insert into sponzor (naziv)
values
('Agrokor'),
('Konzum');