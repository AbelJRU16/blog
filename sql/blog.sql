CREATE DATABASE IF NOT EXISTS blog;

CREATE USER 'blog_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON blog.* TO 'blog_user'@'localhost';
FLUSH PRIVILEGES;

USE blog;

CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT not null,
    name varchar(100) not null unique,
    email varchar(255) not null unique,
    password varchar(255) not null,
    register_date DATETIME not null,
    activo TINYINT NOT NULL,
    primary key(id)
);

CREATE TABLE IF NOT EXISTS entrys(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    author_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT CHARACTER SET utf8 NOT NULL,
    fecha DATETIME,
    active TINYINT NOT NULL,
    primary key(id),
    FOREIGN key(author_id) 
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS comments(
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    author_id INT NOT NULL,
    entry_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT CHARACTER SET utf8 NOT NULL,
    fecha DATETIME,
    primary key(id),
    FOREIGN key(author_id) 
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,        
    FOREIGN key(entry_id) 
        REFERENCES entrys(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);
