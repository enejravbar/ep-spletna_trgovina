
CREATE DATABASE IF NOT EXISTS ep DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;

GRANT USAGE ON *.* TO ep@localhost IDENTIFIED BY 'ep_težko_geslo';

GRANT ALL PRIVILEGES ON ep.* TO ep@localhost;

FLUSH PRIVILEGES;

USE ep;

CREATE TABLE IF NOT EXISTS `kategorije` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB
  COMMENT = 'Kategorije izdelkov';

CREATE TABLE IF NOT EXISTS `status_izdelki` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `status_narocila` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `status_uporabniki` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `vloge` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `izdelki` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `kategorija` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(1000) NULL,
  `cena` DOUBLE NOT NULL,
  `status` INT NOT NULL,
  `dodan` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_izdelki_1_idx` (`kategorija` ASC),
  INDEX `fk_izdelki_2_idx` (`status` ASC),
  FULLTEXT INDEX `ime_search` (`ime` ASC),
  CONSTRAINT `fk_izdelki_1`
  FOREIGN KEY (`kategorija`)
  REFERENCES `kategorije` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_izdelki_2`
  FOREIGN KEY (`status`)
  REFERENCES `status_izdelki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `slike` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45),
  `lokacija` VARCHAR(100) NOT NULL,
  `ext` VARCHAR(10) NOT NULL,
  `izdelek` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_slike_idx` (`izdelek` ASC),
  CONSTRAINT `fk_slike`
  FOREIGN KEY (`izdelek`)
  REFERENCES `izdelki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `posta` (
  `postna_st` INT NOT NULL,
  `naziv` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`postna_st`))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `uporabniki` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vloga` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(200) NOT NULL,
  `naslov` VARCHAR(200),
  `posta` INT,
  `telefon` VARCHAR(50),
  `status` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_uporabniki_2_idx` (`vloga` ASC),
  INDEX `fk_uporabniki_1_idx` (`posta` ASC),
  INDEX `fk_uporabniki_3_idx` (`status` ASC),
  CONSTRAINT `fk_uporabniki_2`
  FOREIGN KEY (`vloga`)
  REFERENCES `vloge` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uporabniki_1`
  FOREIGN KEY (`posta`)
  REFERENCES `posta` (`postna_st`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uporabniki_3`
  FOREIGN KEY (`status`)
  REFERENCES `status_uporabniki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `potrditev_registracije` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `kljuc` VARCHAR(10) NOT NULL,
  `uporabnik` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_potrd_reg_idx` (`uporabnik` ASC),
  CONSTRAINT `fk_potrd_reg`
  FOREIGN KEY (`uporabnik`)
  REFERENCES `uporabniki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `kosarice` (
  `id_uporabnika` INT NOT NULL,
  `id_izdelka` INT NOT NULL,
  `kolicina` INT NOT NULL,
  PRIMARY KEY (`id_uporabnika`, `id_izdelka`),
  INDEX `fk_kosarice_2_idx` (`id_izdelka` ASC),
  CONSTRAINT `fk_kosarice_1`
  FOREIGN KEY (`id_uporabnika`)
  REFERENCES `uporabniki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kosarice_2`
  FOREIGN KEY (`id_izdelka`)
  REFERENCES `izdelki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `narocila` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `kupec` INT NOT NULL,
  `datum` DATETIME NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_narocila_1_idx` (`kupec` ASC),
  INDEX `fk_narocila_2_idx` (`status` ASC),
  CONSTRAINT `fk_narocila_1`
  FOREIGN KEY (`kupec`)
  REFERENCES `uporabniki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_narocila_2`
  FOREIGN KEY (`status`)
  REFERENCES `status_narocila` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `narocilo_izdelki` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_narocila` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(1000) NULL,
  `cena` DOUBLE NOT NULL,
  `kolicina` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_narocilo_izdelki_1`
  FOREIGN KEY (`id_narocila`)
  REFERENCES `narocila` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;

-- kategorije
INSERT INTO ep.kategorije(ime) VALUES ('Mobilni telefoni');
INSERT INTO ep.kategorije(ime) VALUES ('Polnilci');
INSERT INTO ep.kategorije(ime) VALUES ('Torbice in ovitki');
INSERT INTO ep.kategorije(ime) VALUES ('Zaščitne folije in stekla');
INSERT INTO ep.kategorije(ime) VALUES ('Baterije');

-- status_izdelki
INSERT INTO ep.status_izdelki(naziv) VALUES('Na zalogi');
INSERT INTO ep.status_izdelki(naziv) VALUES('Zadnji kosi');
INSERT INTO ep.status_izdelki(naziv) VALUES('Ni na voljo');
INSERT INTO ep.status_izdelki(naziv) VALUES('Neaktiven');

-- status_narocila
INSERT INTO ep.status_narocila(naziv) VALUES('Oddano');
INSERT INTO ep.status_narocila(naziv) VALUES('Potrjeno');
INSERT INTO ep.status_narocila(naziv) VALUES('Stornirano');
INSERT INTO ep.status_narocila(naziv) VALUES('Preklicano');

-- status_uporabniki
INSERT INTO ep.status_uporabniki(naziv) VALUES('aktiven');
INSERT INTO ep.status_uporabniki(naziv) VALUES('neaktiven');
INSERT INTO ep.status_uporabniki(naziv) VALUES('nepotrjen');

-- vloge
INSERT INTO ep.vloge(naziv) VALUES('administrator');
INSERT INTO ep.vloge(naziv) VALUES('prodajalec');
INSERT INTO ep.vloge(naziv) VALUES('stranka');

-- izdelki
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES (1, 'HTC One', 'Preizkusite najnovejši model znamke HTC - HTC One!\n\nTo je telefon velikih zmogljivosti, ki vam bo zdržal veliko več kot ostala poceni kitajska roba.', 399.99, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(2, 'Polnilec za HTC One', 'To je super polnilec za telefon, ki deluje za vse HTC telefone, pa tudi za nekatere druge.\n\nKupite ga še danes in poglejte kaj pomeni imeti super polnilec', 12.95, 2, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(1, 'Huawei P10', 'Moderen telefon z visoko zmogljivostjo za nizko ceno!\n\nKamera 10MP, 4GB RAM-a, baterija ki zdrži 20h.\n\nKaj še čakate? Naročite zdaj!', 499.99, 3, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(5, 'HTC baterija 1450mAh', 'Nadomestna baterija za telefone HTC!', 6.63, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(3, 'Ovitek za iPhone - Vijoličen', 'Ovitek za iPhone', 34.87, 1, NOW());

INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(3, 'Ovitek za iPhone - Oranžen', 'Ovitek za iPhone', 34.87, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(3, 'Ovitek za iPhone - Rdeč', 'Ovitek za iPhone', 34.87, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(3, 'Ovitek za iPhone - Bel', 'Ovitek za iPhone', 34.87, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(2, 'Brezžični polnilec za iPhone', 'Brezžični polnilec za vse naprave iPhone', 59.55, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(2, 'USB-C polnilec za iPhone', 'USB-C polnilec za vse naprave iPhone', 25.00, 1, NOW());

INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(2, 'Samsung polnilec 12V', 'Polnilec za Samsung za avte', 13.99, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(2, 'Brezžični polnilec za Samsung', 'Brezžični polnilec za vse Samsung naprave', 25.34, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(3, 'Stoječ ovitek za Samsung Galaxy S8', 'Odslej vam telefona ni več potrebno držati v rokah, saj ta ovitek naredi to za vas!', 23.99, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(1, 'Samsung Galaxy S8', 'Novi telefon podjetja Samsung!', 799.0, 1, NOW());
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status, dodan)
VALUES(1, 'Nokia 3', 'Nokia se vrača z novim telefonom - Nokia 3!', 159.0, 1, NOW());

-- slike
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek1-1.jpg', 'data/images/izdelek1-1.jpg', 'jpg', 1);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek2-1.jpg', 'data/images/izdelek2-1.jpg', 'jpg', 2);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek3-1.jpg', 'data/images/izdelek3-1.jpg', 'jpg', 3);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek3-2.jpg', 'data/images/izdelek3-2.jpg', 'jpg', 3);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek7-2.jpg', 'data/images/izdelek7-2.jpg', 'jpg', 7);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek4-2.jpg', 'data/images/izdelek4-2.jpg', 'jpg', 4);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek13-1.jpg', 'data/images/izdelek13-1.jpg', 'jpg', 13);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek7-1.jpg', 'data/images/izdelek7-1.jpg', 'jpg', 7);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek9-1.jpg', 'data/images/izdelek9-1.jpg', 'jpg', 9);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek10-1.jpg', 'data/images/izdelek10-1.jpg', 'jpg', 10);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek6-1.jpg', 'data/images/izdelek6-1.jpg', 'jpg', 6);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek15-3.jpg', 'data/images/izdelek15-3.jpg', 'jpg', 15);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek11-2.jpg', 'data/images/izdelek11-2.jpg', 'jpg', 11);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek11-1.jpg', 'data/images/izdelek11-1.jpg', 'jpg', 11);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek12-1.jpg', 'data/images/izdelek12-1.jpg', 'jpg', 12);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek5-1.jpg', 'data/images/izdelek5-1.jpg', 'jpg', 5);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek14-2.jpg', 'data/images/izdelek14-2.jpg', 'jpg', 14);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek15-2.jpg', 'data/images/izdelek15-2.jpg', 'jpg', 15);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek14-1.jpg', 'data/images/izdelek14-1.jpg', 'jpg', 14);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek9-2.jpg', 'data/images/izdelek9-2.jpg', 'jpg', 9);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek5-2.jpg', 'data/images/izdelek5-2.jpg', 'jpg', 5);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek8-1.jpg', 'data/images/izdelek8-1.jpg', 'jpg', 8);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek4-1.jpg', 'data/images/izdelek4-1.jpg', 'jpg', 4);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek15-1.jpg', 'data/images/izdelek15-1.jpg', 'jpg', 15);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek8-2.jpg', 'data/images/izdelek8-2.jpg', 'jpg', 8);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek12-2.jpg', 'data/images/izdelek12-2.jpg', 'jpg', 12);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek14-3.jpg', 'data/images/izdelek14-3.jpg', 'jpg', 14);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek6-2.jpg', 'data/images/izdelek6-2.jpg', 'jpg', 6);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek10-2.jpg', 'data/images/izdelek10-2.jpg', 'jpg', 10);

