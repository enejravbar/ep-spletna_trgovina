CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Kategorije izdelkov';

CREATE TABLE `naslovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postna_st` int(11) NOT NULL,
  `kraj` varchar(45) NOT NULL,
  `ulica` varchar(45) NOT NULL,
  `hisna_st` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `status_izdelki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `status_narocila` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `vloge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `izdelki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategorija` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `cena` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `slika_url` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_izdelki_1_idx` (`kategorija`),
  KEY `fk_izdelki_2_idx` (`status`),
  CONSTRAINT `fk_izdelki_1` FOREIGN KEY (`kategorija`) REFERENCES `kategorije` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_izdelki_2` FOREIGN KEY (`status`) REFERENCES `status_izdelki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `uporabniki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vloga` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `priimek` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `geslo` varchar(80) NOT NULL,
  `naslov` int(11) DEFAULT NULL,
  `potrjen` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_uporabniki_2_idx` (`vloga`),
  KEY `fk_uporabniki_1_idx` (`naslov`),
  CONSTRAINT `fk_uporabniki_1` FOREIGN KEY (`naslov`) REFERENCES `naslovi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_uporabniki_2` FOREIGN KEY (`vloga`) REFERENCES `vloge` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `kosarice` (
  `id_uporabnika` int(11) NOT NULL,
  `id_izdelka` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`id_uporabnika`,`id_izdelka`),
  KEY `fk_kosarice_2_idx` (`id_izdelka`),
  CONSTRAINT `fk_kosarice_1` FOREIGN KEY (`id_uporabnika`) REFERENCES `uporabniki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kosarice_2` FOREIGN KEY (`id_izdelka`) REFERENCES `izdelki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `narocila` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kupec` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_narocila_1_idx` (`kupec`),
  KEY `fk_narocila_2_idx` (`status`),
  CONSTRAINT `fk_narocila_1` FOREIGN KEY (`kupec`) REFERENCES `uporabniki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_narocila_2` FOREIGN KEY (`status`) REFERENCES `status_narocila` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `narocilo_izdelki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_narocila` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `cena` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_narocilo_izdelki_1` (`id_narocila`),
  CONSTRAINT `fk_narocilo_izdelki_1` FOREIGN KEY (`id_narocila`) REFERENCES `narocila` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ocene` (
  `id_uporabnika` int(11) NOT NULL,
  `id_izdelka` int(11) NOT NULL,
  `ocena` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_uporabnika`,`id_izdelka`),
  KEY `fk_ocene_2_idx` (`id_izdelka`),
  CONSTRAINT `fk_ocene_1` FOREIGN KEY (`id_uporabnika`) REFERENCES `uporabniki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocene_2` FOREIGN KEY (`id_izdelka`) REFERENCES `izdelki` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ocene izdelkov';
