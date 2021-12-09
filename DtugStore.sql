create database drugstore;
use drugstore;
drop database drugstore;
create table users(
userID varchar(255) not null,
firstname varchar(255),
lastname varchar(255),
username varchar(100),
gender enum("Male","Female"),
email_address varchar(225),
status enum('a','u'),
password varchar(255),
primary key(userID)
);

drop table drug;
create table drug(
ID int(11) auto_increment not null,
Drugcode text,
Drugname text,
Unit_per_Price varchar(100),
Price double,
Level_precibing varchar(3),
status text,
primary key(ID)

);
Alter table drug add fulltext(Drugname);

create table sold(
ID int(11) auto_increment not null,
drugcode text,
drugname text,
numberItems int,
unitryPrice decimal(10),
sellingPrice decimal(10),
saledate datetime,
soldBy varchar(255) not null,
primary key(ID),
foreign key(ID) references drug(ID),
foreign key(soldBy) references users(userID)
);
create table sale(
ID int auto_increment not null,
Drugcode char(13) not null,
drugname varchar(100),
numberItems int,
unitryPrice decimal(10),
sellingPrice decimal(10),
saledate datetime,
soldBy varchar(255) not null,
primary key(ID),
foreign key(barcode) references drug(barcodeID),
foreign key(soldBy) references users(userID)
);
drop table inventorytake;
create table inventorytake (
ID int auto_increment not null,
Drugcode text,
Drugname text,
prescribe_type text,
soldnumber int,
unit_price double,
sellingPrice double,
datetaken text,
status enum("t","f"),
primary key(ID)
);
