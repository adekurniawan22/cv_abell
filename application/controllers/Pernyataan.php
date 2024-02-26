<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pernyataan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('jabatan'))) {
			$this->session->set_flashdata('message', '<strong>Akses ditolak, silahkan login terlebih dahulu!</strong>
		                <i class="bi bi-exclamation-circle-fill"></i>');
			redirect('login-pegawai');
		}
		$this->load->library('form_validation');
		$this->load->model('Pernyataan_model');
	}

	public function index()
	{
		$data['title'] = 'Data Pernyataan';
		$data['pernyataan'] = $this->Pernyataan_model->dapat_pernyataan();

		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pernyataan/pernyataan', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_pernyataan()
	{
		$data['title'] = 'Tambah pernyataan';
		$data['dimensi'] = $this->Pernyataan_model->dapat_dimensi();
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pernyataan/tambah_pernyataan', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_pernyataan()
	{
		$this->form_validation->set_rules('id_dimensi', 'Dimensi', 'required');
		$this->form_validation->set_rules('pernyataan', 'Pernyataan', 'required|trim');
		$this->form_validation->set_rules('rekomendasi_perbaikan', 'Rekomendasi Perbaikan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->tambah_pernyataan();
		} else {
			$data = array(
				'id_dimensi' => $this->input->post('id_dimensi'),
				'pernyataan' => $this->input->post('pernyataan'),
				'rekomendasi_perbaikan' => $this->input->post('rekomendasi_perbaikan'),
			);

			$result = $this->Pernyataan_model->tambah_pernyataan($data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pernyataan Berhasil Ditambahkan</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pernyataan Gagal Ditambahkan</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('manajer/data-pernyataan');
		}
	}

	public function edit_pernyataan()
	{
		$data['title'] = 'Edit pernyataan';
		$data['dimensi'] = $this->Pernyataan_model->dapat_dimensi();
		$data['pernyataan'] = $this->Pernyataan_model->dapat_satu_pernyataan($this->input->post('id_pernyataan'));
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pernyataan/edit_pernyataan', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_pernyataan()
	{
		$this->form_validation->set_rules('id_dimensi', 'Dimensi', 'required');
		$this->form_validation->set_rules('pernyataan', 'Pernyataan', 'required|trim');
		$this->form_validation->set_rules('rekomendasi_perbaikan', 'Rekomendasi Perbaikan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->edit_pernyataan();
		} else {
			$data = array(
				'id_dimensi' => $this->input->post('id_dimensi'),
				'pernyataan' => $this->input->post('pernyataan'),
				'rekomendasi_perbaikan' => $this->input->post('rekomendasi_perbaikan'),
			);

			$result = $this->Pernyataan_model->edit_pernyataan($this->input->post('id_pernyataan'), $data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pernyataan Berhasil Di edit</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pernyataan Gagal Di edit</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('manajer/data-pernyataan');
		}
	}


	public function proses_hapus_pernyataan()
	{
		$this->db->where('id_pernyataan', $this->input->post('id_pernyataan'));
		$this->db->delete('t_pernyataan');
		$this->session->set_flashdata('message', '<strong>Data pernyataan Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('manajer/data-pernyataan');
	}
}