-- posta
INSERT INTO ep.posta(postna_st, naziv) VALUES(5000, 'Nova Gorica');
INSERT INTO ep.posta(postna_st, naziv) VALUES(1000, 'Ljubljana');
INSERT INTO ep.posta(postna_st, naziv) VALUES(2000, 'Maribor');
INSERT INTO ep.posta(postna_st, naziv) VALUES(5270, 'Ajdovščina');
INSERT INTO ep.posta(postna_st, naziv) VALUES(6210, 'Sežana');
INSERT INTO ep.posta(postna_st, naziv) VALUES(6000, 'Koper');
INSERT INTO ep.posta(postna_st, naziv) VALUES(6310, 'Izola');

-- admin
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, status)
VALUES (1, 'Renato', 'Leskovar', 'ep.projekt2017@gmail.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 1);
-- prodajalci
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, status)
VALUES (2, 'Nataša', 'Maček', 'natasa.macek@ep.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, status)
VALUES (2, 'Vlado', 'Petek', 'vlado.petek@ep.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, status)
VALUES (2, 'Karl', 'Stopar', 'karl.stopar@ep.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 1);
-- stranke
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, telefon, status)
VALUES (3, 'Romana', 'Pogačnik', 'romana.pogaca@gmail.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG',
        'Dunajska 22', 6310, '031298335', 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, telefon, status)
VALUES (3, 'Erazem', 'Plešec', 'erazem.plesec@gmail.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 'Rudolfa Maistra 12', 1000, '031876123', 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, telefon, status)
VALUES (3, 'Olga', 'Jež', 'olga.jez@gmail.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 'Bleiweissova 34', 1000, '056874123', 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, telefon, status)
VALUES (3, 'Zlatan', 'Resnik', 'zlatan.resnik@gmail.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 'Oražnova 15', 5000, '040445223', 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, telefon, status)
VALUES (3, 'Miro', 'Struna', 'miro.struna@gmail.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG', 'Koprska 20', 6000, '051344766', 1);
