<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Depense extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Patient');
        $this->load->model('MD_Acte_Depense');
        $this->load->model('MD_Paiement_Depense');
        $this->load->model('MD_Import');
        $this->load->model('MD_Csv');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data = array();
        if ($this->input->get('erreur') != null) {
            $data['erreur'] = explode(',', urldecode($this->input->get('erreur')));
        } else if ($this->input->get('succes') != null) {
            $data['succes'] = urldecode($this->input->get('succes'));
        }
        $data['mois'] = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "décembre");
        $data['depense'] = $this->MD_Acte_Depense->list_acte_depense(5);
        $data['list'] = $this->MD_Paiement_Depense->list_paiement_utilisateur($_SESSION['user'][0]['id_utilisateur']);
        $this->viewer('v_saisie_depense', $data);
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
        $resultat_import = $this->MD_Import->read('csv_file');
        //var_dump($resultat_import['erreur']);
    
        // Vérifier si $resultat_import['erreur'] contient des erreurs valides
        $hasErrors = false;
        foreach ($resultat_import['erreur'] as $ligne => $erreurs) {
            if (!empty($erreurs)) {
                $hasErrors = true;
                break;
            }
        }
    
        if ($hasErrors) {
            foreach ($resultat_import['erreur'] as $ligne => $erreurs) {
                foreach ($erreurs as $erreur) {
                    echo "Erreur à la ligne $ligne : $erreur <br>";
                }
            }
            $e = $this->MD_Import->tab_Erreur($resultat_import);
            $d = implode(',', $e);
            echo "KKKKKKKKKKKKKKKKKKKKKKKK";
            redirect('CT_Depense/index?erreur=' . urlencode($d));
        } else {
            echo "TTTTTTTTTTTTTTTTTTTT";
            $data['succes'] = 'Données traitées correctement';
            redirect('CT_Depense/index?succes=' . urlencode($data['succes']));
        }
    }
    
    
    
}
