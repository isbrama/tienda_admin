CREATE DATABASE stjean_DB;
USE stjean_DB;

CREATE TABLE users(
id            int(255) auto_increment not null,
name          varchar(100) not null,
email         varchar(255) not null,
password      varchar(255) not null,
rol           varchar(20),
image         varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'Admin', 'admin@admin.com', 'password', 'admin', null);

CREATE TABLE category(
id              int(255) auto_increment not null,
name          varchar(100) not null,
CONSTRAINT pk_category PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO category VALUES(null, 'Manga corta');
INSERT INTO category VALUES(null, 'Tirantes');
INSERT INTO category VALUES(null, 'Manga larga');
INSERT INTO category VALUES(null, 'Sudaderas');

CREATE TABLE products(
id              int(255) auto_increment not null,
category_id    int(255) not null,
name          varchar(100) not null,
description     text,
price          float(100,2) not null,
stock           int(255) not null,
date           date not null,
image          varchar(255),
CONSTRAINT pk_category PRIMARY KEY(id),
CONSTRAINT fk_product_category FOREIGN KEY(category_id) REFERENCES category(id)
)ENGINE=InnoDb;


CREATE TABLE orders(
id              int(255) auto_increment not null,
users_id      int(255) not null,
cost           float(200,2) not null,
status          varchar(20) not null,
date          date,
hour            time,
CONSTRAINT pk_orders PRIMARY KEY(id),
CONSTRAINT fk_orders_users FOREIGN KEY(users_id) REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE line_orders(
id              int(255) auto_increment not null,
orders_id       int(255) not null,
products_id     int(255) not null,
units        int(255) not null,
CONSTRAINT pk_line_orders PRIMARY KEY(id),
CONSTRAINT fk_line_orders FOREIGN KEY(orders_id) REFERENCES orders(id),
CONSTRAINT fk_line_products FOREIGN KEY(products_id) REFERENCES products(id)
)ENGINE=InnoDb;
