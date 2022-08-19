CREATE DATABASE IF NOT EXISTS encuesta_graduados;
USE encuesta_graduados;

CREATE TABLE form_answers (
ID INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT, 
email NOT NULL VARCHAR (64),
identification_number NOT NULL VARCHAR (64),
name NOT NULL VARCHAR (64),
lastname NOT NULL VARCHAR (64),
mobile_phone NOT NULL VARCHAR (64),
alternative_mobile_phone (64),
address NOT NULL VARCHAR (64),
country NOT NULL VARCHAR(64),
city NOT NULL VARCHAR (64),
is_graduated NOT NULL TINYINT,
answers NOT NULL JSON,
created_at NOT NULL DATETIME,
is_confirmed TINYINT,
modified_at DATETIME,
has_error TINYINT
);
