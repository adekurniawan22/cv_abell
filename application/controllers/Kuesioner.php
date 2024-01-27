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

		if ($this->session->userdata('role') == 'Manajer') {
			$this->load->view('templates/header', $data);
			$this->load->view('manajer/kuesioner/kuesioner', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('templates/header', $data);
			$this->load->view('admin/kuesioner/kuesioner', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('role') == 'Pelanggan') {
			$this->load->view('templates/header', $data);
			$this->load->view('pelanggan/kuesioner/kuesioner', $data);
			$this->load->view('templates/footer');
		}
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

	public function edit_kuesioner()
	{
		$data['title'] = 'Edit Kuesioner';
		$data['kuesioner'] = $this->Kuesioner_model->dapat_satu_kuesioner($this->input->post('id_kuesioner'));
		$data['pernyataan'] = $this->Kuesioner_model->dapat_pernyataan($this->input->post('id_kuesioner'));
		$this->load->view('templates/header', $data);
		$this->load->view('admin/kuesioner/edit_kuesioner', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_kuesioner()
	{
		try {

			$data_kuesioner = [
				'judul_kuesioner' => $this->input->post('judul_kuesioner'),
				'mulai' => $this->input->post('mulai'),
				'selesai' => $this->input->post('selesai'),
			];

			$this->Kuesioner_model->edit_kuesioner($this->input->post('id_kuesioner'), $data_kuesioner);


			for ($i = 0; $i < count($_POST['id_pernyataan']); $i++) {
				$data_pernyataan = [
					'pernyataan' => $_POST['pernyataan'][$i],
				];

				$this->Kuesioner_model->edit_pernyataan($_POST['id_pernyataan'][$i], $data_pernyataan);
			}

			if (!empty($_POST['pernyataan_baru'])) {
				foreach ($_POST['pernyataan_baru'] as $p) {
					$data_pernyataan = [
						'id_kuesioner' => $this->input->post('id_kuesioner'),
						'pernyataan' => $p,
					];

					$this->Kuesioner_model->tambah_pernyataan($data_pernyataan);
				}
			}
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Diedit</strong>
															<i class="bi bi-check-circle-fill"></i>');
		} catch (Exception $e) {
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Gagal Diedit</strong>
													<i class="bi bi-exclamation-circle-fill"></i>');
		}
		redirect('admin/data-kuesioner');
	}


	public function proses_hapus_kuesioner()
	{
		$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
		$this->db->delete('t_kuesioner');
		$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('admin/data-kuesioner');
	}
}
