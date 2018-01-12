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
INSERT INTO ep.status_izdelki(naziv) VALUES('neaktiven');

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
  VALUES('izdelek3-2.jpeg', 'data/images/izdelek3-2.jpeg', 'jpeg', 3);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek7-2.jpeg', 'data/images/izdelek7-2.jpeg', 'jpeg', 7);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek4-2.jpg', 'data/images/izdelek4-2.jpg', 'jpg', 4);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek13-1.jpg', 'data/images/izdelek13-1.jpg', 'jpg', 13);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek7-1.jpeg', 'data/images/izdelek7-1.jpeg', 'jpeg', 7);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek9-1.jpeg', 'data/images/izdelek9-1.jpeg', 'jpeg', 9);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek10-1.jpeg', 'data/images/izdelek10-1.jpeg', 'jpeg', 10);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek6-1.jpeg', 'data/images/izdelek6-1.jpeg', 'jpeg', 6);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek15-3.jpeg', 'data/images/izdelek15-3.jpeg', 'jpeg', 15);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek11-2.jpeg', 'data/images/izdelek11-2.jpeg', 'jpeg', 11);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek11-1.jpeg', 'data/images/izdelek11-1.jpeg', 'jpeg', 11);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek12-1.jpeg', 'data/images/izdelek12-1.jpeg', 'jpeg', 12);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek5-1.jpeg', 'data/images/izdelek5-1.jpeg', 'jpeg', 5);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek14-2.jpeg', 'data/images/izdelek14-2.jpeg', 'jpeg', 14);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek15-2.jpeg', 'data/images/izdelek15-2.jpeg', 'jpeg', 15);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek14-1.jpeg', 'data/images/izdelek14-1.jpeg', 'jpeg', 14);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek9-2.jpeg', 'data/images/izdelek9-2.jpeg', 'jpeg', 9);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek5-2.jpeg', 'data/images/izdelek5-2.jpeg', 'jpeg', 5);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek8-1.jpeg', 'data/images/izdelek8-1.jpeg', 'jpeg', 8);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek4-1.jpg', 'data/images/izdelek4-1.jpg', 'jpg', 4);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek15-1.jpeg', 'data/images/izdelek15-1.jpeg', 'jpeg', 15);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek8-2.jpeg', 'data/images/izdelek8-2.jpeg', 'jpeg', 8);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek12-2.jpeg', 'data/images/izdelek12-2.jpeg', 'jpeg', 12);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek14-3.jpeg', 'data/images/izdelek14-3.jpeg', 'jpeg', 14);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek6-2.jpeg', 'data/images/izdelek6-2.jpeg', 'jpeg', 6);
INSERT INTO ep.slike(naziv, lokacija, ext, izdelek)
  VALUES('izdelek10-2.jpeg', 'data/images/izdelek10-2.jpeg', 'jpeg', 10);

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
-- ocene
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 13, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 2, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 3, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 11, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 3, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 6, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 14, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 15, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 7, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 12, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 9, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 8, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 14, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 8, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 11, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 1, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 2, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 14, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 2, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 7, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 9, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 4, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 13, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 15, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 9, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 10, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 15, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 7, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 8, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 12, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 12, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 5, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 6, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 10, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 15, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 10, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 1, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 13, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 4, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 3, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 4, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 1, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 12, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 3, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 1, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 7, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 14, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 13, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 9, 1);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 6, 2);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(7, 13, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 15, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 5, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 10, 3);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(9, 7, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 8, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 14, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(6, 4, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(8, 8, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 11, 2);
