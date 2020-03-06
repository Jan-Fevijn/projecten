drop database if exists project1;

create database if not exists project1;

use project1;

create table if not exists typeVerrichting(
 idtypeVerrichting int not null,
 omschrijving varchar(45) not null,
 primary key (idtypeVerrichting)
);

create table if not exists verrichting(
idverrichting int not null auto_increment,
bedrag decimal(8,2) not null,
datum date not null,
idtypeVerrichting int not null,
idpersoon int not null default 1,
primary key (idVerrichting)
);

alter table verrichting
add constraint FK_typeverrichting
foreign key (idtypeVerrichting) references typeVerrichting(idtypeVerrichting)
on delete no action
on update no action;

insert into typeVerrichting (idtypeVerrichting, omschrijving) values (1101,"voeding");
insert into verrichting (bedrag, datum, idtypeVerrichting) values (10.5,'2020-10-10',1101);

create table if not exists persoon (
idpersoon int not null auto_increment,
naam varchar(45) not null,
voornaam varchar(45) not null,
email varchar(60) not null,
isAdmin int not null default 0,
wachtwoord varchar(45) ,
primary key (idpersoon)
);

insert into persoon (naam, voornaam, email,wachtwoord) values ("De Kesel","Hannes","hannes.de.kesel@atheneumjanfevijn.be","123");

alter table verrichting
add constraint FK_persoon
Foreign key (idpersoon) references persoon(idpersoon);

create view alleInfoVerrichtingen as 
select bedrag , datum , persoon.idpersoon , omschrijving , naam , voornaam from (verrichting
join typeverrichting on typeverrichting.idtypeverrichting = verrichting.idtypeverrichting)
join persoon on persoon.idpersoon = verrichting.idpersoon
;

CREATE  OR REPLACE VIEW `typeinkomsten` AS SELECT * FROM project1.typeverrichting where idtypeVerrichting < 2000;
CREATE  OR REPLACE VIEW `typeuitgaven` AS SELECT * FROM project1.typeverrichting where idtypeVerrichting > 1000;