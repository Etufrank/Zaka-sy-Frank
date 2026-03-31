
CREATE DATABASE IF NOT EXISTS supermarche_4182_4223;
USE supermarche_4182_4223;

CREATE TABLE IF NOT EXISTS produit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(100) NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    quantite_stock INT NOT NULL DEFAULT 0,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS caisse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_caisse INT NOT NULL UNIQUE,
    statut ENUM('ouverte', 'fermee') DEFAULT 'ouverte',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    caisse_id INT NOT NULL,
    date_achat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant_total DECIMAL(10, 2) DEFAULT 0,
    statut ENUM('en_cours', 'cloture') DEFAULT 'en_cours',
    FOREIGN KEY (caisse_id) REFERENCES caisse(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ligne_achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    achat_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire_au_moment DECIMAL(10, 2) NOT NULL,
    montant_ligne DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (achat_id) REFERENCES achat(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produit(id) ON DELETE CASCADE
);

