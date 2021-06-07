/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  csaba
 * Created: Jun 4, 2021
 */

CREATE TABLE libraries
(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(500) NOT NULL,
    description TEXT DEFAULT NULL,
    active TINYINT DEFAULT 1,
    
    CONSTRAINT PK_libraries PRIMARY KEY(id)
);

CREATE TABLE buildings
(
    id INT NOT NULL AUTO_INCREMENT,
    library_id INT NOT NULL,
    kod VARCHAR(5) NOT NULL,
    name VARCHAR(500) NOT NULL,
    description TEXT DEFAULT NULL,
    active TINYINT DEFAULT 1,
    
    CONSTRAINT PK_buildings PRIMARY KEY(id),
    CONSTRAINT FK_buildings_library_id FOREIGN KEY (library_id) REFERENCES libraries(id),
    CONSTRAINT UQ_buildings_library_id_kod UNIQUE (library_id, kod)
);

CREATE TABLE books
(
    id INT NOT NULL AUTO_INCREMENT,
    buildings_id INT NOT NULL,
    booknumber VARCHAR(5) NOT NULL,
    name VARCHAR(500) NOT NULL,
    description TEXT DEFAULT NULL,
    active TINYINT DEFAULT 1,
    
    CONSTRAINT PK_books PRIMARY KEY(id),
    CONSTRAINT FK_books_buildings_id FOREIGN KEY (buildings_id) REFERENCES buildings(id),
    CONSTRAINT UQ_books_buildings_id_booknumber UNIQUE (buildings_id, booknumber)
);

CREATE TABLE catalogs
(
    id INT NOT NULL AUTO_INCREMENT,
    books_id INT NOT NULL,
    catalognumber VARCHAR(5) NOT NULL,
    name VARCHAR(500) NOT NULL,
    description TEXT DEFAULT NULL,
    active TINYINT DEFAULT 1,
    
    CONSTRAINT PK_catalogs PRIMARY KEY(id),
    CONSTRAINT FK_catalogs_books_id FOREIGN KEY (books_id) REFERENCES books(id),
    CONSTRAINT UQ_catalogs_books_id_catalognumber UNIQUE (books_id, catalognumber)
);

CREATE TABLE `files` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `created` datetime NOT NULL,
 `modified` datetime NOT NULL,
 `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;