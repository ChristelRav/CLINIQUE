<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Acte_Depense extends CI_Model{
    public function list_acte_depense($where) {
        $this->db->select("*");
        $this->db->from('acte_depense');
        $this->db->where('type', $where);
        $query = $this->db->get();
        return $query->result();
    }
    public function getOne($where) {
        $this->db->where('id_acte_depense', $where);
        $query = $this->db->get('acte_depense'); 
        return $query->row(); 
    }
    public function insert($col1,$col2,$col3,$col4) {
        $sql = "insert into  acte_depense (code, nom,budget, type) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3),$this->db->escape($col4));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function update($id,$col1,$col2) {
        $sql = "update acte_depense set nom =%s  , budget =%s where id_acte_depense =%s";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($id));
        $this->db->query($sql);
    }
    public function insert_budget($col1,$col2,$col3) {
        $sql = "insert into budget_annuel (id_acte_depense, montant, annee)  values ( %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
}
?>