--  ### Datenbank "mynet_test" erstellen mit DDL ###

-- "mynet_test" Datenbank löschen
DROP DATABASE IF EXISTS mynet_test;

-- "mynet_test" Datenbank erstellen
CREATE DATABASE IF NOT EXISTS mynet_test;

-- Verwende die "mynet_test" Datenbank
USE mynet_test;

-- ändern des default encoding der Datenbank
ALTER DATABASE mynet_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


--  ### TABELLEN ###

-- "Clients" Tabelle
CREATE TABLE clients (
	cl_id INT PRIMARY KEY AUTO_INCREMENT, -- künstlicher PK
    cl_firstname VARCHAR(50),
    cl_lastname VARCHAR(50),
    cl_street VARCHAR(50),
    cl_zip VARCHAR(20),
    cl_city VARCHAR(30),
    cl_phonenumber VARCHAR(30),
    cl_email VARCHAR(50) NOT NULL,
    cl_is_reseller BOOLEAN NOT NULL DEFAULT FALSE,
    cl_is_maintainer BOOLEAN NOT NULL DEFAULT FALSE,
    cl_uid VARCHAR(30)
);


-- "Packages" Tabelle
CREATE TABLE packages (
	pa_id INT PRIMARY KEY AUTO_INCREMENT, -- künstlicher PK
    pa_typ VARCHAR(40) NOT NULL,
    pa_product_name VARCHAR(100) NOT NULL,
    pa_default_quota INT(10)
);


