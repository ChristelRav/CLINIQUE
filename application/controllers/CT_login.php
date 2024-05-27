<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Login extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MD_Utilisateur');
    }
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
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
		$this->load->view('pages/v_login',$data);
	}
    public function login(){
        echo $_POST['email'].' --- '.$_POST['mdp'];
        $user = $this->MD_Utilisateur->verify($_POST['email'], $_POST['mdp']);
        if ($user){
            $this->session->set_userdata('user', $user);
            redirect('Welcome/go');
            return;
        }
        else{
            $data['error'] = 'Email ou mot de passe invalide';
        }
        redirect('CT_Login/index?error=' . urlencode($data['error']));
	}
    public function deconnect()	{
        $this->session->unset_userdata('user');
        redirect('CT_Login/');
    }
}
