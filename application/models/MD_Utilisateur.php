<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Utilisateur extends CI_Model{
    //login
    public function verify($email, $password) {
        $query = $this->db->get_where('utilisateur', array('email' => $email, 'mot_passe' => $password));
        $client = $query->result_array();
        return $client;
    }
}
?>