CREATE DATABASE IF NOT EXISTS blog;

CREATE USER 'blog_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON blog.* TO 'blog_user'@'localhost';
FLUSH PRIVILEGES;

USE blog;

CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT not null,
    name varchar(100) not null,
    email varchar(255) not null,
    password varchar(40) not null,
    register_date DATETIME not null,
    activo TINYINT NOT NULL,
    primary key(id)
);

INSERT INTO users (name, email, password, register_date, activo) VALUES
    ("Abel", "abeljru16@correo.com", "1234", "2024-09-11 17:10:45", 1);