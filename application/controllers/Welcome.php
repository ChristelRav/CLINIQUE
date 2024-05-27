<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index(){
		$_SESSION['boogy'] = 'RUN';
		$this->load->view('welcome_message');
	}		
	public function go(){
		echo $_SESSION['boogy'];
	}
}
