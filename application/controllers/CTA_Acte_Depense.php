<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Acte_Depense extends CI_Controller {
	private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data = array();
		$this->viewer('v_a_liste_acte_depense',$data);
	}	
}
