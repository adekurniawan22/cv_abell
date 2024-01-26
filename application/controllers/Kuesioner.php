<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Kuesioner_model');
	}

	public function index()
	{
		$data['title'] = 'Data Kuesioner';
		$data['kuesioner'] = $this->Kuesioner_model->dapat_kuesioner();

		$this->load->view('templates/header', $data);
		$this->load->view('admin/kuesioner/kuesioner', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_kuesioner()
	{
		$data['title'] = 'Tambah Kuesioner';
		$this->load->view('templates/header', $data);
		$this->load->view('admin/kuesioner/tambah_kuesioner', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_kuesioner()
	{
		$data = array(
			'judul_kuesioner' => $this->input->post('judul_kuesioner'),
			'mulai' => $this->input->post('mulai'),
			'selesai' => $this->input->post('selesai'),
			'id_pengguna' => $this->session->userdata('id_pengguna'),
		);

		$result = $this->Kuesioner_model->tambah_kuesioner($data);
		$id_kuesioner = $this->db->insert_id();

		foreach ($_POST['pernyataan'] as $p) {
			$data_pernyataan = [
				'id_kuesioner' => $id_kuesioner,
				'pernyataan' => $p,
			];

			$this->Kuesioner_model->tambah_pernyataan($data_pernyataan);
		}

		if ($result) {
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Ditambahkan</strong>
															<i class="bi bi-check-circle-fill"></i>');
		} else {
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Gagal Ditambahkan</strong>
													<i class="bi bi-exclamation-circle-fill"></i>');
		}
		redirect('admin/data-kuesioner');
	}

	// public function edit_lokasi_server()
	// {
	// 	$data['lokasi_server'] = $this->Lokasi_server_model->dapat_satu_lokasi_server($this->input->post('id_lokasi_server'));
	// 	$data['title'] = 'Edit Lokasi Server';
	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('manajer/lokasi_server/edit_lokasi_server', $data);
	// 	$this->load->view('templates/footer');
	// }

	// public function proses_edit_lokasi_server()
	// {
	// 	$this->form_validation->set_rules('lokasi_server', 'Nama Lokasi Server', 'required|trim|callback_check_lokasi_server');

	// 	if ($this->form_validation->run() == false) {
	// 		$this->edit_lokasi_server();
	// 	} else {
	// 		$data = array(
	// 			'lokasi_server' => $this->input->post('lokasi_server')
	// 		);

	// 		$result = $this->Lokasi_server_model->edit_lokasi_server($this->input->post('id_lokasi_server'), $data);

	// 		if ($result) {
	// 			$this->session->set_flashdata('message', '<strong>Data Lokasi Server Berhasil Di edit</strong>
	// 															<i class="bi bi-check-circle-fill"></i>');
	// 			redirect('manajer/data-lokasi-server');
	// 		} else {
	// 			$this->session->set_flashdata('message', '<strong>Data Lokasi Server Gagal Di edit</strong>
	// 													<i class="bi bi-exclamation-circle-fill"></i>');
	// 			redirect('manajer/data-lokasi-server');
	// 		}
	// 	}
	// }

	public function proses_hapus_kuesioner()
	{
		$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
		$this->db->delete('t_kuesioner');
		$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('admin/data-kuesioner');
	}
}
