-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO owner (name, password) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO owner (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO joke(owner_name, title, description) VALUES ('pekka', 'Hauska kasku', 'Kuka on juusto?');
INSERT INTO joke(owner_name, title, description) VALUES ('jukka', 'Hauska juttu', 'Kulta on juustoa arvokkaampaa!');
INSERT INTO joke(owner_name, title, description) VALUES ('pertti', 'Hauska vitsi', 'Knock knock!');
INSERT INTO joke(owner_name, title, description) VALUES ('pasi', 'Hauska huhu', 'Olen kuningas');