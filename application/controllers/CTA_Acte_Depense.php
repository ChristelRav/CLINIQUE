<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Acte_Depense extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Acte_Depense');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['acte'] = $this->MD_Acte_Depense->list_acte_depense(1);
        $data['depense'] = $this->MD_Acte_Depense->list_acte_depense(5);
		$this->viewer('v_a_liste_acte_depense',$data);
	}	
    public function save_AD(){
        $this->MD_Acte_Depense->insert($_POST['code'],$_POST['nom'],$_POST['budget'],$_POST['type']);
        redirect('CTA_Acte_Depense');
    }
    public function updateA(){
        $dateTime = new DateTime(date('Y-m-d'));
        $annee = $dateTime->format('Y'); $fin = date('Y-m-d') - 1;
        $last = $this->MD_Acte_Depense->getOne($_POST['id']);
        $this->MD_Acte_Depense->insert_budget($_POST['id'],$last->budget,$fin);
        $this->MD_Acte_Depense->insert_budget($_POST['id'],$_POST['cent'],$annee);
        $this->MD_Acte_Depense->update($_POST['id'],$_POST['type'],$_POST['cent']);
        redirect('CTA_Acte_Depense');
    }
    public function updateD(){
        $dateTime = new DateTime(date('Y-m-d'));
        $annee = $dateTime->format('Y'); $fin = date('Y-m-d') -1;
        $last = $this->MD_Acte_Depense->getOne($_POST['id']);
        $this->MD_Acte_Depense->insert_budget($_POST['id'],$last->budget,$annee);
        $this->MD_Acte_Depense->insert_budget($_POST['id'],$_POST['cent'],$annee);
        $this->MD_Acte_Depense->update($_POST['id'],$_POST['type'],$_POST['cent']);
        redirect('CTA_Acte_Depense');
    }
    
}
