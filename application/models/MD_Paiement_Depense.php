<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Paiement_Depense extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_paiement_depense', $where);
        $query = $this->db->get('paiement_depense'); 
        return $query->row(); 
    }
    public function insert($col1,$col2,$col3,$col4) {
        $sql = "insert into paiement_depense (id_utilisateur, id_acte_depense, montant, date_paiement_depense) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3),$this->db->escape($col4));
        var_dump($sql);
        $this->db->query($sql);
        var_dump($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    
    public function list_paiement_utilisateur($where) {
        $this->db->select("*");
        $this->db->from('paiement_depense pa');
        $this->db->join('acte_depense ad', ' ad.id_acte_depense = pa.id_acte_depense');
        $this->db->where('pa.id_utilisateur', $where);
        $query = $this->db->get();
        return $query->result();
    }
    public function getDepenses($mois, $annee) {
        $sql = "
        SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
        COALESCE(SUM(pa.montant), 0) AS sum, ba.montant / 12 AS budget,
        COALESCE((SUM(pa.montant) * 100) / (ba.montant / 12), 0) AS realisation,
        COALESCE(EXTRACT(MONTH FROM pa.date_paiement_depense),%s) AS mois,  
        COALESCE(EXTRACT(YEAR FROM pa.date_paiement_depense),%s) AS annee
        FROM  acte_depense ad
        LEFT JOIN  paiement_depense pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_depense) = %s AND EXTRACT(YEAR FROM pa.date_paiement_depense) = %s
        LEFT JOIN  budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense AND ba.annee = %s
        WHERE ad.type = 5
        GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_depense),EXTRACT(YEAR FROM pa.date_paiement_depense)     
        ORDER BY ad.id_acte_depense";
        $formatted_sql = sprintf( $sql, $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($annee));
        $query = $this->db->query($formatted_sql);
        return $query->result();
    }
    public function getSom_Depenses($mois, $annee) {
        $sql = "
        SELECT 
        SUM(depense.sum) AS total_prix,
        SUM(depense.budget) AS total_budget,
        SUM(depense.sum) * 100 /  SUM(depense.budget) AS realisation
    FROM (
    SELECT ad.id_acte_depense, ba.id_acte_depense, ad.code, 
    COALESCE(SUM(pa.montant), 0) AS sum, ba.montant / 12 AS budget,
    COALESCE((SUM(pa.montant) * 100) / (ba.montant / 12), 0) AS realisation,
    COALESCE(EXTRACT(MONTH FROM pa.date_paiement_depense),%s) AS mois,  
    COALESCE(EXTRACT(YEAR FROM pa.date_paiement_depense),%s) AS annee
    FROM  acte_depense ad
    LEFT JOIN  paiement_depense pa ON ad.id_acte_depense = pa.id_acte_depense AND EXTRACT(MONTH FROM pa.date_paiement_depense) = %s AND EXTRACT(YEAR FROM pa.date_paiement_depense) = %s
    LEFT JOIN  budget_annuel ba ON ba.id_acte_depense = ad.id_acte_depense AND ba.annee = %s
    WHERE ad.type = 5
    GROUP BY ad.id_acte_depense, ba.id_acte_depense, ad.code,  ba.montant,EXTRACT(MONTH FROM pa.date_paiement_depense),EXTRACT(YEAR FROM pa.date_paiement_depense)     
    ORDER BY ad.id_acte_depense ) AS depense";
        $formatted_sql = sprintf( $sql, $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($mois), $this->db->escape($annee), $this->db->escape($annee));
        $query = $this->db->query($formatted_sql);
        return $query->row();
    }
}
?>