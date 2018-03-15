<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model  {

	public function __construct()
	{
		$db_obj = $this->load->database('db1',TRUE);
		$connected = $db_obj->initialize();
		if (!$connected) {
			echo "Not connected ";
		}
		else if($connected){
			// echo "Connected successfully";
		} 
	}

	public function authenticateUser($data){

		$response = array();

		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('username',$data["username"]);
		$this->db->where('password',$data["password"]);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row){
				// Prepare a response
				$response = array('status' => 200, 'message' => 'Authentication successful', 'data'=> $row);
			}
		}
		else{			
			// Prepare a response
			$response = array('status' => 404, 'message' => 'Authentication Failed');
		}

		return $response;
		
	}
}
