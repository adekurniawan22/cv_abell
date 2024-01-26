<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function login()
	{
		$data['title'] = 'Login';
		$this->load->view('login', $data);
	}

	public function lupa_password()
	{
		$data['title'] = 'Login';
		$this->load->view('lupa_password', $data);
	}

	public function proses_login()
	{
		$this->form_validation->set_rules('username_no_hp', 'Username / No Hp', 'required|trim|regex_match[/^[a-z0-9]+$/]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->login();
		} else {
			$username = $this->input->post('username_no_hp');
			$password = $this->input->post('password');

			$this->db->where('username', $username);
			$this->db->or_where('no_hp', $username);
			$user = $this->db->get('t_pengguna')->row_array();

			if ($user) {
				if ($user['status_aktif'] == 1 && password_verify($password, $user['password'])) {
					$data = [
						'username' => $user['username'],
						'nama_lengkap' => $user['nama_lengkap'],
						'role' => $user['role'],
						'id_pengguna' => $user['id_pengguna']
					];
					$this->session->set_userdata($data);

					switch ($user['role']) {
						case 'Manajer':
							redirect('manajer/dashboard');
							break;
						case 'Admin':
							redirect('admin/dashboard');
							break;
						case 'Pelanggan':
							redirect('pelanggan/dashboard');
							break;
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="color:white">
		                <div class="d-flex justify-content-between align-items-center">
		                    <strong>Password kamu salah!</strong>
		                    <i class="bi bi-exclamation-circle-fill"></i>
		                </div>
		                </div>');
					redirect(base_url());
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="color:white">
		            <div class="d-flex justify-content-between align-items-center">
						<strong>Akun tidak ditemukan!</strong>
		                <i class="bi bi-exclamation-circle-fill"></i>
		            </div>
		            </div>');
				redirect(base_url());
			}
		}
	}

	public function logout()
	{
		unset(
			$_SESSION['username'],
			$_SESSION['nama'],
			$_SESSION['role'],
			$_SESSION['id_pengguna'],
		);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="color:white">
            <div class="d-flex justify-content-between align-items-center">
				<strong>Kamu berhasil Logout!</strong>
                <i class="bi bi-check-circle-fill"></i>
            </div>
        </div>
        ');
		redirect(base_url());
	}
}
