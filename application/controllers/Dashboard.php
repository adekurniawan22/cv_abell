<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pengguna_model');
	}

	public function dashboard_manajer()
	{
		$data['title'] = 'Dashboard Manajer';
		$data['jumlah_pengguna'] = $this->Pengguna_model->jumlah_pengguna();
		$data['jumlah_pengguna_aktif'] = $this->Pengguna_model->jumlah_pengguna_aktif();
		$data['jumlah_pengguna_tidak_aktif'] = $this->Pengguna_model->jumlah_pengguna_tidak_aktif();
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function dashboard_admin()
	{
		$data['title'] = 'Dashboard Admin';
		$data['jumlah_pengguna'] = $this->Pengguna_model->jumlah_pengguna();
		$data['jumlah_pengguna_aktif'] = $this->Pengguna_model->jumlah_pengguna_aktif();
		$data['jumlah_pengguna_tidak_aktif'] = $this->Pengguna_model->jumlah_pengguna_tidak_aktif();
		$this->load->view('templates/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function dashboard_pelanggan()
	{
		$data['title'] = 'Dashboard Pelanggan';
		$this->load->view('templates/header', $data);
		$this->load->view('pelanggan/dashboard', $data);
		$this->load->view('templates/footer');
	}
}
