<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function dashboard_admin()
	{
		$data['title'] = 'Dashboard admin';
		$this->load->view('templates/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function dashboard_manajer()
	{
		$data['title'] = 'Dashboard manajer';
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/dashboard', $data);
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
