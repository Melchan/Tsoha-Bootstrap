-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO owner (name, password) VALUES (1,'Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO owner (name, password) VALUES (2,'Kimmo', 'Kimmo123');
INSERT INTO joke(title, description, owner_id) VALUES ('pekka', 'Hauska kasku', (SELECT id FROM owner WHERE name = 'Kalle'));
INSERT INTO joke(title, description, owner_id) VALUES ('jukka', 'Hauska juttu', (SELECT id FROM owner WHERE name = 'Kimmo'));
INSERT INTO joke(title, description, owner_id) VALUES ('pertti', 'Hauska vitsi', (SELECT id FROM owner WHERE name = 'Kalle'));
INSERT INTO joke(title, description, owner_id) VALUES ('pasi', 'Hauska huhu', (SELECT id FROM owner WHERE name = 'Kimmo'));
