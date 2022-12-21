-- **************************************************************************************************************
create database defensoriadb;
use defensoriadb;
-- **************************************************************************************************************


-- **************************************************************************************************************
-- creacion de la tabla empleados
create table empleados (id_empleado int not null auto_increment,nombre_empleado VARCHAR(30),apellido_empleado VARCHAR(20),usuario_empleado varchar(50),dni_empleado VARCHAR(8),activo_empleado tinyint default 1,telefono_empleado VARCHAR(15),rol int(1),
primary key(id_empleado));
-- fin de la tabla empleados
-- roles 1 = admin 2 - empleadovich - 3 - alerta temprana 
-- **************************************************************************************************************

-- **************************************************************************************************************
-- carga de la tabla empleados

insert into empleados (nombre_empleado,apellido_empleado,usuario_empleado,dni_empleado,telefono_empleado) VALUES ('Esteban','Trejo','Esteban Trejo','41093919','3855904107');

-- fin de la carga empleados
-- **************************************************************************************************************

-- **************************************************************************************************************
-- creacion de la tabla puntos monitoreo
Create table Puntos_monitoreo(id_puntomonitoreo int auto_increment not null,nombre_puntomonitoreo varchar(50) not null,coordenadas float,
primary key(id_puntomonitoreo)); 
-- fin de la puntos monitoreo
-- **************************************************************************************************************

-- **************************************************************************************************************
-- carga de la tabla puntos monitoreo
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Aguas Blancas");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Rio Mistai");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Arroyo del Estero");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Rio Chico");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Rio Colorado");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Cuenco");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Rio Gastona");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Rio Graneros");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Matazambi");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Murallon");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Rio Sali");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Rio Seco");
insert into puntos_monitoreo (nombre_puntomonitoreo) values ("Troncal");  
 
 
-- fin de la carga puntos monitoreo
-- **************************************************************************************************************

-- **************************************************************************************************************
-- creacion de la tabla mediciones
create table mediciones (id_medicion int not null auto_increment,nombre_empleado varchar(30) not null,nombre_puntomonitoreo varchar(50) not null,fecha date,hora time,
temperatura float,
ph float,
phmv float,
orpmv float,
mscm float,
ntu float,
mgldo float,
gltds float,
ppt float,
densidad float,
observaciones text,
-- campos extras


primary key (id_medicion));
-- foreign key(id_puntomonitoreo) references Puntos_monitoreo(id_puntomonitoreo),
-- foreign key(id_empleado) references empleados(id_empleado));
-- fin de la tabla empleados
-- **************************************************************************************************************

-- creacion de la tabla mediciones
-- **************************************************************************************************************
Create table ingenios(id_ing int not null auto_increment, Nombre_ing Varchar(50) not null);
-- **************************************************************************************************************
-- fin de la tabla mediciones

-- creacion de la tabla alerta temprana



-- carga de la tabla ingenios
-- **************************************************************************************************************
insert into ingenios(Nombre_ing) VALUES ("Ingenio Marapa");
insert into ingenios(Nombre_ing) VALUES (" Plantan Cloacal los GUayacanes");
insert into ingenios(Nombre_ing) VALUES ("Ing Santa Barbara");
insert into ingenios(Nombre_ing) VALUES ("Ingenio Trinidad");
insert into ingenios(Nombre_ing) VALUES ("Ingenio Aguilares");
-- **************************************************************************************************************
-- fin de la tabla ingenios
