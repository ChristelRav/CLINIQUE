<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Paiement_Acte extends CI_Model{
    public function list_paiement_patient($where) {
        $this->db->select("*");
        $this->db->from('v_detail_acte');
        $this->db->where('id_patient', $where);
        $query = $this->db->get();
        return $query->result();
    }
    public function getOne($where) {
        $this->db->where('id_paiement_acte', $where);
        $query = $this->db->get('paiement_acte'); 
        return $query->row(); 
    }
    public function insert($col1,$col2,$col3,$col4) {
        $sql = "insert into  paiement_acte (id_utilisateur, id_patient, id_acte_depense, prix) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3),$this->db->escape($col4));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function getFacture_actuel($where){
        $this->db->select("id_patient , id_acte_depense,  date_paiement_acte , SUM(prix) as prix,acte,code , patient,date_naissance,genre");
        $this->db->from('v_facture_actuel');
        $this->db->where('id_patient', $where);
        $this->db->group_by('id_patient , id_acte_depense,  date_paiement_acte,acte,code , patient,date_naissance,genre');
        $query = $this->db->get();
        return $query->result();
    }
    public function somFacture_actuel($where){
        $this->db->select("date_paiement_acte , SUM(prix) as total , id_patient , patient,date_naissance,genre");
        $this->db->from('v_facture_actuel');
        $this->db->where('id_patient', $where);
        $this->db->group_by('id_patient ,  date_paiement_acte, patient,date_naissance,genre');
        $query = $this->db->get();
        return $query->row();
    }
    public function getRecettes($mois, $annee) {
        $sql = "SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
        COALESCE(SUM(pa.prix), 0) AS sum, ba.montant / 12 AS budget,
        COALESCE((SUM(pa.prix) * 100) / (ba.montant / 12), 0) AS realisation,
        COALESCE(EXTRACT(MONTH FROM pa.date_paiement_acte),%s) AS mois, 
        COALESCE(EXTRACT(YEAR FROM pa.date_paiement_acte),%s) AS annee
        FROM acte_depense ad
        LEFT JOIN paiement_acte pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_acte) = %s AND EXTRACT(YEAR FROM pa.date_paiement_acte) = %s
        LEFT JOIN budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense  AND ba.annee = %s
        WHERE ad.type = 1
        GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_acte),EXTRACT(YEAR FROM pa.date_paiement_acte)     
        ORDER BY  ad.id_acte_depense;
        ";
        $formatted_sql = sprintf( $sql, $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($annee));
        $query = $this->db->query($formatted_sql);
        return $query->result();
    }
    public function getSom_Recettes($mois, $annee) {
        $sql = "
        SELECT 
            SUM(recette.sum) AS total_prix,
            SUM(recette.budget) AS total_budget,
            SUM(recette.sum) * 100 /  SUM(recette.budget) AS realisation
        FROM (
        SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
        COALESCE(SUM(pa.prix), 0) AS sum, ba.montant / 12 AS budget,
        COALESCE((SUM(pa.prix) * 100) / (ba.montant / 12), 0) AS realisation,
        COALESCE(EXTRACT(MONTH FROM pa.date_paiement_acte),%s) AS mois, 
        COALESCE(EXTRACT(YEAR FROM pa.date_paiement_acte),%s) AS annee
        FROM acte_depense ad
        LEFT JOIN paiement_acte pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_acte) = %s AND EXTRACT(YEAR FROM pa.date_paiement_acte) = %s
        LEFT JOIN budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense  AND ba.annee = %s
        WHERE ad.type = 1
        GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_acte),EXTRACT(YEAR FROM pa.date_paiement_acte)     
        ORDER BY  ad.id_acte_depense ) AS recette;
        ";
        $formatted_sql = sprintf( $sql, $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($annee));
        $query = $this->db->query($formatted_sql);
        return $query->row();
    }
}
?>