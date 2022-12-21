-- **************************************************************************************************************
create database defensoriadb;
use defensoriadb;
-- **************************************************************************************************************


-- **************************************************************************************************************
-- creacion de la tabla empleados
create table empleados (id_empleado int not null auto_increment,nombre_empleado VARCHAR(30),apellido_empleado VARCHAR(20),usuario_empleado varchar(50),dni_empleado VARCHAR(8),activo_empleado tinyint default 1,telefono_empleado VARCHAR(15),rol varchar(15),
primary key(id_empleado,dni_empleado));
-- fin de la tabla empleados
-- roles 1 = admin 2 - empleado - 3 - alerta temprana 
-- **************************************************************************************************************

create table roles (nombre_rol varchar(20) primary key);
insert into roles VALUES ('administrador');
insert into roles VALUES ('empleado');
insert into roles VALUES ('alerta temprana');

create table estados (id_estado tinyint, nombre_estado varchar(20) primary key);
insert into estados VALUES (1,'activo');
insert into estados VALUES (2,'inactivo');


-- **************************************************************************************************************
-- carga de la tabla empleados

insert into empleados (nombre_empleado,apellido_empleado,usuario_empleado,dni_empleado,telefono_empleado,rol) VALUES ('Esteban','Trejo','Esteban Trejo','41093919','3855904107','administrador');
insert into empleados (nombre_empleado,apellido_empleado,usuario_empleado,dni_empleado,telefono_empleado,rol) VALUES ('Nicolas','Herrera','Nicolas Herrera','123456','3855904108','empleado');
insert into empleados (nombre_empleado,apellido_empleado,usuario_empleado,dni_empleado,telefono_empleado,rol) VALUES ('Marcela','Santillan','Marcela Santillan','12345','3855904107','alerta temprana');
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

-- creacion de la tabla puntos monitoreo
Create table Puntos_monitoreo_alerta(id_puntomonitoreo int auto_increment not null,nombre_puntomonitoreo varchar(50) not null,coordenadas float,
primary key(id_puntomonitoreo)); 
-- fin de la puntos monitoreo
-- **************************************************************************************************************

-- **************************************************************************************************************
-- carga de la tabla puntos monitoreo
insert into puntos_monitoreo_alerta (nombre_puntomonitoreo) values ("Rio Km 44");
insert into puntos_monitoreo_alerta (nombre_puntomonitoreo) values ("Rio Marlogrado"); 

SELECT * FROM puntos_monitoreo_alerta;
 
 
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
-- los campos extras son:
lluvia varchar(3),
basura varchar(3),
basura200m varchar(3),
personascerca varchar(3),
animalescerca varchar(3),
viento varchar(5),
caudal varchar(5),
otros varchar(200),


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
