<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pelanggan extends CI_Controller
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
		$this->load->model('Pelanggan_model');
	}

	public function index()
	{
		$data['title'] = 'Data Pelanggan';
		$data['pelanggan'] = $this->Pelanggan_model->dapat_pelanggan();
		$data['pegawai'] =  $this->db->get('t_pegawai')->result();

		if ($this->session->userdata('jabatan') == 'Manajer') {
			$this->load->view('templates/header', $data);
			$this->load->view('manajer/pelanggan/pelanggan', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('jabatan') == 'Admin') {
			$this->load->view('templates/header', $data);
			$this->load->view('admin/pelanggan/pelanggan', $data);
			$this->load->view('templates/footer');
		}
	}

	public function tambah_pelanggan()
	{
		$data['lokasi'] =  $this->db->get('t_lokasi_server')->result();
		$data['title'] = 'Tambah Pelanggan';
		$this->load->view('templates/header', $data);
		$this->load->view('admin/pelanggan/tambah_pelanggan', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_pelanggan()
	{
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|integer|is_unique[t_pelanggan.no_hp]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('lokasi_server', 'Lokasi', 'required');
		$this->form_validation->set_rules('mulai_berlangganan', 'Tanggal Mulai Berlangganan', 'required');

		if ($this->form_validation->run() == false) {
			$this->tambah_pelanggan();
		} else {
			$data = array(
				'id_pegawai' => $this->session->userdata('id_pegawai'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'lokasi_server' => $this->input->post('lokasi_server'),
				'mulai_berlangganan' => $this->input->post('mulai_berlangganan'),
			);

			$result = $this->Pelanggan_model->tambah_pelanggan($data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pelanggan Berhasil Ditambahkan</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pelanggan Gagal Ditambahkan</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('admin/data-pelanggan');
		}
	}

	public function edit_pelanggan()
	{
		$data['lokasi'] =  $this->db->get('t_lokasi_server')->result();
		$data['pelanggan'] = $this->Pelanggan_model->dapat_satu_pelanggan($this->input->post('id_pelanggan'));
		$data['title'] = 'Edit Pelanggan';
		$this->load->view('templates/header', $data);
		$this->load->view('admin/pelanggan/edit_pelanggan', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_pelanggan()
	{
		$check_data_user = $this->Pelanggan_model->dapat_satu_pelanggan($this->input->post('id_pelanggan'));

		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		if ($this->input->post('no_hp') != $check_data_user->no_hp) {
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|integer|is_unique[t_pelanggan.no_hp]');
		}
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('lokasi_server', 'Lokasi', 'required');
		$this->form_validation->set_rules('mulai_berlangganan', 'Tanggal Mulai Berlangganan', 'required');
		$status_aktif = ($this->input->post('status_aktif') == 'on') ? '1' : '0';

		if ($this->form_validation->run() == false) {
			$this->edit_pelanggan();
		} else {
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'lokasi_server' => $this->input->post('lokasi_server'),
				'mulai_berlangganan' => $this->input->post('mulai_berlangganan'),
				'status_aktif' => $status_aktif
			);

			$result = $this->Pelanggan_model->edit_pelanggan($this->input->post('id_pelanggan'), $data);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Data Pelanggan Berhasil Di Edit</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Data Pelanggan Gagal Di Edit</strong>
														<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('admin/data-pelanggan');
		}
	}

	public function proses_hapus_pelanggan()
	{
		$this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
		$this->db->delete('t_pelanggan');
		$this->session->set_flashdata('message', '<strong>Data Pelanggan Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('admin/data-pelanggan');
	}

	public function import_data_excel()
	{
		$path = './assets/excel/';

		// Konfigurasi upload
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('excel')) {
			$error = $this->upload->display_errors();
			echo "Error in uploading file: " . $error;
			return; // Hentikan eksekusi jika upload gagal
		}

		$data = $this->upload->data();
		$inputFileName = './assets/excel/' . $data['file_name'];

		// Membaca file Excel
		$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
		$spreadsheet = $reader->load($inputFileName);
		$sheet = $spreadsheet->getActiveSheet();

		$countRows = 0;
		$errors = []; // Array untuk menyimpan pesan kesalahan

		foreach ($sheet->getRowIterator(2) as $row) {
			// Inisialisasi variabel di dalam loop
			$nama_lengkap = $sheet->getCell('A' . $row->getRowIndex())->getValue();
			$no_hp = $sheet->getCell('B' . $row->getRowIndex())->getValue();
			$alamat = $sheet->getCell('C' . $row->getRowIndex())->getValue();
			$lokasi_server = $sheet->getCell('D' . $row->getRowIndex())->getValue();
			$mulai_berlangganan = $sheet->getCell('E' . $row->getRowIndex())->getFormattedValue();

			// Validasi nama
			if (empty($nama_lengkap)) {
				$errors[$row->getRowIndex()][] = 'Nama Lengkap kosong';
			}

			// Validasi no_hp
			if (empty($no_hp)) {
				$errors[$row->getRowIndex()][] = 'No. HP kosong';
			}
			if (!is_numeric($no_hp)) {
				$errors[$row->getRowIndex()][] = 'Nomor hp tidak sesuai';
			} else {
				// Cek apakah no_hp sudah ada dalam database
				if ($this->Pelanggan_model->cekDuplikat('no_hp', $no_hp)) {
					$errors[$row->getRowIndex()][] = 'Nomor hp duplikat';
				}
			}

			// Validasi alamat
			if (empty($alamat)) {
				$errors[$row->getRowIndex()][] = 'Alamat kosong';
			}

			// Validasi lokasi server
			if (empty($lokasi_server)) {
				$errors[$row->getRowIndex()][] = 'Lokasi kosong';
			} else {
				$lokasi_valid = $this->db->select('lokasi_server')->from('t_lokasi_server')->where('lokasi_server', $lokasi_server)->get()->row();
				if (!$lokasi_valid) {
					$errors[$row->getRowIndex()][] = 'Lokasi server tidak sesuai';
				}
			}

			// Validasi tanggal langganan
			if (empty($mulai_berlangganan)) {
				$errors[$row->getRowIndex()][] = 'Tanggal langganan kosong';
			} else {
				// Ubah format tanggal_langganan ke format 'Y-m-d'
				$mulai_berlangganan_obj = date_create_from_format('d/m/Y', $mulai_berlangganan);

				if (!$mulai_berlangganan_obj) {
					$errors[$row->getRowIndex()][] = 'Format tanggal langganan tidak sesuai';
				}
			}
			// Jika ada kolom yang tidak valid, tambahkan ke dalam array $errors
			if (!empty($errors[$row->getRowIndex()])) {
				$countRows++; // Tambahkan jumlah baris yang memiliki kesalahan
			}
		}

		if ($countRows > 0) {
			// Jika ada baris dengan kesalahan, set pesan kesalahan
			$this->session->set_flashdata('error_add_excel', $errors);
			redirect('admin/data-pelanggan');
		} else {
			// Jika tidak ada kesalahan, lakukan operasi tambah data
			foreach ($sheet->getRowIterator(2) as $row) {
				$mulai_berlangganan = $sheet->getCell('E' . $row->getRowIndex())->getFormattedValue();
				$mulai_berlangganan_obj = date_create_from_format('d/m/Y', $mulai_berlangganan);
				$mulai_berlangganan_formatted = $mulai_berlangganan_obj->format('Y-m-d');
				$lokasi_server = $sheet->getCell('D' . $row->getRowIndex())->getValue();
				$lokasi_valid = $this->db->select('*')->from('t_lokasi_server')->where('lokasi_server', $lokasi_server)->get()->row();

				// Data sekarang diperoleh dalam loop
				$data1 = [
					'id_pegawai' => $this->session->userdata('id_pegawai'),
					'nama_lengkap' => $sheet->getCell('A' . $row->getRowIndex())->getValue(),
					'no_hp' => "0" . $sheet->getCell('B' . $row->getRowIndex())->getValue(),
					'alamat' => $sheet->getCell('C' . $row->getRowIndex())->getValue(),
					'lokasi_server' => $lokasi_valid->id_lokasi_server,
					'mulai_berlangganan' => $mulai_berlangganan_formatted,
				];
				$this->Pelanggan_model->tambah_pelanggan($data1);
				$countRows++;
			}

			if ($countRows > 0) {
				$message = $countRows . ' Data Pelanggan berhasil ditambahkan <i class="bi bi-check-circle-fill"></i>';
				$this->session->set_flashdata('message', $message);
			} else {
				$this->session->set_flashdata('message', '<strong>Tidak ada data yang berhasil ditambahkan</strong>');
			}
			unlink($inputFileName);
			redirect('admin/data-pelanggan');
		}
	}
}
