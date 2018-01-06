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
  VALUES (1, 'HTC One', 'Preizkusite najnovejši model znamke HTC - HTC One!\n\nTo je telefon velikih zmogljivosti, ki vam bo zdržal veliko več kot ostala poceni kitajska roba.', 399.99, 1);
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status)
  VALUES(2, 'Polnilec za HTC One', 'To je super polnilec za telefon, ki deluje za vse HTC telefone, pa tudi za nekatere druge.\n\nKupite ga še danes in poglejte kaj pomeni imeti super polnilec', 12.95, 2);
INSERT INTO ep.izdelki(kategorija, ime, opis, cena, status)
  VALUES(1, 'Huawei P10', 'Moderen telefon z visoko zmogljivostjo za nizko ceno!\n\nKamera 10MP, 4GB RAM-a, baterija ki zdrži 20h.\n\nKaj še čakate? Naročite zdaj!', 499.99, 3);

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

-- admin
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, status)
  VALUES (1, 'Renato', 'Leskovar', 'ep.projekt2017@gmail.com',
          '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG',
          'Ulica Darinka Dragota 83a', 1000, 1);
-- prodajalci
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, status)
  VALUES (2, 'Nataša', 'Maček', 'natasa.macek@ep.com',
          '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG',
          'Gradnikove brigade 19', 5000, 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, status)
  VALUES (2, 'Vlado', 'Petek', 'vlado.petek@ep.com',
          '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG',
          'Iztokova 4', 6000, 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, status)
VALUES (2, 'Karl', 'Stopar', 'karl.stopar@ep.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG',
        'Tbilisijska 34', 1000, 1);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, telefon, status)
VALUES (3, 'Romana', 'Pogačnik', 'romana.pogaca@gmail.com',
        '$2y$10$15CJEaukxLwUq1HVrT43h.cb4BPY3rywRm./vxnhtuT.yp7Lp6yYG',
        'Dunajska 22', 6310, '031298335', 1);
-- ocene
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 1, 4);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 2, 5);
INSERT INTO ep.ocene(id_uporabnika, id_izdelka, ocena) VALUES(5, 3, 2);
