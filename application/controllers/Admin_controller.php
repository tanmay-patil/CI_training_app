<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

	public function home(){
        $this->load->view('admin/home_view');
    }
}
?>