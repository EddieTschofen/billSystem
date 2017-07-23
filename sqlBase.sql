DROP TABLE IF EXISTS Sessions;
DROP TABLE IF EXISTS Users;

DROP TABLE IF EXISTS Transaction;
DROP TABLE IF EXISTS Rental;
DROP TABLE IF EXISTS Tenant;
DROP TABLE IF EXISTS Flat;
DROP TABLE IF EXISTS Apartment_block;
DROP TABLE IF EXISTS Owner;

CREATE TABLE Owner
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(200),
    address VARCHAR(255),
    city VARCHAR(255),
    zip VARCHAR(5),
    email VARCHAR(255),
    phone VARCHAR(20),
    cell VARCHAR(20),
    bankName VARCHAR(50),
    IBAN VARCHAR(33),
    BIC VARCHAR(11),
    login VARCHAR(255),
    password VARCHAR(255),
    PRIMARY KEY (id)
);
CREATE TABLE Apartment_block
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    address VARCHAR(255),
    city VARCHAR(255),
    zip VARCHAR(5),
    PRIMARY KEY (id)
);
CREATE TABLE Flat
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    blockID int,
    flat_num int,
    ownerID int,
    PRIMARY KEY (id),
    FOREIGN KEY (ownerID) REFERENCES Owner(id),
    FOREIGN KEY (blockID) REFERENCES Apartment_block(id)
);
CREATE TABLE Tenant
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(200),
    email VARCHAR(255),
    phone VARCHAR(20),
    PRIMARY KEY (id)
);
CREATE TABLE Rental
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    tenantID int,
    flatID int,
    startDate date,
    endDate date,
    ended boolean,
    PRIMARY KEY (id),
    FOREIGN KEY (flatID) REFERENCES Flat (id),
    FOREIGN KEY (tenantID) REFERENCES Tenant (id)
);
CREATE TABLE Transaction
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    rentalID int,
    transactionDate date,
    amount float,
    PRIMARY KEY (id),
    FOREIGN KEY (rentalID) REFERENCES Rental (id)
);
CREATE TABLE Sessions
(
  id INTEGER NOT NULL AUTO_INCREMENT,
  sessNumber VARCHAR(255),
  userID int,
  PRIMARY KEY (id),
  FOREIGN KEY (userID) REFERENCES Owner (id)
);

-- Owner table content

INSERT INTO Owner (name,address,city,zip,email,phone,cell,bankName,IBAN,BIC,login,password) VALUES
    ("Didier Tschofen","7, Avenue du général roux","Pont de Claix","38800","didiertschofen@hotmail.com","04 76 98 06 62","06 13 71 26 37","CIC VAL THORENS","FR76 1009 6182 2400 0638 1540 131","CMC1FRPP","didieryat","098f6bcd4621d373cade4e832627b4f6"), -- test
    ("Bernard Tschofen","","","","bernardesf@hotmail.fr","","","","","","bernardesf","78d6810e1299959f3a8db157045aa926"), -- bernard
    ("Christophe Tschofen","","","","btschofen@cegetel.net","","","","","","bernardesf","8805874a790757f828ce9614c8fd400a"), -- sarolufa
    ("Béatrice Tschofen","","","","beatscho@hotmail.fr","","","","","","bernardesf","098f6bcd4621d373cade4e832627b4f6"); -- test

-- Apartment_block content

INSERT INTO Apartment_block (name,address,city,zip) VALUES
    ("Villa tranquille","163, Route du Crêt","Essert-Romand","74110");

-- Flat content

INSERT INTO Flat (blockID,flat_num,ownerID) VALUES
    (1,7,1),
    (1,8,1),
    (1,1,3),
    (1,2,3),
    (1,3,4),
    (1,4,4),
    (1,5,2),
    (1,6,2);

-- Tenant content

INSERT INTO Tenant (name,email,phone) VALUES
    ("Sandrine Vernay","","06 79 55 06 93"),
    ("Jocelyne Mignerey","","06 61 09 89 23");

-- Rental content

INSERT INTO Rental (tenantID,flatID,startDate,ended) VALUES -- AAAA-MM-JJ
    (1,1,"2017-04-01",false),
    (2,2,"2017-01-01",false);

-- Transaction content

INSERT INTO Transaction (title,rentalID,transactionDate,amount) VALUES
    ("Caution due",1,"2017-04-01",461.67),
    ("Paiement caution",1,"2017-04-24",-461.67),
    ("Loyer Avril",1,"2017-04-30",473.67),
    ("Paiement loyer Avril",1,"2017-05-08",-473.67),
    ("Loyer Mai",1,"2017-05-31",473.67),
    ("Paiement loyer Mai",1,"2017-06-08",-473.67),
    ("Loyer Juin",1,"2017-06-30",473.67),
    ("Caution due",2,"2017-01-01",462.48),
    ("Loyer Janvier",2,"2017-01-31",0),
    ("Loyer Février",2,"2017-02-28",474.48),
    ("Loyer Mars",2,"2017-03-31",474.48),
    ("Paiement caution",2,"2017-04-25",-462.48),
    ("Loyer Avril",2,"2017-04-30",474.48),
    ("Paiement loyer",2,"2017-05-17",-664.27),
    ("Loyer Mai",2,"2017-05-31",474.48),
    ("Paiement loyer",2,"2017-06-14",-664.27),
    ("Loyer Juin",2,"2017-06-30",474.48),
    ("Paiement loyer Juin",1,"2017-07-07",473.67)
    ;


-- INSERT INTO Transaction (title,rentalID,transactionDate,amount) VALUES
