<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Patient extends CI_Model{
    public function list() {
        $this->db->select("*");
        $this->db->from('patient');
        $query = $this->db->get();
        $patients = $query->result();
        foreach ($patients as $patient) {
            if ($patient->genre == 1) {
                $patient->genre = 'Homme';
            } elseif ($patient->genre == 2) {
                $patient->genre = 'Femme';
            }
            if ($patient->remboursement == 't') {
                $patient->color = '#a2a3f1';
            } else {
                $patient->color = '#e69595';
            }
        }
        return $patients;
    }
}
?>