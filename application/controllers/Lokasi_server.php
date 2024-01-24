<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_server extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Lokasi_server_model');
	}

	public function index()
	{
		$data['title'] = 'Data Lokasi Server';
		$data['lokasi_server'] = $this->Lokasi_server_model->dapat_lokasi_server();

		$this->load->view('templates/header', $data);
		$this->load->view('manajer/lokasi_server/lokasi_server', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_lokasi_server()
	{
		$data['title'] = 'Tambah Lokasi Server';
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/lokasi_server/tambah_lokasi_server', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_lokasi_server()
	{
		$this->form_validation->set_rules('lokasi_server', 'Nama Lokasi Server', 'required|trim|is_unique[t_lokasi_server.lokasi_server]');

		if ($this->form_validation->run() == false) {
			$this->tambah_lokasi_server();
		} else {
			$data = array(
				'lokasi_server' => $this->input->post('lokasi_server')
			);

			$result = $this->Lokasi_server_model->tambah_lokasi_server($data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Lokasi Server Berhasil Ditambahkan</strong>
																<i class="bi bi-check-circle-fill"></i>');
				redirect('manajer/data-lokasi-server');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Lokasi Server Gagal Ditambahkan</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
				redirect('manajer/data-lokasi-server');
			}
		}
	}

	public function edit_lokasi_server()
	{
		$data['lokasi_server'] = $this->Lokasi_server_model->dapat_satu_lokasi_server($this->input->post('id_lokasi_server'));
		$data['title'] = 'Edit Lokasi Server';
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/lokasi_server/edit_lokasi_server', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_lokasi_server()
	{
		$this->form_validation->set_rules('lokasi_server', 'Nama Lokasi Server', 'required|trim|callback_check_lokasi_server');

		if ($this->form_validation->run() == false) {
			$this->edit_lokasi_server();
		} else {
			$data = array(
				'lokasi_server' => $this->input->post('lokasi_server')
			);

			$result = $this->Lokasi_server_model->edit_lokasi_server($this->input->post('id_lokasi_server'), $data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Lokasi Server Berhasil Di edit</strong>
																<i class="bi bi-check-circle-fill"></i>');
				redirect('manajer/data-lokasi-server');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Lokasi Server Gagal Di edit</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
				redirect('manajer/data-lokasi-server');
			}
		}
	}

	public function proses_hapus_lokasi_server()
	{
		$this->db->where('id_lokasi_server', $this->input->post('id_lokasi_server'));
		$this->db->delete('t_lokasi_server');
		$this->session->set_flashdata('message', '<strong>Data Lokasi Server Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('manajer/data-lokasi-server');
	}

	public function check_lokasi_server($lokasi_server)
	{
		$check_data = $this->Lokasi_server_model->dapat_satu_lokasi_server($this->input->post('id_lokasi_server'));
		if ($lokasi_server == $check_data->lokasi_server) {
			$this->form_validation->set_message('check_lokasi_server', 'Jika ingin merubah data, maka ganti nama lokasi server dengan yang berbeda.');
			return false;
		}
		return true;
	}
}
