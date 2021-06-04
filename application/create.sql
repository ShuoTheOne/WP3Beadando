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