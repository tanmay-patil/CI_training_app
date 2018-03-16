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
		
		$this->load->view('header/all_script_links');
		$this->load->model('Login_model');
	}

	 public function index(){

		// Check if user is already logged in
		 if($this->isLoggedIn()){
			// Check if not an admin
            if($this->session->userdata("access_type") == 1){
				redirect('../'.ADMIN_CONTROLLER.'');
			}
			else if($this->session->userdata("access_type") == 2){
				redirect('../'.USER_CONTROLLER.'');
			}
		}
		else{
			// If not logged in yet
			$this->load->view('Login_view');
			// Clear all previous session data if user forgot to logout
			$this->session->sess_destroy();
		}

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

				/**** SET SESSION DATA ****/
				$this->setSessionData($authenticationStatus["data"]);

				// Check the access type of the user
				if($userType == 1){	// Admin
					// ADMIN USER
					// Redirect					
					redirect('../'.ADMIN_CONTROLLER.'');
				}
				else if($userType == 2){	// User
					// NORMAL USER
					redirect('../'.USER_CONTROLLER.'');
				}

			}
			else{
				// Route the user back to login page
				redirect('../Login_controller/loginFail');
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

	public function loginFail(){
		$data = array(
			'failed_attempt' => true
		);

		$this->load->view('Login_view', $data);
	}

	public function setSessionData($data){
		$sessionData = array(
		'username'  => $data->username,
		'access_type'     => $data->type);

		$this->session->set_userdata($sessionData);
	}

	public function isLoggedIn(){
        if($this->session->userdata("access_type") != null){
            return true;
        }
        else{
            return false;
        }
	}
	
	public function logout(){
		// Destroy the session
		$this->session->sess_destroy();
	}
}
