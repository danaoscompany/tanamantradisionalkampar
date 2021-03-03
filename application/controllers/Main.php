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
	
	public function tambah_tanaman() {
		$table_name = $this->input->post('table_name');
		$id = intval($this->input->post('id'));
		$judul = $this->input->post('judul');
		$artist = $this->input->post('artist');
		$album = $this->input->post('album');
		$lirik_lagu = $this->input->post('lirik_lagu');
		$link = $this->input->post('link');
        $tanamanCount = $this->db->query("SELECT * FROM `" . $table_name . "` WHERE `ID_Lagu`=" . $id)->num_rows();
        if ($tanamanCount > 0) {
        	return;
        }
		$config['upload_path']          = './userdata/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 2147483647;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
        	$this->db->insert($table_name, array(
				'ID_Lagu' => $id,
				'Judul' => $judul,
				'Artist' => $artist,
				'Gambar' => $this->upload->data()['file_name'],
				'Album' => $album,
				'Lirik_Lagu' => $lirik_lagu,
				'Link' => $link
			));
        } else {
        	echo json_encode($this->upload->display_errors());
        }
	}
	
	public function edit_tanaman() {
		$table_name = $this->input->post('table_name');
		$id = intval($this->input->post('id'));
		$judul = $this->input->post('judul');
		$artist = $this->input->post('artist');
		$album = $this->input->post('album');
		$lirik_lagu = $this->input->post('lirik_lagu');
		$link = $this->input->post('link');
		$config['upload_path']          = './userdata/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 2147483647;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
        	$this->db->where('ID_Lagu', $id);
        	$this->db->update($table_name, array(
				'Judul' => $judul,
				'Artist' => $artist,
				'Gambar' => $this->upload->data()['file_name'],
				'Album' => $album,
				'Lirik_Lagu' => $lirik_lagu,
				'Link' => $link
			));
        } else {
        	echo json_encode($this->upload->display_errors());
        }
	}
	
	public function hapus_tanaman() {
		$table_name = $this->input->post('table_name');
		$id = intval($this->input->post('id'));
		$this->db->query("DELETE FROM `" . $table_name . "` WHERE `ID_Lagu`=" . $id);
	}
}