-- "Webs" Tabelle
CREATE TABLE webs (
	we_user VARCHAR(20) PRIMARY KEY,
    we_server VARCHAR(50) NOT NULL,
    we_internal_hostaddress VARCHAR(50) NOT NULL,
    we_maintained_by VARCHAR(50) NOT NULL,
    we_quota INT(10) NOT NULL,
    we_php_vers VARCHAR(10) NOT NULL,
    we_creation_date DATE NOT NULL,
    we_is_online BOOLEAN NOT NULL DEFAULT FALSE,
    we_online_since DATE,
    we_comment VARCHAR(250),
    pa_id INT,
    CONSTRAINT packages_webs FOREIGN KEY (pa_id) REFERENCES packages(pa_id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


-- "Domains" Tabelle
CREATE TABLE domains (
	do_id INT PRIMARY KEY AUTO_INCREMENT, -- künstlicher PK
    do_name VARCHAR(100) NOT NULL,
    do_creation_date DATE NOT NULL,
    we_user VARCHAR(20),
    pa_id INT,
    CONSTRAINT webs_domains FOREIGN KEY (we_user) REFERENCES webs(we_user) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT packages_domains FOREIGN KEY (pa_id) REFERENCES packages(pa_id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


-- "contracts" Tabelle
CREATE TABLE contracts (
	co_id INT PRIMARY KEY AUTO_INCREMENT, -- künstlicher PK
    co_discount INT NOT NULL DEFAULT "0",
    co_comment VARCHAR(250),
    co_is_in_settlement BOOLEAN NOT NULL DEFAULT FALSE,
    co_cancellation DATE,
    co_resubmission DATE,
    co_replacement INT,
    cl_id INT NOT NULL,
	pa_id INT NOT NULL,
    we_user VARCHAR(20),
    do_id INT,
    CONSTRAINT packages_contracts FOREIGN KEY (pa_id) REFERENCES packages(pa_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT clients_contracts FOREIGN KEY (cl_id) REFERENCES clients(cl_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT webs_contracts FOREIGN KEY (we_user) REFERENCES webs(we_user) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT domains_contracts FOREIGN KEY (do_id) REFERENCES domains(do_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT contracts_contracts FOREIGN KEY (co_replacement) REFERENCES contracts(co_id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


### Tabellen 'füllen' mit DML ###

INSERT INTO clients (cl_firstname, cl_lastname, cl_street, cl_zip, cl_city, cl_phonenumber, cl_email, cl_is_reseller, cl_is_maintainer, cl_uid)
VALUES
    ('Hans', 'Müller', 'Am Kirchplatz 5', '1010', 'Wien', '+43 1 2345678', 'hans.mueller@example.com', FALSE, FALSE, 'AT-CUST123'),
    ('Anna', 'Schmidt', 'Bahnstraße 15', '4020', 'Linz', '+43 732 987654', 'anna.schmidt@example.com', FALSE, FALSE, 'AT-CUST456'),
    ('Michael', 'Wagner', 'Hauptplatz 7', '8010', 'Graz', '+43 316 543210', 'michael.wagner@example.com', TRUE, FALSE, 'AT-CUST789'),
    ('Sabine', 'Huber', 'Bergweg 10', '5020', 'Salzburg', '+43 662 234567', 'sabine.huber@example.com', FALSE, TRUE, 'AT-CUST234'),
    ('Thomas', 'Fischer', 'Seestraße 9', '6020', 'Innsbruck', '+43 512 876543', 'thomas.fischer@example.com', FALSE, FALSE, 'AT-CUST567'),
    ('Laura', 'Leitner', 'Gartenweg 3', '5020', 'Salzburg', '+43 662 456789', 'laura.leitner@example.com', FALSE, FALSE, 'AT-CUST890'),
    ('Markus', 'Hofer', 'Bahnhofstraße 21', '1010', 'Wien', '+43 1 8765432', 'markus.hofer@example.com', TRUE, FALSE, 'AT-CUST5678'),
    ('Sophie', 'Steiner', 'Schlossallee 8', '8010', 'Graz', '+43 316 123456', 'sophie.steiner@example.com', FALSE, TRUE, 'AT-CUST3456'),
    ('Paul', 'Gruber', 'Dorfplatz 2', '6020', 'Innsbruck', '+43 512 345678', 'paul.gruber@example.com', FALSE, FALSE, 'AT-CUST2345'),
    ('Carina', 'Keller', 'Am Waldrand 6', '4020', 'Linz', '+43 732 654321', 'carina.keller@example.com', TRUE, TRUE, 'AT-CUST4567');


INSERT INTO packages (pa_typ, pa_product_name, pa_default_quota)
VALUES
    ('webspace', 'Basis Webhosting', 5000),
    ('domain', 'Standard Domain', NULL),
    ('webspace', 'Business Webhosting', 10000),
    ('domain', 'Premium Domain', NULL),
    ('webspace', 'Pro Webhosting', 20000),
    ('domain', 'Gold Domain', NULL),
    ('webspace', 'Enterprise Webhosting', 50000),
    ('domain', 'Platinum Domain', NULL),
    ('webspace', 'StartUp Webhosting', 2500),
    ('domain', 'Silver Domain', NULL);


INSERT INTO webs (we_user, we_server, we_internal_hostaddress, we_maintained_by, we_quota, we_php_vers, we_creation_date, we_is_online, we_online_since, we_comment, pa_id)
VALUES
    ('benutzer123', 'Server1', '192.168.1.101', 'Admin Team', 10000, 'PHP 7.4', '2023-01-15', TRUE, '2023-01-16', 'Persönliche Webseite', 1),
    ('user456', 'Server2', '192.168.2.202', 'Technischer Support', 5000, 'PHP 8.0', '2023-03-20', FALSE, NULL, 'Testseite', 3),
    ('webuser789', 'Server1', '192.168.1.101', 'Admin Team', 20000, 'PHP 7.3', '2023-04-10', TRUE, '2023-04-11', NULL, 5),
    ('user234', 'Server3', '192.168.3.303', 'Entwicklung', 15000, 'PHP 7.4', '2023-06-05', TRUE, '2023-06-06', 'E-Commerce-Website', 1),
    ('user567', 'Server2', '192.168.2.202', 'Technischer Support', 5000, 'PHP 8.0', '2023-07-01', FALSE, NULL, NULL, 2),
    ('webuser890', 'Server1', '192.168.1.101', 'Admin Team', 10000, 'PHP 7.4', '2023-02-18', TRUE, '2023-02-19', NULL, 6),
    ('benutzer5678', 'Server2', '192.168.2.202', 'Technischer Support', 3000, 'PHP 7.3', '2023-04-30', TRUE, '2023-05-01', 'Kleinunternehmen', 9),
    ('webuser3456', 'Server1', '192.168.1.101', 'Admin Team', 50000, 'PHP 7.4', '2023-03-10', TRUE, '2023-03-11', NULL, 7),
    ('user2345', 'Server3', '192.168.3.303', 'Entwicklung', 2500, 'PHP 8.0', '2023-05-25', TRUE, '2023-05-26', 'StartUp-Seite', 10),
    ('user4567', 'Server2', '192.168.2.202', 'Technischer Support', 8000, 'PHP 7.4', '2023-06-20', FALSE, NULL, 'Persönlicher Blog', 4);


INSERT INTO domains (do_name, do_creation_date, we_user, pa_id)
VALUES
    ('beispiel.at', '2023-01-16', 'benutzer123', 2),
    ('testseite.at', '2023-03-21', 'user456', 4),
    ('persönlich.net', '2023-04-11', 'webuser789', 1),
    ('ecommerce.at', '2023-06-06', 'user234', 5),
    ('meinblog.at', '2023-07-02', 'user567', 3),
    ('webhosting.at', '2023-02-20', 'webuser890', 6),
    ('unternehmen.at', '2023-05-02', 'benutzer5678', 9),
    ('business.at', '2023-03-12', 'webuser3456', 7),
    ('startup.at', '2023-05-27', 'user2345', 10),
    ('blog.at', '2023-06-21', 'user4567', 4);


INSERT INTO contracts (co_discount, co_comment, co_is_in_settlement, co_replacement, cl_id, pa_id, we_user, do_id)
VALUES
    (10, 'Rabatt für Stammkunden', TRUE, NULL, 1, 1, 'benutzer123', 1),
    (5, 'Promotionsrabatt', FALSE, NULL, 2, 3, 'user456', 2),
    (15, 'Rabatt für treue Kunden', TRUE, NULL, 3, 2, 'webuser789', NULL),
    (15, 'Rabatt für treue Kunden', TRUE, NULL, 3, 2, NULL, 2),
    (8, 'Sonderrabatt', TRUE, NULL, 4, 5, 'user234', 4),
    (20, 'Exklusivrabatt', FALSE, NULL, 5, 4, 'user567', 5),
    (12, 'Sonderangebot', FALSE, NULL, 6, 6, 'webuser890', 6),
    (25, 'Jubiläumsrabatt', TRUE, NULL, 7, 7, 'benutzer5678', 7),
    (18, 'Frühlingsrabatt', FALSE, NULL, 8, 8, 'webuser3456', 8),
    (30, 'StartUp-Angebot', TRUE, NULL, 9, 9, 'user2345', 9),
    (7, 'Blog-Spezial', FALSE, 11, 10, 3, 'user4567', 10),
	(11, 'Upgrade', FALSE, NULL, 10, 3, 'user4567', 10);


CREATE VIEW overview_webspaces AS
SELECT CONCAT(cl.cl_firstname, " ", cl.cl_lastname) AS "Name", CONCAT(cl.cl_zip, " ", cl.cl_city) AS "Anschrift", 
       we.we_user AS "Webuser" , we.we_php_vers AS "PHP-Version", we.we_creation_date AS "Erstelldatum",
       CONCAT(co.co_discount, "%") AS "Nachlass", co.co_is_in_settlement AS "In Verrechnung",
       pa.pa_product_name AS "Produkt"
FROM clients cl  JOIN contracts co ON cl.cl_id = co.cl_id JOIN webs we ON we.we_user = co.we_user JOIN packages pa ON pa.pa_id = co.pa_id
WHERE pa.pa_typ = "webspace";

CREATE VIEW overview_domains AS
SELECT CONCAT(cl.cl_firstname, " ", cl.cl_lastname) AS "Name", CONCAT(cl.cl_zip, " ", cl.cl_city) AS "Anschrift", 
       do.do_name AS "Domain", do.do_creation_date AS "Registrierdatum",
       CONCAT(co.co_discount, "%") AS "Nachlass", co.co_is_in_settlement AS "In Verrechnung",
       pa.pa_product_name AS "Produkt"
FROM clients cl JOIN contracts co ON cl.cl_id = co.cl_id JOIN domains do ON do.do_id = co.do_id JOIN packages pa ON pa.pa_id = co.pa_id
WHERE pa.pa_typ = "domain";

CREATE VIEW replaced_contracts AS
SELECT *
FROM contracts
WHERE co_replacement IS NOT NULL;






