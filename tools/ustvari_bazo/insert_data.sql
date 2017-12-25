-- kategorije
INSERT INTO ep.kategorije(ime) VALUES ("mobilni telefoni");
INSERT INTO ep.kategorije(ime) VALUES ("polnilci");
INSERT INTO ep.kategorije(ime) VALUES ("torbice in ovitki");
INSERT INTO ep.kategorije(ime) VALUES ("zaščitne folije in stekla");
INSERT INTO ep.kategorije(ime) VALUES ("baterije");

-- status_izdelki
INSERT INTO ep.status_izdelki(naziv) VALUES("na zalogi");
INSERT INTO ep.status_izdelki(naziv) VALUES("zadnji kosi");
INSERT INTO ep.status_izdelki(naziv) VALUES("naročeno");
INSERT INTO ep.status_izdelki(naziv) VALUES("ni na voljo");

-- status_narocila
INSERT INTO ep.status_narocila(naziv) VALUES("oddano");
INSERT INTO ep.status_narocila(naziv) VALUES("potrjeno");
INSERT INTO ep.status_narocila(naziv) VALUES("stornirano");

-- vloge
INSERT INTO ep.vloge(naziv) VALUES("administrator");
INSERT INTO ep.vloge(naziv) VALUES("prodajalec");
INSERT INTO ep.vloge(naziv) VALUES("stranka");

-- uporabniki
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, potrjen) VALUES (1, 'Admir', 'Adminović', 'admin@moj-shop.si', 'hash', NULL, TRUE);
INSERT INTO ep.uporabniki(vloga, ime, priimek, email, geslo, naslov, potrjen) VALUES (2, 'Matej', 'Bizjak', 'matejb96@gmail.com', 'hash', NULL, TRUE);

-- naslovi
INSERT INTO ep.naslovi(postna_st, kraj, ulica, hisna_st) VALUES(1000, 'Ljubljana', 'Ulica Darinka Dragota', '83a');
INSERT INTO ep.naslovi(postna_st, kraj, ulica, hisna_st) VALUES(5000, 'Nova Gorica', 'Gradnikove brigade', '19');