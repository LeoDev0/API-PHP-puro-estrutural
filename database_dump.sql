CREATE DATABASE devsnotes;

use devsnotes;

CREATE TABLE notes (
	id INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(100) NOT NULL,
	body TEXT,
	PRIMARY KEY (id)
);
