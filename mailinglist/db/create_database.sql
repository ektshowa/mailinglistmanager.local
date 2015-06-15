CREATE DATABASE mailinglistmanager_db;

use mailinglistmanager_db;

CREATE TABLE IF NOT EXISTS lists
(
   id int auto_increment not null primary key,
   listname varchar(20) not null,
   description varchar(255)
);

create table if not exists roles
(
  id int auto_increment not null primary key,
  code varchar(10),
  description varchar(100)
) ENGINE=InnoDB;


create table if not exists users
(
  id int auto_increment not null primary key,
  email varchar(100),
  firstname varchar(100),
  lastname varchar(100),
  addressline1 varchar(100),
  addressline2 varchar(100),
  city varchar(100),
  state varchar(50),
  zipcode varchar(11),
  country varchar(100),	
  mimetype varchar(1),
  roleid int,
  password varchar(70),
  index (roleid),
  foreign key (roleid) references roles(id)
)  ENGINE=InnoDB;

# stores a relationship between a users and a list 
create table user_lists
(
  id int auto_increment not null primary key,
  userid int,
  listid int,
  index (userid),
  index (listid),
  foreign key (userid) references users(id), 
  foreign key (listid) references lists(id)
) ENGINE=InnoDB;

create table if not exists mail
(
  id int auto_increment not null primary key, 
  email varchar(100),
  subject varchar(100),
  listid int,
  status char(10),
  sent datetime,
  modified timestamp,
  index listid(listid),
  foreign key (listid) references lists(id)
) ENGINE=InnoDB;

#stores the images that go with a particular mail
create table if not exists images
(
  id int auto_increment not null primary key, 
  mailid int,
  filepath char(100),
  mimetype varchar(100),
  index mailid(mailid),
  foreign key (mailid) references mail(id)
) ENGINE=InnoDB;

grant select, insert, update, delete
on mailinglistmanager_db.*
to mlm@localhost identified by 'admin';

insert into roles (code, description) values
('admin', 'Application Administrator');
insert into roles (code, description) values
('regular', 'Regular User');

insert into users (email, firstname, lastname, mimetype, password, roleId) values
('mlm@localhost', 'Mailtestfirst', 'Mailtestlast', 'H', sha1('mlm'), 1);

insert into users (email, firstname, lastname, mimetype, password, roleId) values
('admin@localhost', 'Adminfirst', 'Adminlast', 'H', sha1('admin'), 1);

insert into users (email, firstname, lastname, mimetype, password, roleId) values
('laura_xt@optusnet.com.au', 'Laurafirst', 'Lauralast', 'H', sha1('laura'), 1);

