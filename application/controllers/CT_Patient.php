<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Patient extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Patient');
        $this->load->model('MD_Acte_Depense');
        $this->load->model('MD_Paiement_Acte');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['list'] = $this->MD_Patient->list();
		$this->viewer('v_a_liste_patient',$data);
	}	
    public function detail_acte(){
        $data['acte'] = $this->MD_Acte_Depense->list_acte_depense(1);
        $data['detail'] = $this->MD_Paiement_Acte->list_paiement_patient($_GET['id']);
        $data['id'] = $_GET['id'];
        $this->viewer('v_saisie_acte',$data);
    }
}
