-- Insérer des données dans la table utilisateur
INSERT INTO utilisateur (email, mot_passe, type) VALUES
('henri@example.com', '123', 1),
('sarah@example.com', '456', 1),
('leo@example.com', '789', 1),
('admin@example.com', '1234', 4);

-- Insérer des données dans la table patient
INSERT INTO patient (nom, date_naissance, genre, remboursement) VALUES
('RAZANAKOTO VOAY', '1990-01-01', 1, TRUE),
('ANDRIANINA RABE', '1985-05-15', 2, FALSE),
('RAVOAVY MANANTSOA', '2000-08-20', 1, TRUE),
('RAZAFIMANDIMBY FARA', '1995-12-10', 2, TRUE),
('RAKOTOMALALA JEAN', '1978-03-05', 1, FALSE);


-- Insérer des données dans la table acte_depense
INSERT INTO acte_depense (code, nom,budget, type) VALUES
('CONS', 'Consultation generale',2500000, 1),
('OPE', 'Operation chirurgicale',7500000, 1),
('CSP', 'Consultation specialisee',3000000, 1),
('ANA', 'Analyse sanguine',2000000, 1),
('LOY', 'Location du local',2000000, 5),
('SAL', 'Salaire du personnel',5000000, 5),
('AMC', 'Achat de materiel medical',5600000, 5);

-- Insérer des données dans la table budget_annuel
INSERT INTO budget_annuel (id_acte_depense, montant, annee) VALUES
(1, 2500000.00, 2024),
(2, 7500000.00, 2024),
(3, 3000000.00, 2024),
(4, 2000000.00, 2024),
(5, 2000000.00, 2024),
(6, 5000000.00, 2024),
(7, 5600000.00, 2024),

(1, 1200000.00, 2023),
(2, 5000000.00, 2023),
(3, 2500000.00, 2023),
(4, 1000000.00, 2023),
(5, 1500000.00, 2023),
(6, 3000000.00, 2023),
(7, 4000000.00, 2023);


INSERT INTO paiement_acte (id_utilisateur, id_patient, id_acte_depense, prix, date_paiement_acte)
VALUES
(1, 1, 1, 500000, '2024-04-1'),
(1, 1, 2, 450000, '2024-04-1'),
(1, 1, 3, 10000, '2024-04-1');

INSERT INTO paiement_acte (id_utilisateur, id_patient, id_acte_depense, prix, date_paiement_acte)
VALUES
(1, 1, 1, 500000, '2024-04-12');

INSERT INTO paiement_depense (id_utilisateur, id_acte_depense, montant, date_paiement_depense) VALUES
(1, 1, 100.50, '2023-01-15'),
(2, 2, 200.75, '2023-02-10'),
(3, 3, 150.00, '2023-03-05'),
(4, 1, 250.25, '2023-04-20'),
(2, 4, 300.40, '2023-05-15'),
(1, 5, 350.60, '2023-06-10');


--TEST CALCUL

INSERT INTO paiement_acte (id_utilisateur, id_patient, id_acte_depense, prix, date_paiement_acte)
VALUES
(1, 1, 1, 5000, '2024-04-1'),
(1, 1, 2, 450000, '2024-04-8'),
(1, 1, 3, 10000, '2024-04-12'),
(1, 1, 2, 350000, '2024-04-15'),
(1, 1, 3, 100000, '2024-04-29');


INSERT INTO paiement_acte (id_utilisateur, id_patient, id_acte_depense, prix, date_paiement_acte)
VALUES
(1, 2, 1, 7000, '2024-04-1'),
(1, 2, 4, 20000, '2024-04-22');

INSERT INTO paiement_depense (id_utilisateur, id_acte_depense, montant, date_paiement_depense) VALUES
(1, 5, 35000, '2024-04-8'),
(2, 7, 100000, '2024-04-12'),
(3, 7, 100000, '2024-04-15'),
(4, 5, 35000, '2024-04-29'),
(2, 7, 30030, '2024-04-22');

--TEST CALCUL


INSERT INTO paiement_acte (id_utilisateur, id_patient, id_acte_depense, prix, date_paiement_acte)
VALUES
(1, 2, 1, 5000, '2023-04-1'),
(1, 2, 4, 10000, '2023-04-1'),
(1, 2, 2, 450000, '2023-04-8');

INSERT INTO paiement_depense (id_utilisateur, id_acte_depense, montant, date_paiement_depense) VALUES
(1, 5, 50000, '2023-04-8'),
(2, 7, 150000, '2023-04-12'),
(3, 6, 800000, '2023-04-15');

