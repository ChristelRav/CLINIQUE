<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Import extends CI_Model{
    public function read($nom) {
        if (isset($_FILES[$nom]['name']) && $_FILES[$nom]['name'] != '') {
            $path = $_FILES[$nom]['tmp_name'];
            $file = fopen($path, 'r');
            $csv_data = [];
            $ln = 0;
            $fl = true;
            $erreur = [];
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                $ln++;
                if ($fl) {
                    $fl = false;
                    continue; 
                }
                $csv_data[] = $line;   
                echo $line[0].' -- '.$line[1].' -- '.$line[2].'<br>';
                $erreur[$ln] = $this->controle($ln, $line[0], $line[2]);
            }
            echo  'ERREUR  ===='.count($erreur) ;
            if(isset($erreur)){
                 $data['erreur'] = $erreur;
                 return $data;
            }else{
                //CODE INSERTION
                echo 'ALLOUIAAAAAA<br>';
                return ;
            }
            fclose($file);
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
        }
    }
    public function controle($ln,$date,$montant){
        $this->load->model('MD_Csv');
        $erreur_date = [];
        if (!$this->MD_Csv->is_valid_date($date)) {$erreur_date[] = 'Date invalide';  echo $date.'???<br>';}
        if (!$this->MD_Csv->is_positive($montant)) {$erreur_date[] = 'Montant invalide';   echo $montant.'!!!<br>';}
        echo 'TTT = '.count($erreur_date).'<br>';
        return $erreur_date;
    }
    public function tab_Erreur($resultat_import){
        $erreurs = [];
        foreach ($resultat_import['erreur'] as $ligne => $erreurs_ligne) {
            foreach ($erreurs_ligne as $erreur) {
                $erreurs[] = "Ligne $ligne : $erreur";
            }
        }
        return $erreurs;
    }
}
?>