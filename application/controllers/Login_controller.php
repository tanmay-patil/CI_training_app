<?php
defined('BASEPATH') OR exit('No direct script access allowed in Login controller');

class Login_controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {

		//use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
		parent::__construct();
		
		$this->load->view('header/header');
		$this->load->model('Login_model');
	}

	 public function index(){

		$this->load->view('Login_view');
	
	}

	public function login(){


		// Check form submit or not
		if($this->input->post('submit', TRUE) == NULL){
			// Read POST data for transferring to model
			$loginData["username"] = $this->input->post('username', TRUE);
			$loginData["password"] = $this->input->post('password', TRUE);
			$authenticationStatus = $this->authenticateUser($loginData);

			// If auth succeeds
			if($authenticationStatus != false){
				$userType = $authenticationStatus["data"]->type;
				// Check the access type of the user
				if($userType == 1){	// Admin
					// ADMIN USER
					redirect('../Admin_controller/home');
				}
				else if($userType == 2){	// User
					// NORMAL USER
					redirect('../User_controller/home');
				}

			}
			else{
				// Route the user back to login page
			}
		}
		
	}

	public function authenticateUser($data){
		$result = $this->Login_model->authenticateUser($data);
		
		if($result["status"] == 200){
			return $result;
		}
		else{
			return false;
		}
	}
}
