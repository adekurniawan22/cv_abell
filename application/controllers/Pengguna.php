<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

		if ($this->session->userdata('role') == 'Manajer') {
			$this->load->view('templates/header', $data);
			$this->load->view('manajer/pengguna/pengguna', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('templates/header', $data);
			$this->load->view('admin/pengguna/pengguna', $data);
			$this->load->view('templates/footer');
		}
	}

	public function tambah_pengguna()
	{
		$data['lokasi'] =  $this->db->get('t_lokasi_server')->result();
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
		if ($this->input->post('role') == "Pelanggan") {
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
			$this->form_validation->set_rules('tanggal_langganan', 'Tanggal Mulai Berlangganan', 'required');
		}

		if ($this->form_validation->run() == false) {
			$this->tambah_pengguna();
		} else {
			$data = array(
				'role' => $this->input->post('role'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
			);

			date_default_timezone_set('Asia/Jakarta');
			if ($this->input->post('role') == "Pelanggan") {
				$data['lokasi'] = $this->input->post('lokasi');
				$data['tanggal_langganan'] = $this->input->post('tanggal_langganan');
			}

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

	public function import_data_excel()
	{
		$path = './assets/excel';

		// Konfigurasi upload
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
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
			$role = $sheet->getCell('A' . $row->getRowIndex())->getValue();
			$nama_lengkap = $sheet->getCell('B' . $row->getRowIndex())->getValue();
			$username = $sheet->getCell('C' . $row->getRowIndex())->getValue();
			$email = $sheet->getCell('D' . $row->getRowIndex())->getValue();
			$no_hp = $sheet->getCell('E' . $row->getRowIndex())->getValue();
			$password = $sheet->getCell('F' . $row->getRowIndex())->getValue();
			$alamat = $sheet->getCell('G' . $row->getRowIndex())->getValue();
			$lokasi = $sheet->getCell('H' . $row->getRowIndex())->getValue();
			$tanggal_langganan = $sheet->getCell('I' . $row->getRowIndex())->getFormattedValue();

			// Validasi role
			if (empty($role)) {
				$errors[$row->getRowIndex()][] = 'Role kosong';
			}
			$allowed_roles = ["Manajer", "Admin", "Pelanggan"];
			if (!in_array($role, $allowed_roles)) {
				$errors[$row->getRowIndex()][] = 'Role tidak sesuai';
			}

			// Validasi nama
			if (empty($nama_lengkap)) {
				$errors[$row->getRowIndex()][] = 'Nama Lengkap kosong';
			}

			// Validasi username
			if (empty($username)) {
				$errors[$row->getRowIndex()][] = 'Username kosong';
			}
			if (!ctype_alnum($username)) {
				$errors[$row->getRowIndex()][] = 'Username tidak sesuai';
			} else {
				// Cek apakah username sudah ada dalam database
				if ($this->Pengguna_model->cekDuplikat('username', $username)) {
					$errors[$row->getRowIndex()][] = 'Username duplikat';
				}
			}

			// Validasi email
			if (empty($email)) {
				$errors[$row->getRowIndex()][] = 'Email kosong';
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[$row->getRowIndex()][] = 'Email tidak sesuai';
			} else {
				// Cek apakah email sudah ada dalam database
				if ($this->Pengguna_model->cekDuplikat('email', $email)) {
					$errors[$row->getRowIndex()][] = 'Email duplikat';
				}
			}

			// Validasi no_hp
			if (empty($no_hp)) {
				$errors[$row->getRowIndex()][] = 'No. HP kosong';
			}
			if (!is_numeric($no_hp)) {
				$errors[$row->getRowIndex()][] = 'Nomor hp tidak sesuai';
			} else {
				// Cek apakah no_hp sudah ada dalam database
				if ($this->Pengguna_model->cekDuplikat('no_hp', $no_hp)) {
					$errors[$row->getRowIndex()][] = 'Nomor hp duplikat';
				}
			}

			// Validasi password
			if (empty($password)) {
				$errors[$row->getRowIndex()][] = 'Password kosong';
			} else {
				if (strlen($password) < 8) {
					$errors[$row->getRowIndex()][] = 'Password minimal 8 karakter';
				}
			}

			// Validasi alamat
			if (empty($alamat)) {
				$errors[$row->getRowIndex()][] = 'Alamat kosong';
			}

			// Validasi lokasi
			if ($role == "Pelanggan") {
				if (empty($lokasi)) {
					$errors[$row->getRowIndex()][] = 'Lokasi kosong';
				} else {
					$lokasi_valid = $this->db->select('lokasi_server')->from('t_lokasi_server')->where('lokasi_server', $lokasi)->get()->row();
					if (!$lokasi_valid) {
						$errors[$row->getRowIndex()][] = 'Lokasi server tidak sesuai';
					}
				}
			}

			// Validasi tanggal langganan
			if ($role == "Pelanggan") {
				if (empty($tanggal_langganan)) {
					$errors[$row->getRowIndex()][] = 'Tanggal langganan kosong';
				} else {
					// Ubah format tanggal_langganan ke format 'Y-m-d'
					$tanggal_langganan_obj = date_create_from_format('d/m/Y', $tanggal_langganan);

					if (!$tanggal_langganan_obj) {
						$errors[$row->getRowIndex()][] = 'Format tanggal langganan tidak sesuai';
					} else {
						$waktu_sekarang = new DateTime();
						$tanggal_sekarang = $waktu_sekarang->format('Y-m-d'); // Ubah format tanggal sekarang ke 'Y-m-d'

						// Ubah format tanggal_langganan_obj ke 'Y-m-d' untuk membandingkan dengan tanggal sekarang
						$tanggal_langganan_formatted = $tanggal_langganan_obj->format('Y-m-d');

						if ($tanggal_langganan_formatted > $tanggal_sekarang) {
							$errors[$row->getRowIndex()][] = 'Tanggal langganan harus setelah tanggal sekarang';
						}
					}
				}
			}

			if ($this->Pengguna_model->cekDuplikat('email', $email)) {
				$errors[$row->getRowIndex()][] = 'Email duplikat';
			}
			// Jika ada kolom yang tidak valid, tambahkan ke dalam array $errors
			if (!empty($errors[$row->getRowIndex()])) {
				$countRows++; // Tambahkan jumlah baris yang memiliki kesalahan
			}
		}

		if ($countRows > 0) {
			// Jika ada baris dengan kesalahan, set pesan kesalahan
			$this->session->set_flashdata('error_add_excel', $errors);
			redirect('manajer/data-pengguna');
		} else {
			// Jika tidak ada kesalahan, lakukan operasi tambah data
			foreach ($sheet->getRowIterator(2) as $row) {
				$tanggal_langganan = $sheet->getCell('I' . $row->getRowIndex())->getFormattedValue();
				$tanggal_langganan_obj = date_create_from_format('d/m/Y', $tanggal_langganan);
				$tanggal_langganan_formatted = $tanggal_langganan_obj->format('Y-m-d');

				// Data sekarang diperoleh dalam loop
				$data1 = [
					'role' => $sheet->getCell('A' . $row->getRowIndex())->getValue(),
					'nama_lengkap' => $sheet->getCell('B' . $row->getRowIndex())->getValue(),
					'username' => $sheet->getCell('C' . $row->getRowIndex())->getValue(),
					'email' => $sheet->getCell('D' . $row->getRowIndex())->getValue(),
					'no_hp' => "0" . $sheet->getCell('E' . $row->getRowIndex())->getValue(),
					'password' => password_hash($sheet->getCell('F' . $row->getRowIndex())->getValue(), PASSWORD_DEFAULT),
					'alamat' => $sheet->getCell('G' . $row->getRowIndex())->getValue(),
					'lokasi' => $sheet->getCell('H' . $row->getRowIndex())->getValue(),
					'tanggal_langganan' => $tanggal_langganan_formatted,
				];
				$this->Pengguna_model->tambah_pengguna($data1);
				$countRows++;
			}

			if ($countRows > 0) {
				$message = $countRows . ' Data Pengguna berhasil ditambahkan <i class="bi bi-check-circle-fill"></i>';
				$this->session->set_flashdata('message', $message);
			} else {
				$this->session->set_flashdata('message', '<strong>Tidak ada data yang berhasil ditambahkan</strong>');
			}
			redirect('manajer/data-pengguna');
		}
	}

	public function edit_pengguna()
	{
		$data['lokasi'] =  $this->db->get('t_lokasi_server')->result();
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
		if ($this->input->post('role') == "Pelanggan") {
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
			$this->form_validation->set_rules('tanggal_langganan', 'Tanggal Mulai Berlangganan', 'required');
		}
		$status_aktif = ($this->input->post('status_aktif') == 'on') ? '1' : '0';

		if ($this->form_validation->run() == false) {
			$this->edit_pengguna();
		} else {
			$data = array(
				'role' => $this->input->post('role'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'status_aktif' => $status_aktif
			);

			if ($this->input->post('role') == "Pelanggan") {
				$data['lokasi'] = $this->input->post('lokasi');
				$data['tanggal_langganan'] = $this->input->post('tanggal_langganan');
			}

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
