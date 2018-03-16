<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

    public function __construct(){  
        
        //use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
		parent::__construct();
        
		$this->load->view('header/all_script_links');
		$this->load->view('layout/top-bar');
    }

	public function index(){

         if($this->isLoggedIn()){

            // Check if not an admin
            if($this->isAdmin()){
                redirect('../'.ADMIN_CONTROLLER.'/home');
            }
            else{
                // Redirect to login page
                redirect('../'.LOGIN_CONTROLLER.'');
            }
        }
        else{
            // Redirect to login page
            redirect('../'.LOGIN_CONTROLLER.'');
        }

    }

    public function home(){
        $this->load->view('admin/home_view');
    }

    public function isAdmin(){
        if($this->session->userdata("access_type") == 1){
            return true;
        }
        else{
            return false;
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