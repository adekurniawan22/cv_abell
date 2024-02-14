<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Kuesioner_model');
		$this->load->model('Pernyataan_model');
	}

	public function index()
	{
		$data['title'] = 'Data Kuesioner';
		$data['kuesioner'] = $this->Kuesioner_model->dapat_kuesioner();

		$this->db->select('selesai');
		$this->db->order_by('id_kuesioner', 'DESC');
		$this->db->limit(1);
		$data['tanggal_terakhir'] = $this->db->get('t_kuesioner')->row();

		if ($this->session->userdata('jabatan') == 'Manajer') {
			$this->load->view('templates/header', $data);
			$this->load->view('manajer/kuesioner/kuesioner', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('jabatan') == 'Admin') {
			$this->load->view('templates/header', $data);
			$this->load->view('admin/kuesioner/kuesioner', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('jabatan') == 'Pelanggan') {
			$today = date('Y-m-d');
			$this->db->where('selesai >', $today);
			$this->db->where('status_publish =', '1');
			$data['kuesioner_pelanggan'] = $this->db->get('t_kuesioner')->result();

			$this->load->view('templates/header', $data);
			$this->load->view('pelanggan/kuesioner/kuesioner', $data);
			$this->load->view('templates/footer');
		}
	}

	public function tambah_kuesioner()
	{
		$this->db->from('t_kuesioner');
		$data['judul_kuesioner'] = $this->db->count_all_results();
		$data['title'] = 'Tambah Kuesioner';
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/kuesioner/tambah_kuesioner', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_kuesioner()
	{
		$this->form_validation->set_rules('mulai', 'Tanggal Mulai Kuesioner', 'required');
		if ($this->input->post('selesai')) {
			$this->form_validation->set_rules('selesai', 'Tanggal Selesai Kuesioner', 'callback_check_date');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_kuesioner();
		} else {
			$data = [
				'judul_kuesioner' => $this->input->post('judul_kuesioner'),
				'mulai' => $this->input->post('mulai'),
				'status_kuesioner' => '0',
				'status_publish' => '0',
				'status_evaluasi' => '0',
				'id_pegawai' => $this->session->userdata('id_pegawai')
			];

			if ($this->input->post('selesai')) {
				$data['selesai'] = $this->input->post('selesai');
			} else {
				// Tambahkan 7 hari ke tanggal mulai
				$mulai_timestamp = strtotime($this->input->post('mulai'));
				$selesai_timestamp = strtotime('+7 day', $mulai_timestamp);
				$data['selesai'] = date('Y-m-d', $selesai_timestamp);
			}

			$result = $this->Kuesioner_model->tambah_kuesioner($data);
			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Ditambahkan</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Kuesioner Gagal Ditambahkan</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('manajer/data-kuesioner');
		}
	}

	public function edit_kuesioner()
	{
		$data['title'] = 'Edit Kuesioner';
		$data['kuesioner'] = $this->Kuesioner_model->dapat_satu_kuesioner($this->input->post('id_kuesioner'));
		$this->load->view('templates/header', $data);
		$this->load->view('manajer/kuesioner/edit_kuesioner', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_kuesioner()
	{
		$this->form_validation->set_rules('judul_kuesioner', 'Lokasi', 'required');
		$this->form_validation->set_rules('mulai', 'Tanggal Mulai Kuesioner', 'required');
		$this->form_validation->set_rules('selesai', 'Tanggal Selesai Kuesioner', 'required|callback_check_date');

		if ($this->form_validation->run() == FALSE) {
			$this->edit_kuesioner();
		} else {
			$data = [
				'judul_kuesioner' => $this->input->post('judul_kuesioner'),
				'mulai' => $this->input->post('mulai'),
				'selesai' => $this->input->post('selesai'),
			];

			$result = $this->Kuesioner_model->edit_kuesioner($this->input->post('id_kuesioner'), $data);
			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Di edit</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Kuesioner Gagal Di edit</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('manajer/data-kuesioner');
		}
	}

	public function proses_hapus_kuesioner()
	{
		$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
		$this->db->delete('t_kuesioner');
		$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('manajer/data-kuesioner');
	}

	public function isi_pernyataan()
	{
		$data['title'] = 'Isi Pernyataan';
		$data['kuesioner'] = $this->Kuesioner_model->dapat_satu_kuesioner($this->input->post('id_kuesioner'));
		$data['pernyataan'] = $this->Pernyataan_model->dapat_pernyataan();
		$this->load->view('templates/header', $data);
		$this->load->view('admin/kuesioner/isi_pernyataan', $data);
		$this->load->view('templates/footer');
	}

	public function proses_isi_pernyataan()
	{
		$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
		$detail_kuesioner = $this->db->get('t_detail_kuesioner')->result();
		if ($detail_kuesioner) {
			$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
			$this->db->delete('t_detail_kuesioner');
		}
		$this->form_validation->set_rules(
			'pilih_pernyataan[]',
			'Pernyataan',
			'required',
			array('required'  =>  'Pilih pernyataan terlebih dahulu!')
		);
		if ($this->form_validation->run() == FALSE) {
			$this->isi_pernyataan();
		} else {

			$success_count = 0;
			foreach ($_POST['pilih_pernyataan'] as $key) {
				$data = [
					'id_kuesioner' => $this->input->post('id_kuesioner'),
					'id_pernyataan' => $key
				];
				$this->db->insert('t_detail_kuesioner', $data);
				if ($this->db->affected_rows() > 0) {
					$success_count++;
				}
			}

			if ($success_count == count($_POST['pilih_pernyataan'])) {
				$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
				$this->db->update('t_kuesioner', ['status_kuesioner' => '2']);
				$this->session->set_flashdata('message', '<strong>Isi Pernyataan Berhasil</strong>
																	<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Isi Pernyataan Gagal</strong>
															<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('admin/data-kuesioner');
		}
	}

	public function proses_edit_status_kuesioner()
	{
		$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
		$this->db->update('t_kuesioner', ['status_kuesioner' => $this->input->post('status_kuesioner')]);
		$this->session->set_flashdata('message', '<strong>Status Kuesioner Berhasil Diedit</strong>
                                                                    <i class="bi bi-check-circle-fill"></i>');
		redirect('manajer/data-kuesioner');
	}

	public function publish_kuesioner()
	{
		$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
		$result = $this->db->update('t_kuesioner', ['status_kuesioner' => '1', 'status_publish' => '1']);


		if ($result) {
			$this->session->set_flashdata('message', '<strong>Kuesioner Berhasil Di Publish</strong>
																	<i class="bi bi-check-circle-fill"></i>');
		} else {
			$this->session->set_flashdata('message', '<strong>Kuesioner Gagal Di Publish</strong>
															<i class="bi bi-exclamation-circle-fill"></i>');
		}
		redirect('manajer/data-kuesioner');
	}

	public function check_date($end_date)
	{
		$start_date = $this->input->post('mulai');

		// Convert dates to timestamps for comparison
		$start_timestamp = strtotime($start_date);
		$end_timestamp = strtotime($end_date);

		// Check if end date is greater than start date
		if ($end_timestamp < $start_timestamp) {
			// End date is less than start date
			$this->form_validation->set_message('check_date', 'Tanggal Selesai harus setelah Tanggal Mulai');
			return FALSE;
		} else {
			// Dates are valid
			return TRUE;
		}
	}
}
