create database if not exists perfilp;
use perfilp;

create table datosp(
    id int unsigned not null auto_increment primary key,
    titularcnta varchar(40) not null,
    email varchar(255) not null unique,
	password varchar(60) not null,
	rol varchar(30) default 'user' references roles(name)
		on update cascade 
		on delete set null,
	avatar int unsigned references files(id) 
		on delete set null,
	banned boolean not null default false,
	creation datetime not null default current_timestamp
);