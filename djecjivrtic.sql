drop database if exists djecjivrtic;
create database djecjivrtic default charset utf8;
use djecjivrtic;

create table odgojna_skupina(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    maksimalnopolaznika int not null,
    datumpocetka datetime not null,
    odgajateljica int,
    dijete int
);

create table odgajateljica(
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    oib char(11),
    iban varchar(50),
    strucna_sprema int not null
);

create table dijete(
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    oib char(11),
    brojugovora varchar(20) not null
);

create table strucna_sprema(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    certificiran boolean not null
);


alter table odgajateljica add foreign key (strucna_sprema) references strucna_sprema(sifra);

alter table odgojna_skupina add foreign key (odgajateljica) references odgajateljica(sifra);
alter table odgojna_skupina add foreign key (dijete) references dijete(sifra);



insert into strucna_sprema (naziv,certificiran)
values
('viša_stručna_sprema',false),
('visoka_stručna_sprema',true);

insert into odgajateljica (ime,prezime,strucna_sprema)
values
('Maja','Vestić',1),
('Vesna','Majić',2);

insert into dijete (ime,prezime,brojugovora)
values
('Matea','Pavić','123456789'),
('Kristijan','Lovrić','987654321');

insert into odgojna_skupina (naziv,maksimalnopolaznika,datumpocetka,odgajateljica,dijete)
values
('OS1',20,'2022-09-05 08:00:00',1,2),
('OS2',18,'2022-01-05 10:00:00',2,1);