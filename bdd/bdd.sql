CREATE USER cliniqueu WITH PASSWORD 'clinique';
CREATE DATABASE clinique;
GRANT ALL PRIVILEGES ON DATABASE clinique TO cliniqueu;

psql -U cliniqueu -d clinique

CREATE TABLE utilisateur (
    id_utilisateur SERIAL PRIMARY KEY,
    email VARCHAR(255),
    mot_passe VARCHAR(50),
    type INT
);

CREATE TABLE patient (
    id_patient SERIAL PRIMARY KEY,
    nom VARCHAR(255) DEFAULT 'RAZANAKOTO VOAY',
    date_naissance DATE,
    genre INT DEFAULT 1,
    remboursement BOOLEAN
);

CREATE TABLE acte_depense (
    id_acte_depense SERIAL PRIMARY KEY,
    code VARCHAR(255),
    nom VARCHAR(255) DEFAULT 'ACTE_DEPENSE',
    type INT
);

CREATE TABLE budget_annuel (
    id_budget_annuel SERIAL PRIMARY KEY,
    montant DOUBLE PRECISION,
    annee INT
);

CREATE TABLE paiement_acte (
    id_paiement_acte SERIAL PRIMARY KEY,
    id_utilisateur INT REFERENCES utilisateur(id_utilisateur),
    id_patient INT REFERENCES patient(id_patient),
    id_acte_depense INT REFERENCES acte_depense(id_acte_depense),
    prix DOUBLE PRECISION
    date_paiement_acte DATE
);

CREATE TABLE paiement_depense(
    id_paiement_depense SERIAL PRIMARY KEY,
    id_utilisateur INT REFERENCES utilisateur(id_utilisateur),
    id_acte_depense INT REFERENCES acte_depense(id_acte_depense),
    montant DOUBLE PRECISON,
    date_paiement_depense DATE
);