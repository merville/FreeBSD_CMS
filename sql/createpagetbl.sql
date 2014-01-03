USE freebsdcms;
CREATE TABLE if not exists pages (
         id INT NOT NULL AUTO_INCREMENT,
	 PRIMARY KEY(id),
         title VARCHAR(50) NOT NULL,
         h1 VARCHAR(50),
	 body TEXT
         );
