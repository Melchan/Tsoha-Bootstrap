-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE owner(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL
);

CREATE TABLE category(
  id SERIAL PRIMARY KEY,
  tag varchar(50) NOT NULL
);

CREATE TABLE picture(
  id SERIAL PRIMARY KEY,
  owner_id int REFERENCES owner(id), -- Viiteavain Player-tauluun
  title varchar(50) NOT NULL,
  picture bytea NOT NULL,
  description varchar(400),
  postDate date DEFAULT current_timestamp
);

CREATE TABLE comment(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  message varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  owner_id INTEGER REFERENCES owner(id),
  picture_id INTEGER REFERENCES picture(id)
);

CREATE TABLE picture_category(
  picture_id int REFERENCES picture (picture_id) ON UPDATE CASCADE ON DELETE CASCADE, 
  category_id int REFERENCES category (category_id) ON UPDATE CASCADE ON DELETE CASCADE,
  category_order SMALLINT,
  PRIMARY KEY (entry_id, tag_id)
);