<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

    public function __construct(){        
        //use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
        parent::__construct();
        
        
		$this->load->view('header/all_script_links');
        $this->load->view('layout/top-bar');
    }

	public function index(){

        if($this->isLoggedIn()){

            // Check if not an admin
            if($this->session->userdata("access_type") == 2){
                $this->load->view('user/home_view');
            }
            else{
                // Redirect to login page
                redirect('../Login_controller');
            }
        }
        else{
            // Redirect to login page
            redirect('../Login_controller');
        }

    }

    public function isLoggedIn(){
        if($this->session->userdata("access_type") != null){
            return true;
        }
        else{
            return false;
        }
    }
}
?>