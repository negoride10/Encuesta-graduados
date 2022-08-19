CREATE DATABASE IF NOT EXISTS encuesta_graduados;
USE encuesta_graduados;

CREATE TABLE form_answers (
ID INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
email VARCHAR (64) NOT NULL ,
identification_number VARCHAR (64) NOT NULL ,
name VARCHAR(64) NOT NULL,
lastname VARCHAR(64) NOT NULL,
mobile_phone VARCHAR(64) NOT NULL ,
alternative_mobile_phone VARCHAR(64),
address VARCHAR(64) NOT NULL,
country VARCHAR(64) NOT NULL,
city VARCHAR(64) NOT NULL,
is_graduated TINYINT NOT NULL,
answers JSON NOT NULL,
created_at DATETIME NOT NULL,
is_confirmed TINYINT,
modified_at DATETIME,
has_error TINYINT
);