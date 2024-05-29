psql -U cliniqueu -d clinique
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
DROP VIEW v_facture_actuel;
DROP VIEW v_detail_acte;

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
SELECT ad.*
FROM acte_depense ad
WHERE ad.type=1;

CREATE VIEW v_detail_acte AS ( SELECT pa.date_paiement_acte,pa.id_paiement_acte,pa.id_patient,pa.id_acte_depense,pa.prix,ad.nom as acte ,ad.code , p.nom as patient , p.date_naissance , p.genre
FROM paiement_acte pa
JOIN patient p ON p.id_patient = pa.id_patient 
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense );

SELECT  pa.date_paiement_acte,pa.id_paiement_acte,pa.id_patient,pa.id_acte_depense,pa.prix,ad.nom as acte , p.nom as patient , p.date_naissance , p.genre
FROM paiement_acte pa
JOIN patient p ON p.id_patient = pa.id_patient 
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense 
GROUP by pa.date_paiement_acte,pa.id_paiement_acte,pa.id_patient,pa.id_acte_depense,pa.prix,ad.nom  , p.nom  , p.date_naissance , p.genre;

SELECT pa.date_paiement_acte,pa.id_paiement_acte,pa.id_patient,pa.id_acte_depense,pa.prix,ad.nom as acte ,ad.code , p.nom as patient , p.date_naissance , p.genre
FROM paiement_acte pa
JOIN patient p ON p.id_patient = pa.id_patient 
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense 
GROUP by pa.date_paiement_acte,pa.id_paiement_acte,pa.id_patient,pa.id_acte_depense,pa.prix,ad.nom as acte ,ad.code , p.nom as patient , p.date_naissance , p.genre
ORDER BY  pa.date_paiement_acte DESC;


SELECT pa.date_paiement_acte, pa.id_paiement_acte, pa.id_patient, pa.id_acte_depense, pa.prix, 
       ad.nom AS acte, ad.code, p.nom AS patient, p.date_naissance, p.genre
FROM paiement_acte pa
JOIN patient p ON p.id_patient = pa.id_patient
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense
JOIN (SELECT id_patient, MAX(date_paiement_acte) AS max_date FROM paiement_acte GROUP BY id_patient
) recent_pa ON pa.id_patient = recent_pa.id_patient AND pa.date_paiement_acte = recent_pa.max_date
ORDER BY pa.date_paiement_acte DESC;

CREATE VIEW v_facture_actuel AS (SELECT pa.date_paiement_acte, pa.id_paiement_acte, pa.id_patient, pa.id_acte_depense, pa.prix, 
       ad.nom AS acte, ad.code, p.nom AS patient, p.date_naissance, p.genre
FROM paiement_acte pa
JOIN patient p ON p.id_patient = pa.id_patient
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense
JOIN (SELECT id_patient, MAX(date_paiement_acte) AS max_date FROM paiement_acte GROUP BY id_patient
) recent_pa ON pa.id_patient = recent_pa.id_patient AND pa.date_paiement_acte = recent_pa.max_date
ORDER BY pa.date_paiement_acte DESC);

SELECT id_patient , id_acte_depense,  date_paiement_acte , SUM(prix) as prix,acte,code , patient,date_naissance,genre
FROM v_facture_actuel vfa
GROUP BY id_patient , id_acte_depense,  date_paiement_acte,acte,code , patient,date_naissance,genre;

SELECT date_paiement_acte , SUM(prix) as total , id_patient , patient,date_naissance,genre
FROM v_facture_actuel vfa
GROUP BY  id_patient ,  date_paiement_acte, patient,date_naissance,genre;

SELECT *
FROM paiement_depense pd
JOIN acte_depense ad ON ad.id_acte_depense = pd.id_acte_depense;

SELECT pa.id_acte_depense , ad.code , ad.nom , SUM(prix) ,  EXTRACT(YEAR FROM pa.date_paiement_acte) AS annee
FROM paiement_acte pa
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense
GROUP BY pa.id_acte_depense , ad.code ,  ad.nom , pa.date_paiement_acte ;


SELECT pa.id_acte_depense , ad.code , SUM(prix) , ad.budget/12 as budget , EXTRACT(MONTH FROM pa.date_paiement_acte) AS mois  ,  EXTRACT(YEAR FROM pa.date_paiement_acte) AS annee 
FROM paiement_acte pa
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense
GROUP BY pa.id_acte_depense , ad.code , ad.budget , EXTRACT(MONTH FROM pa.date_paiement_acte) ,  EXTRACT(YEAR FROM pa.date_paiement_acte) ;


SELECT pa.id_acte_depense , ba.id_acte_depense , ad.code , SUM(prix) , ba.montant/12 as budget ,
       (SUM(prix) * 100) / (ba.montant/12) as realisation ,
       EXTRACT(MONTH FROM pa.date_paiement_acte) AS mois  ,  EXTRACT(YEAR FROM pa.date_paiement_acte) AS annee 
