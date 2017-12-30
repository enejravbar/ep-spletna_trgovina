-- kategorije
INSERT INTO ep.kategorije(ime) VALUES ('mobilni telefoni');
INSERT INTO ep.kategorije(ime) VALUES ('polnilci');
INSERT INTO ep.kategorije(ime) VALUES ('torbice in ovitki');
INSERT INTO ep.kategorije(ime) VALUES ('zaščitne folije in stekla');
INSERT INTO ep.kategorije(ime) VALUES ('baterije');

-- status_izdelki
INSERT INTO ep.status_izdelki(naziv) VALUES('na zalogi');
INSERT INTO ep.status_izdelki(naziv) VALUES('zadnji kosi');
INSERT INTO ep.status_izdelki(naziv) VALUES('ni na voljo');

-- status_narocila
INSERT INTO ep.status_narocila(naziv) VALUES('oddano');
INSERT INTO ep.status_narocila(naziv) VALUES('potrjeno');
INSERT INTO ep.status_narocila(naziv) VALUES('stornirano');

-- status_uporabniki
INSERT INTO ep.status_uporabniki(naziv) VALUES('aktiven');
INSERT INTO ep.status_uporabniki(naziv) VALUES('neaktiven');
INSERT INTO ep.status_uporabniki(naziv) VALUES('nepotrjen');

-- vloge
INSERT INTO ep.vloge(naziv) VALUES('administrator');
INSERT INTO ep.vloge(naziv) VALUES('prodajalec');
INSERT INTO ep.vloge(naziv) VALUES('stranka');

-- izdelki
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status)
  VALUES (1, 'HTC One', 'bla', 399.99, 1);
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status)
  VALUES(2, 'Polnilec za HTC One', 'bla', 12.95, 2);
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status)
  VALUES(1, 'Huawei P10', 'bla', 499.99, 3);

-- slike
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek1-1.jpg', 'data/images/izdelek1-1.jpg', 'jpg', 1);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek2-1.jpg', 'data/images/izdelek2-1.jpg', 'jpg', 2);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek3-1.jpg', 'data/images/izdelek3-1.jpg', 'jpg', 3);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
VALUES('izdelek3-2.jpg', 'data/images/izdelek3-2.jpg', 'jpg', 3);

-- posta
INSERT INTO ep.posta(postna_st, naziv) VALUES(5000, 'Nova Gorica');
INSERT INTO ep.posta(postna_st, naziv) VALUES(1000, 'Ljubljana');
INSERT INTO ep.posta(postna_st, naziv) VALUES(2000, 'Maribor');
INSERT INTO ep.posta(postna_st, naziv) VALUES(5270, 'Ajdovščina');
INSERT INTO ep.posta(postna_st, naziv) VALUES(6210, 'Sežana');
INSERT INTO ep.posta(postna_st, naziv) VALUES(6000, 'Koper');
INSERT INTO ep.posta(postna_st, naziv) VALUES(6310, 'Izola');

-- uporabniki
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, status)
  VALUES (1, 'Admir', 'Adminović', 'admin@moj-shop.si', 'hash', 'Ulica Darinka Dragota 83a', 1000, 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, status)
  VALUES (2, 'Matej', 'Bizjak', 'matejb96@gmail.com', 'hash', 'Gradnikove brigade 19', 5000, 3);

-- ocene
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(1, 1, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(1, 2, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(1, 3, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(2, 1, 3);
