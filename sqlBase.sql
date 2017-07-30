DROP TABLE IF EXISTS Bill;
DROP TABLE IF EXISTS Session;

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
    login VARCHAR(255) unique,
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
    amount double,
    PRIMARY KEY (id),
    FOREIGN KEY (rentalID) REFERENCES Rental (id)
);
CREATE TABLE Session
(
  id INTEGER NOT NULL AUTO_INCREMENT,
  sessNumber VARCHAR(255),
  userID int,
  PRIMARY KEY (id),
  FOREIGN KEY (userID) REFERENCES Owner (id)
);
CREATE TABLE Bill
(
  id INTEGER NOT NULL AUTO_INCREMENT,
  rentalID int,
  billNumber VARCHAR(255),
  startPeriode VARCHAR(255),
  endPeriode VARCHAR(255),
  editDate VARCHAR(255),
  ownerName VARCHAR(255),
  ownerAddress VARCHAR(255),
  ownerZip VARCHAR(255),
  ownerCity VARCHAR(255),
  ownerPhone VARCHAR(255),
  ownerCell VARCHAR(255),
  ownerMail VARCHAR(255),
  bankName VARCHAR(255),
  ownerIBAN VARCHAR(255),
  ownerBIC VARCHAR(255),
  flatNumber VARCHAR(255),
  tenantName VARCHAR(255),
  tenantAddress VARCHAR(255),
  tenantZip VARCHAR(255),
  tenantCity VARCHAR(255),
  tenantPhone VARCHAR(255),
  stillToPay VARCHAR(255),
  transactions VARCHAR(255),
  comment VARCHAR(255),
  paymentInfo VARCHAR(255),
  PRIMARY KEY (id),
  FOREIGN KEY (rentalID) REFERENCES Rental (id)
);

-- Owner table content

INSERT INTO Owner (name,address,city,zip,email,phone,cell,bankName,IBAN,BIC,login,password) VALUES
    ("Didier Tschofen","7, Avenue du général roux","Pont de Claix","38800","didiertschofen@hotmail.com","04 76 98 28 23","06 13 71 26 37","CIC VAL THORENS","FR76 1009 6182 2400 0638 1540 131","CMC1FRPP","didieryat","098f6bcd4621d373cade4e832627b4f6"), -- test
    ("Bernard Tschofen","7, Avenue du général roux","Pont de Claix","38800","bernardesf@hotmail.com","04 79 00 72 72","06 85 08 15 05","","","","bernardesf","78d6810e1299959f3a8db157045aa926"), -- bernard
    ("Christophe Tschofen","","","","btschofen@cegetel.net","","","","","","christophe","8805874a790757f828ce9614c8fd400a"), -- sarolufa
    ("Béatrice Tschofen","","","","beatscho@hotmail.fr","","","","FR76 1009 6182 3000 0632 8140 183","","bea","098f6bcd4621d373cade4e832627b4f6"); -- test

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
    ("Jocelyne Mignerey","","06 61 09 89 23"),
    ("Jean-Pierre Pâques","","06 84 84 74 44"),
    ("Elodie Leiner","",""),
    ("Severine Lavanchy","","")
    ;

-- Rental content

INSERT INTO Rental (tenantID,flatID,startDate,ended) VALUES -- AAAA-MM-JJ
    (1,1,"2017-04-01",false),
    (2,2,"2017-01-01",false),
    (3,8,"2017-01-01",false),
    (4,5,"2017-04-01",false),
    (5,6,"2017-04-01",false)
    ;

-- Transaction content

INSERT INTO Transaction (title,rentalID,transactionDate,amount) VALUES
    ("Caution due",1,"2017-04-01",461.67),
    ("Paiement caution",1,"2017-04-24",-461.67),
    ("Loyer Avril",1,"2017-04-30",473.67),
    ("Paiement loyer Avril",1,"2017-05-08",-473.67),
    ("Loyer Mai",1,"2017-05-31",473.67),
    ("Paiement loyer Mai",1,"2017-06-08",-473.67),
    ("Loyer Juin",1,"2017-06-30",473.67),
    ("Paiement loyer Juin",1,"2017-07-07",473.67),

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

    ("Caution due",4,"2017-04-26",454.79),
    ("Paiement caution",4,"2017-04-27",-454.79),
    ("Loyer Avril",4,"2017-04-30",466.79),
    ("Paiement loyer Avril",4,"2017-05-08",-466.79),
    ("Loyer Mai",4,"2017-05-31",466.79),
    ("Paiement loyer Mai",4,"2017-06-08",-466.79),
    ("Loyer Juin",4,"2017-06-30",466.79),
    ("Paiement loyer Juin",4,"2017-07-08",-466.79),

    ("Caution due",5,"2017-05-09",460),
    ("Paiement caution",5,"2017-05-10",-460),
    ("Loyer Avril",5,"2017-04-30",236),
    ("Paiement loyer Avril",5,"2017-05-05",-236),
    ("Loyer Mai",5,"2017-05-31",472),
    ("Paiement loyer Mai",5,"2017-06-05",-472),
    ("Loyer Juin",5,"2017-06-30",472),
    ("Paiement loyer Juin",5,"2017-07-05",-472)
    ;


-- INSERT INTO Transaction (title,rentalID,transactionDate,amount) VALUES
