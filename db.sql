CREATE TABLE Marque(
    id int(3) AUTO_INCREMENT PRIMARY KEY,
    marque varchar(50),
    logo varchar(50)
    );
CREATE TABLE Voiture(
    id int(3) AUTO_INCREMENT PRIMARY KEY,
    matricule varchar(50),
    serie varchar(50),
    model varchar(50),
    couleur varchar(50),
    carburant varchar(50),
    puissance varchar(50),
    prix float,
    image varchar(50),
    marque_id int(3) NOT null,
    CONSTRAINT fk FOREIGN KEY(marque_id)REFERENCES marque(id)
    );
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_depart DATE NOT NULL,
    date_retour DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255),
    role ENUM('client', 'admin') DEFAULT 'client',
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE panier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateurs_id INT NOT NULL,
    voiture_id INT NOT NULL,
    quantite INT DEFAULT 1,
    FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (voiture_id) REFERENCES Voiture(id)
);
CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total FLOAT NOT NULL,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id)
);
ALTER TABLE utilisateurs
ADD COLUMN token VARCHAR(255),
ADD COLUMN is_confirmed BOOLEAN DEFAULT 0;
