CREATE TABLE IF NOT EXISTS `kategorije` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'Kategorije izdelkov';

CREATE TABLE IF NOT EXISTS `naslovi` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `postna_st` INT NOT NULL,
  `kraj` VARCHAR(45) NOT NULL,
  `ulica` VARCHAR(45) NOT NULL,
  `hisna_st` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

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
  `cena` INT NOT NULL,
  `status` INT NOT NULL,
  `slika_url` VARCHAR(1000) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_izdelki_1_idx` (`kategorija` ASC),
  INDEX `fk_izdelki_2_idx` (`status` ASC),
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

CREATE TABLE IF NOT EXISTS `uporabniki` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vloga` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(80) NOT NULL,
  `naslov` INT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_uporabniki_2_idx` (`vloga` ASC),
  INDEX `fk_uporabniki_1_idx` (`naslov` ASC),
  INDEX `fk_uporabniki_3_idx` (`status` ASC),
  CONSTRAINT `fk_uporabniki_2`
    FOREIGN KEY (`vloga`)
    REFERENCES `vloge` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uporabniki_1`
    FOREIGN KEY (`naslov`)
    REFERENCES `naslovi` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uporabniki_3`
    FOREIGN KEY (`status`)
    REFERENCES `status_uporabniki` (`id`)
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
  `cena` INT NOT NULL,
  `kolicina` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_narocilo_izdelki_1`
    FOREIGN KEY (`id_narocila`)
    REFERENCES `narocila` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `ocene` (
  `id_uporabnika` INT NOT NULL,
  `id_izdelka` INT NOT NULL,
  `ocena` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_uporabnika`, `id_izdelka`),
  INDEX `fk_ocene_2_idx` (`id_izdelka` ASC),
  CONSTRAINT `fk_ocene_1`
    FOREIGN KEY (`id_uporabnika`)
    REFERENCES `uporabniki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocene_2`
    FOREIGN KEY (`id_izdelka`)
    REFERENCES `izdelki` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Ocene izdelkov';
