<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pengguna_model');
	}

	public function index()
	{
		$data['title'] = 'Data Pengguna';
		$data['pengguna'] = $this->Pengguna_model->dapat_pengguna();
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pengguna/pengguna', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_pengguna()
	{
		$data['role'] =  $this->db->get('t_role')->result();
		$data['title'] = 'Tambah Pengguna';
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pengguna/tambah_pengguna', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_pengguna()
	{
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[t_pengguna.username]|regex_match[/^[a-z0-9]+$/]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[t_pengguna.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|integer');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');

		if ($this->form_validation->run() == false) {
			$this->tambah_pengguna();
		} else {
			$data = array(
				'id_role' => (int) $this->input->post('role'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'lokasi' => $this->input->post('lokasi'),
			);

			$result = $this->Pengguna_model->tambah_pengguna($data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pengguna Berhasil Ditambahkan</strong>
																<i class="bi bi-check-circle-fill"></i>');
				redirect('manajer/data-pengguna');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pengguna Gagal Ditambahkan</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
				redirect('manajer/data-pengguna');
			}
		}
	}
	public function edit_pengguna()
	{
		$data['role'] =  $this->db->get('t_role')->result();
		$data['title'] = 'Edit Pengguna';
		$data['pengguna'] = $this->Pengguna_model->dapat_satu_pengguna($this->input->post('id_pengguna'));
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pengguna/edit_pengguna', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_pengguna()
	{
		$check_data_user = $this->Pengguna_model->dapat_satu_pengguna($this->input->post('id_pengguna'));

		if ($this->input->post('username') != $check_data_user->username) {
			$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[t_pengguna.username]');
		}
		if ($this->input->post('email') != $check_data_user->email) {
			$this->form_validation->set_rules('email', 'email', 'required|trim|is_unique[t_pengguna.email]');
		}
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|integer');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$status_aktif = ($this->input->post('status_aktif') == 'on') ? '1' : '0';

		if ($this->form_validation->run() == false) {
			$this->edit_pengguna();
		} else {
			$data = array(
				'id_role' => (int) $this->input->post('role'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'lokasi' => $this->input->post('lokasi'),
				'status_aktif' => $status_aktif
			);

			$result = $this->Pengguna_model->edit_pengguna($this->input->post('id_pengguna'), $data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pengguna Berhasil Diedit</strong>
															<i class="bi bi-check-circle-fill"></i>');
				redirect('manajer/data-pengguna');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pengguna Gagal Diedit</strong>
													<i class="bi bi-exclamation-circle-fill"></i>');
				redirect('manajer/data-pengguna');
			}
		}
	}

	public function proses_hapus_pengguna()
	{
		$this->db->where('id_pengguna', $this->input->post('id_pengguna'));
		$this->db->delete('t_pengguna');
		$this->session->set_flashdata('message', '<strong>Data Pengguna Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('manajer/data-pengguna');
	}
}
