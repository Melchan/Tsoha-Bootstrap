-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO owner (name, password) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO owner (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO joke(title, description, owner_id) VALUES ('pekka', 'Hauska kasku', 1212212);
INSERT INTO joke(title, description, owner_id) VALUES ('jukka', 'Hauska juttu', 1212121221);
INSERT INTO joke(title, description, owner_id) VALUES ('pertti', 'Hauska vitsi', 12121221);
INSERT INTO joke(title, description, owner_id) VALUES ('pasi', 'Hauska huhu', 121212121);