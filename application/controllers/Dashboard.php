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
		$data['title'] = 'Dashboard Pelanggan';
		$this->load->view('templates/header', $data);
		$this->load->view('pelanggan/dashboard', $data);
		$this->load->view('templates/footer');
	}
}
