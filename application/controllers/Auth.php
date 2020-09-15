<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function login(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('login');
		// $this->display_page('mybookings', $setting);
	}
	
	public function register(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('register');
		// $this->display_page('mybookings', $setting);
	}
	
	public function actRegister(){
		$setting = array(
			'title' => 'My Bookings'
		);

		$this->load->view('../function/actRegister');
		// $this->display_page('mybookings', $setting);
	}

	//display
	private function display_page($main_content, $setting=null, $data=null){
		$this->load->view("template/header", $setting);
		$this->load->view($main_content,$data);
		$this->load->view("template/footer");
	}
}
