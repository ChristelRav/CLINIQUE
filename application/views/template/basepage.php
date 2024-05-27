<?php 

$this->load->view('template/header');

$this->load->view('template/menu');

$this->load->view('template/navbar');

$this->load->view('pages/'.$page,$data);

$this->load->view('template/footer');
?>