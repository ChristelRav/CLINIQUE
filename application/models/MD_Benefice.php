<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Benefice extends CI_Model{
    public function getBenefice($mois,$annee) {
        $this->load->model('MD_Paiement_Depense');
        $this->load->model('MD_Paiement_Acte');
        $recette = $this->MD_Paiement_Acte->getSom_Recettes($mois,$annee);
        $depense = $this->MD_Paiement_Depense->getSom_Depenses($mois,$annee);
        $reel = $recette->total_prix - $depense->total_prix;
        $budget =  $recette->total_budget - $depense->total_budget;
        $realisation = ($budget != 0) ? ($reel * 100 / $budget) : 0;

        $tab = array(
            array(
                'type' => 'RECETTE',
                'total' => $recette->total_prix,
                'budget' => $recette->total_budget,
                'realisation' => $recette->realisation
            ),
            array(
                'type' => 'DEPENSE',
                'total' => $depense->total_prix,
                'budget' => $depense->total_budget,
                'realisation' => $depense->realisation
            ),
            array(
                'type' => '',
                'total' => $reel,
                'budget' => $budget,
                'realisation' => $realisation
            )
        );
        return $tab;
    }
}
?>