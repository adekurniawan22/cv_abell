<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pelanggan_model');
	}

	public function dashboard_manajer()
	{
		if (empty($this->session->userdata('jabatan'))) {
			$this->session->set_flashdata('message', '<strong>Akses ditolak, silahkan login terlebih dahulu!</strong>
		                <i class="bi bi-exclamation-circle-fill"></i>');
			redirect('login-pegawai');
		}
		$data['title'] = 'Dashboard Manajer';
		$data['jumlah_pelanggan'] = $this->Pelanggan_model->jumlah_pelanggan();
		$data['jumlah_pelanggan_aktif'] = $this->Pelanggan_model->jumlah_pelanggan_aktif();
		$data['jumlah_pelanggan_tidak_aktif'] = $this->Pelanggan_model->jumlah_pelanggan_tidak_aktif();
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function dashboard_admin()
	{
		if (empty($this->session->userdata('jabatan'))) {
			$this->session->set_flashdata('message', '<strong>Akses ditolak, silahkan login terlebih dahulu!</strong>
		                <i class="bi bi-exclamation-circle-fill"></i>');
			redirect('login-pegawai');
		}

		$data['title'] = 'Dashboard Admin';
		$data['jumlah_pelanggan'] = $this->Pelanggan_model->jumlah_pelanggan();
		$data['jumlah_pelanggan_aktif'] = $this->Pelanggan_model->jumlah_pelanggan_aktif();
		$data['jumlah_pelanggan_tidak_aktif'] = $this->Pelanggan_model->jumlah_pelanggan_tidak_aktif();
		$this->load->view('templates/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function dashboard_pelanggan()
	{
		if (empty($this->session->userdata('jabatan'))) {
			$this->session->set_flashdata('message', '<strong>Akses ditolak, silahkan login terlebih dahulu!</strong>
		                <i class="bi bi-exclamation-circle-fill"></i>');
			redirect(base_url());
		}

		$data['title'] = 'Dashboard Pelanggan';
		$this->load->view('templates/header', $data);
		$this->load->view('pelanggan/dashboard', $data);
		$this->load->view('templates/footer');
	}
}
