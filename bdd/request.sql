---SELECT TABLE

SELECT * FROM paiement_depense;
SELECT * FROM paiement_acte;
SELECT * FROM budget_annuel;
SELECT * FROM acte_depense;
SELECT * FROM patient;
SELECT * FROM utilisateur;

---DELETE TABLE

DELETE FROM paiement_depense;
DELETE FROM paiement_acte;
DELETE FROM budget_annuel;
DELETE FROM acte_depense;
DELETE FROM patient;
DELETE FROM utilisateur;

---DROP TABLE

DROP TABLE paiement_depense;
DROP TABLE paiement_acte;
DROP TABLE budget_annuel;
DROP TABLE acte_depense;
DROP TABLE patient;
DROP TABLE utilisateur;

--- TRUNCATE


TRUNCATE  TABLE paiement_depense RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE paiement_acte RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE budget_annuel RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE acte_depense  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE patient  RESTART IDENTITY CASCADE;
TRUNCATE  TABLE utilisateur  RESTART IDENTITY CASCADE;

--- REQUEST