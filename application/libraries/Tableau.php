<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf.php');

class Tableau extends FPDF
{
    
   
    // En-tête
    function Header()
    {
        // Logo ou en-tête
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Facture Patient',0,1,'C');
        $this->Ln(10);
    }

    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    // Tableau amélioré
    function details($header, $resultats,$val)
    {
        // Couleurs, epaisseur du trait et police grasse
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0);
        $this->SetDrawColor(46,46,46);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','B',8);
        $this->Cell(8,5,'Patient:'.$val->patient);
        $this->Ln();
        $this->Cell(8,5,'Date Naissance:'.$val->date_naissance);
        $this->Ln();
        $this->Cell(8,5,'genre:'.$val->genre);
        $this->Ln();
        $this->Cell(8,5,'Date_Facture:'.$val->date_paiement_acte);
        $this->Ln();
        // En-tete
        $w = array(20, 60, 60, 40); // Ajustement des tailles des colonnes
        for($i=0; $i<count($header); $i++) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Donnees
            foreach ($resultats as $detail) {
                $this->Cell($w[0], 6, $detail->code, 'LR', 0);
                $this->Cell($w[1], 6, $detail->acte, 'LR', 0);
                $this->Cell($w[2], 6, $detail->date_paiement_acte, 'LR', 0, 'R');
                $this->Cell($w[3], 6,  number_format($detail->prix,2, ',', ' '), 'LR', 0, 'R');   
                $this->Ln();
            }
            $this->Cell($w[0], 6,'', 1, 0);
            $this->Cell($w[1], 6,'', 1, 0);
            $this->Cell($w[2], 6,'TOTAL', 1, 0, 'C');
            $this->Cell($w[3], 6, number_format($val->total,2, ',', ' '), 1, 0, 'R');   
            $this->Ln();
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(5);
    }
}
    
?>
