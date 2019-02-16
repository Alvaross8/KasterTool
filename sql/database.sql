CREATE DATABASE IF NOT EXISTS KasterTool_db;
USE KasterTool_db;

/*CREACION DE LAS TABLAS*/
CREATE TABLE IF NOT EXISTS  KasterTool_db.USUARIOS(
Nombre varchar(50) NOT NULL,
Apellidos varchar(50) NOT NULL,
Email varchar(50) NOT NULL,
Contrasenna varchar(50) NOT NULL,
Dni varchar(50) NOT NULL,
Direccion varchar(50) NOT NULL,
Codigo_Postal int(5) NOT NULL
);

CREATE TABLE IF NOT EXISTS  KasterTool_db.PRODUCTOS(
Id_producto int NOT NULL AUTO_INCREMENT,
Nombre varchar(50) NOT NULL,
Descripcion varchar(300) NOT NULL,
Precio_Producto float(5,2) NOT NULL,
Tipo varchar(50) NOT NULL,
Marca varchar(50) NOT NULL,
Imagen varchar(100) NOT NULL,
Existencias int(5) NOT NULL,
PRIMARY KEY (Id_producto)
);

CREATE TABLE IF NOT EXISTS KasterTool_db.PEDIDOS(
Numero_pedido int NOT NULL AUTO_INCREMENT,
Email varchar(50) NOT NULL,
Id_producto int(10) NOT NULL,
Cantidad int(10) NOT NULL,
Precio_producto float(5,2) NOT NULL,
Precio_total float(10,2) NOT NULL,
Fecha varchar(50) NOT NULL,
PRIMARY KEY (Numero_pedido)
);



CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'P@ssw0rd';
GRANT ALL PRIVILEGES ON KasterTool_db.USUARIOS TO 'admin'@'localhost';
GRANT ALL PRIVILEGES ON KasterTool_db.PEDIDOS TO 'admin'@'localhost';
GRANT ALL PRIVILEGES ON KasterTool_db.PRODUCTOS TO 'admin'@'localhost';


CREATE USER IF NOT EXISTS 'alvaro'@'localhost' IDENTIFIED BY '1234';



INSERT INTO USUARIOS VALUES ('admin', 'admin', 'admin@gmail.com', 'P@ssw0rd', '12345678D', 'av/ la mia', 28970);
INSERT INTO USUARIOS VALUES ('alvaro', 'sanchez sanchez', 'alvaro@gmail.com', '1234', '12345678J', 'av/ la mia', 28970);



INSERT INTO PRODUCTOS (Nombre, Descripcion, Precio_Producto, Tipo, Marca, Imagen, Existencias) VALUES ('SOBREMESA1', 'PRIMER PRODUCTO SOBREMESA', 800, 'SOBREMESA', 'HP', '../images/SobreMesa1.jpg', 20);
INSERT INTO PRODUCTOS (Nombre, Descripcion, Precio_Producto, Tipo, Marca, Imagen, Existencias) VALUES ('SOBREMESA2', 'PRIMER PRODUCTO SOBREMESA2', 850, 'SOBREMESA', 'HP', '../images/SobreMesa2.jpg', 10);
INSERT INTO PRODUCTOS (Nombre, Descripcion, Precio_Producto, Tipo, Marca, Imagen, Existencias) VALUES ('SOBREMESA3', 'PRIMER PRODUCTO SOBREMESA3', 200, 'SOBREMESA', 'HP', '../images/SobreMesa3.jpg', 80);
