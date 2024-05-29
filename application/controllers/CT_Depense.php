<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Depense extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Patient');
        $this->load->model('MD_Acte_Depense');
        $this->load->model('MD_Paiement_Depense');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['mois'] = array("janvier", "février", "mars","avril","mai","juin", "juillet","aout","septembre","octobre","novembre","décembre");
        $data['depense'] = $this->MD_Acte_Depense->list_acte_depense(5);
        $data['list'] = $this->MD_Paiement_Depense->list_paiement_utilisateur($_SESSION['user'][0]['id_utilisateur']);
        $this->viewer('v_saisie_depense',$data);
	}	
    public function inserer_depense(){
        $an = $_POST['an']; $depense = $_POST['depense']; $montant = $_POST['montant'];
        $mois = $_POST['mois']; $j = $_POST['jour'];
        echo $an.' ---- '.$depense.'  ----  '.$montant.' --- '.$j.'<br>';
        for ($i=0; $i < count($mois); $i++) { 
            echo $mois[$i].'<br>';
            $date = $an . '-' .$mois[$i]. '-' . $j;
            echo 'DP = '.$date;
            $this->MD_Paiement_Depense->insert($_SESSION['user'][0]['id_utilisateur'],$depense,$montant,$date);
        }
        redirect('CT_Depense');
    }
    public function import_csv(){
        if (isset($_FILES['csv_file']['name']) && $_FILES['csv_file']['name'] != '') {
            $path = $_FILES['csv_file']['tmp_name'];
            $file = fopen($path, 'r');
            $csv_data = [];
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                echo $line[0].' -- '.$line[1].' -- '.$line[2].'<br>';
            }
            fclose($file);
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
        }
    }
}
