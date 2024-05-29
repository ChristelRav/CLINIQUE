<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Paiement_acte extends CI_Controller {
    public function __construct() {
        parent::__construct();
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
       $this->MD_Paiement_Acte->insert($_SESSION['user'][0]['id_utilisateur'],$_POST['id'],$_POST['acte'],$_POST['montant']);
       redirect('CT_Patient/detail_acte?id='.$_POST['id']);
	}	
    public function facture(){
        //--PDF
        $this->load->library('Tableau');
        $header = array('code', 'désignation', 'date_paiement', 'montant');
        $resultats = $this->MD_Paiement_Acte->getFacture_actuel($_GET['id']);
        $som = $this->MD_Paiement_Acte->somFacture_actuel($_GET['id']);
        $pdf = new Tableau();
        $pdf->AddPage();
        $pdf->details($header,$resultats,$som);
        $pdf->Output();
    }
}
