-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO owner (name, password) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO owner (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO joke(owner_id, title, description) VALUES (null, 'Hauska kasku', 'Kuka on juusto?');
INSERT INTO joke(owner_id, title, description) VALUES (null, 'Hauska juttu', 'Kulta on juustoa arvokkaampaa!');
INSERT INTO joke(owner_id, title, description) VALUES (null, 'Hauska vitsi', 'Knock knock!');
INSERT INTO joke(owner_id, title, description) VALUES (null, 'Hauska huhu', 'Olen kuningas');