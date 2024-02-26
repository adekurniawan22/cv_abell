<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pegawai extends CI_Controller
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
		$this->load->model('Pegawai_model');
	}

	public function index()
	{
		$data['title'] = 'Data Pegawai';
		$data['pegawai'] = $this->Pegawai_model->dapat_pegawai();

		if ($this->session->userdata('jabatan') == 'Manajer') {
			$this->load->view('templates/header', $data);
			$this->load->view('manajer/pegawai/pegawai', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('jabatan') == 'Admin') {
			$this->load->view('templates/header', $data);
			$this->load->view('admin/pegawai/pegawai', $data);
			$this->load->view('templates/footer');
		}
	}

	public function tambah_pegawai()
	{
		$data['title'] = 'Tambah Pegawai';
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pegawai/tambah_pegawai', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_pegawai()
	{
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[t_pegawai.username]|regex_match[/^[a-z0-9]+$/]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[t_pegawai.email]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|integer');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->tambah_pegawai();
		} else {
			$data = array(
				'jabatan' => $this->input->post('jabatan'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
			);

			$result = $this->Pegawai_model->tambah_pegawai($data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pegawai Berhasil Ditambahkan</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pegawai Gagal Ditambahkan</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('manajer/data-pegawai');
		}
	}

	public function edit_pegawai()
	{
		$data['lokasi'] =  $this->db->get('t_lokasi_server')->result();
		$data['title'] = 'Edit pegawai';
		$data['pegawai'] = $this->Pegawai_model->dapat_satu_pegawai($this->input->post('id_pegawai'));
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/pegawai/edit_pegawai', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_pegawai()
	{
		$check_data_user = $this->Pegawai_model->dapat_satu_pegawai($this->input->post('id_pegawai'));

		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		if ($this->input->post('username') != $check_data_user->username) {
			$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[t_pegawai.username]|regex_match[/^[a-z0-9]+$/]');
		}
		if ($this->input->post('email') != $check_data_user->email) {
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[t_pegawai.email]|valid_email');
		}
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|integer');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->edit_pegawai();
		} else {
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
			);

			$result = $this->Pegawai_model->edit_pegawai($this->input->post('id_pegawai'), $data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pegawai Berhasil Di Edit</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pegawai Gagal Di Edit</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('manajer/data-pegawai');
		}
	}

	public function proses_hapus_pegawai()
	{
		$this->db->where('id_pegawai', $this->input->post('id_pegawai'));
		$this->db->delete('t_pegawai');
		$this->session->set_flashdata('message', '<strong>Data Pegawai Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('manajer/data-pegawai');
	}
}
