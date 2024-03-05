CREATE table personel (
id int not null unique auto_increment,
AM int (6) not null,
name varchar(20) not null,
surname varchar(35) not null,
ep_id int not null, 
epistasia varchar(40) not null,
s_id int not null,
section varchar(40) not null, 
telephone int(10),
mobile int(10),
address varchar(255),
city varchar(20),
password varchar(8) not null,
role_id int(1) not null,
role_name varchar(20) not null,
rank_id int(2) not null,
rank_name varchar(20)
) CHARACTER SET utf8;

INSERT INTO `personel`(`id`, `AM`, `name`, `surname`, `ep_id`, `epistasia`, `s_id`, `section`, `telephone`, `mobile`, `address`, `city`, `password`, `role_id`, `role_name`, `rank_id`, `rank_name`) VALUES ('1','67045','ΔΗΜΗΤΡΙΟΣ','ΓΕΡΟΝΤΟΠΟΥΛΟΣ','1','ΔΕΕ','4','ΤΜ.ΠΡΟΓΡ.ΑΕΡ.','5414','6983523059','ΣΤΕΝΗΜΑΧΟΥ 3','ΛΑΡΙΣΑ','1234','1','admin','9','ΥΠΣΓΟΣ');