FROM paiement_acte pa
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense
JOIN budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense
WHERE EXTRACT(MONTH FROM pa.date_paiement_acte) = 04 AND  EXTRACT(YEAR FROM pa.date_paiement_acte) = 2024 AND ba.annee = 2024
GROUP BY pa.id_acte_depense , ba.id_acte_depense , ad.code ,  ba.montant , EXTRACT(MONTH FROM pa.date_paiement_acte) ,  EXTRACT(YEAR FROM pa.date_paiement_acte) ;






SELECT pa.id_acte_depense , ba.id_acte_depense , ad.code , SUM( pa.montant) , ba.montant/12 as budget ,
       (SUM(pa.montant) * 100) / (ba.montant/12) as realisation ,
       EXTRACT(MONTH FROM pa.date_paiement_depense) AS mois  ,  EXTRACT(YEAR FROM pa.date_paiement_depense) AS annee 
FROM paiement_depense pa
JOIN acte_depense ad ON ad.id_acte_depense = pa.id_acte_depense
JOIN budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense
WHERE EXTRACT(MONTH FROM pa.date_paiement_depense) = 04 AND  EXTRACT(YEAR FROM pa.date_paiement_depense) = 2023 AND ba.annee = 2023
GROUP BY pa.id_acte_depense , ba.id_acte_depense , ad.code ,  ba.montant , EXTRACT(MONTH FROM pa.date_paiement_depense) ,  EXTRACT(YEAR FROM pa.date_paiement_depense) ;





SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
COALESCE(SUM(pa.prix), 0) AS sum, ba.montant / 12 AS budget,
COALESCE((SUM(pa.prix) * 100) / (ba.montant / 12), 0) AS realisation,
COALESCE(EXTRACT(MONTH FROM pa.date_paiement_acte),4) AS mois, 
COALESCE(EXTRACT(YEAR FROM pa.date_paiement_acte),2023) AS annee
FROM acte_depense ad
LEFT JOIN paiement_acte pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_acte) = 4 AND EXTRACT(YEAR FROM pa.date_paiement_acte) = 2023
LEFT JOIN budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense  AND ba.annee = 2023
WHERE ad.type = 1
GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_acte),EXTRACT(YEAR FROM pa.date_paiement_acte)     
ORDER BY  ad.id_acte_depense;


SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
COALESCE(SUM(pa.montant), 0) AS sum, ba.montant / 12 AS budget,
COALESCE((SUM(pa.montant) * 100) / (ba.montant / 12), 0) AS realisation,
COALESCE(EXTRACT(MONTH FROM pa.date_paiement_depense),4) AS mois,  
COALESCE(EXTRACT(YEAR FROM pa.date_paiement_depense),2023) AS annee
FROM  acte_depense ad
LEFT JOIN  paiement_depense pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_depense) = 4 AND EXTRACT(YEAR FROM pa.date_paiement_depense) = 2023
LEFT JOIN  budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense AND ba.annee = 2023
WHERE ad.type = 5
GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_depense),EXTRACT(YEAR FROM pa.date_paiement_depense)     
ORDER BY ad.id_acte_depense;

--CALCUL BENEFICE


SELECT 
    SUM(recette.sum) AS total_prix,
    SUM(recette.budget) AS total_budget,
    SUM(recette.sum) * 100 /  SUM(recette.budget) AS realisation
FROM (

SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
COALESCE(SUM(pa.prix), 0) AS sum, ba.montant / 12 AS budget,
COALESCE((SUM(pa.prix) * 100) / (ba.montant / 12), 0) AS realisation,
COALESCE(EXTRACT(MONTH FROM pa.date_paiement_acte),4) AS mois, 
COALESCE(EXTRACT(YEAR FROM pa.date_paiement_acte),2024) AS annee
FROM acte_depense ad
LEFT JOIN paiement_acte pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_acte) = 4 AND EXTRACT(YEAR FROM pa.date_paiement_acte) = 2024
LEFT JOIN budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense  AND ba.annee = 2024
WHERE ad.type = 1
GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_acte),EXTRACT(YEAR FROM pa.date_paiement_acte)     
ORDER BY  ad.id_acte_depense ) AS recette;



SELECT 
    SUM(depense.sum) AS total_prix,
    SUM(depense.budget) AS total_budget,
    SUM(depense.sum) * 100 /  SUM(depense.budget) AS realisation
FROM (

SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
COALESCE(SUM(pa.montant), 0) AS sum, ba.montant / 12 AS budget,
COALESCE((SUM(pa.montant) * 100) / (ba.montant / 12), 0) AS realisation,
COALESCE(EXTRACT(MONTH FROM pa.date_paiement_depense),4) AS mois,  
COALESCE(EXTRACT(YEAR FROM pa.date_paiement_depense),2024) AS annee
FROM  acte_depense ad
LEFT JOIN  paiement_depense pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_depense) = 4 AND EXTRACT(YEAR FROM pa.date_paiement_depense) = 2024
LEFT JOIN  budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense AND ba.annee = 2024
WHERE ad.type = 5
GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_depense),EXTRACT(YEAR FROM pa.date_paiement_depense)     
ORDER BY ad.id_acte_depense ) AS depense;





