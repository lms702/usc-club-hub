# CREATE TABLE users(
# 	user_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
# 	username VARCHAR(100) NOT NULL,
#     password VARCHAR(100) NOT NULL,
#     email VARCHAR(100)
# );
# SELECT * FROM users where username = '';
# INSERT INTO users(username, password) VALUES('cream', 'mai');
# select * from users;
# -- DELETE FROM users where username = 'cream';
#
# SELECT * FROM users;
CREATE TABLE users(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  username VARCHAR(45) NOT NULL,
  password VARCHAR(45) NOT NULL
);
CREATE TABLE clubs(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE categories(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    category VARCHAR(45) NOT NULL
);
CREATE TABLE tags(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    club_id INT NOT NULL,
    FOREIGN KEY (club_id) REFERENCES clubs(id),
    tag VARCHAR(45) NOT NULL
);