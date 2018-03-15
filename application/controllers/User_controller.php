<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

	public function home(){
        $this->load->view('user/home_view');
    }
}
?>