-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO owner (name, password) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO owner (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO joke(owner_name, title, description) VALUES ('pekka', 'Hauska kasku', 1212212);
INSERT INTO joke(owner_name, title, description) VALUES ('jukka', 'Hauska juttu', 1212121221);
INSERT INTO joke(owner_name, title, description) VALUES ('pertti', 'Hauska vitsi', 12121221);
INSERT INTO joke(owner_name, title, description) VALUES ('pasi', 'Hauska huhu', 121212121);