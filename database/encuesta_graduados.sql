CREATE DATABASE IF NOT EXISTS encuesta_graduados;
USE encuesta_graduados;

CREATE TABLE form_answers (
ID INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT, 
email VARCHAR (64),
identification_number VARCHAR (64),
is_graduated TINYINT, 
answers JSON, 
created_at DATETIME, 
is_confirmed TINYINT, 
modificated_at DATETIME, 
has_error TINYINT
);
