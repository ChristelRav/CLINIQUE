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
