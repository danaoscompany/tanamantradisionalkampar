<?php

class Main extends CI_Controller {
	
	public function query() {
		$query = $this->input->post('query');
		echo json_encode($this->db->query($query)->result_array());
	}
	
	public function execute() {
		$query = $this->input->post('query');
		$this->db->query($query);
	}
}
