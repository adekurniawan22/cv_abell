<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pengguna_model');
	}

	public function index()
	{
		$data['title'] = 'Profil';
		$data['pengguna'] = $this->Pengguna_model->dapat_satu_pengguna($this->session->userdata('id_pengguna'));
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/profil/profil', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_profil()
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
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');

		if ($this->input->post('password_lama')) {
			$this->form_validation->set_rules('password_lama', 'Password Lama', 'callback_check_current_password');
			$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|callback_check_new_password');
			$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|trim|matches[password_baru]');
		}

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'lokasi' => $this->input->post('lokasi')
			);

			if ($this->input->post('password_lama')) {
				$data['password'] = password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT);
			}

			$result = $this->Pengguna_model->edit_pengguna($this->input->post('id_pengguna'), $data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Profil Berhasil Diedit</strong>
															<i class="bi bi-check-circle-fill"></i>');
				redirect('pelanggan/dashboard');
			} else {
				$this->session->set_flashdata('message', '<strong>Profil Gagal Diedit</strong>
													<i class="bi bi-exclamation-circle-fill"></i>');
				redirect('pelanggan/dashboard');
			}
		}
	}

	public function check_current_password($current_password)
	{
		$id_pengguna = $this->session->userdata('id_pengguna'); // Gantilah dengan cara Anda menyimpan ID pengguna
		$db_password = $this->db
			->select('password')
			->where('id_pengguna', $id_pengguna)
			->get('t_pengguna')
			->row()
			->password;

		if (!password_verify($current_password, $db_password)) {
			$this->form_validation->set_message('check_current_password', 'Password saat ini salah!');
			return false;
		}
		return true;
	}

	public function check_new_password($password_baru)
	{
		$password_lama = $this->input->post('password_lama'); // Ambil nilai dari form

		if ($password_lama === $password_baru) {
			$this->form_validation->set_message('check_new_password', 'Password baru harus berbeda dengan password saat ini!');
			return false;
		}
		return true;
	}
}
