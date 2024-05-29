<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Patient');
        $this->load->model('MD_Acte_Depense');
        $this->load->model('MD_Paiement_Depense');
        $this->load->model('MD_Paiement_Acte');
        $this->load->model('MD_Benefice');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $date = date('Y-m-d'); 
        $dateTime = new DateTime($date);
        $an = $dateTime->format('Y');
        $mois = $dateTime->format('m');
        $data['recette'] = $this->MD_Paiement_Acte->getRecettes($mois,$an);
        $data['depense'] = $this->MD_Paiement_Depense->getDepenses($mois,$an);
        $data['benefice'] = $this->MD_Benefice->getBenefice($mois,$an);
        $data['mois'] = array("janvier", "février", "mars","avril","mai","juin", "juillet","aout","septembre","octobre","novembre","décembre");
        $this->viewer('v_a_statistique',$data);
	}	
    public function getDash(){
        $data['recette'] = $this->MD_Paiement_Acte->getRecettes($_POST['mois'],$_POST['an']);
        $data['depense'] = $this->MD_Paiement_Depense->getDepenses($_POST['mois'],$_POST['an']);
        $data['benefice'] = $this->MD_Benefice->getBenefice($_POST['mois'],$_POST['an']);
        $data['mois'] = array("janvier", "février", "mars","avril","mai","juin", "juillet","aout","septembre","octobre","novembre","décembre");
        $this->viewer('v_a_statistique',$data);
    }
}
