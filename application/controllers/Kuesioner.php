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
		$data['dimensi'] = $this->Pernyataan_model->dapat_dimensi();

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
			$data['kuesioner_pelanggan'] = $this->db->get('t_kuesioner')->result();

			$this->load->view('templates/header', $data);
			$this->load->view('pelanggan/kuesioner/kuesioner', $data);
			$this->load->view('templates/footer');
		}
	}

	public function tambah_kuesioner()
	{
		$data['dimensi'] = $this->db->get('t_dimensi')->result();
		$data['title'] = 'Tambah Kuesioner';
		$this->load->view('templates/header', $data);
		$this->load->view('admin/kuesioner/tambah_kuesioner', $data);
		$this->load->view('templates/footer');
	}

	public function proses_tambah_kuesioner()
	{
		// Mendapatkan tanggal sekarang dengan zona waktu Indonesia
		$timezone = new DateTimeZone('Asia/Jakarta');
		$now = new DateTime('now', $timezone);

		// Mendapatkan tanggal selesai (7 hari setelah tanggal sekarang)
		$selesai = clone $now;
		$selesai->add(new DateInterval('P6D'));

		$data = array(
			'judul_kuesioner' => $this->input->post('judul_kuesioner'),
			'mulai' => $now->format('Y-m-d H:i:s'),  // Format tanggal dan waktu MySQL
			'selesai' => $selesai->format('Y-m-d H:i:s'),  // Format tanggal dan waktu MySQL
			'id_pegawai' => $this->session->userdata('id_pegawai'),
		);

		$result = $this->Kuesioner_model->tambah_kuesioner($data);
		$id_kuesioner = $this->db->insert_id();

		$i = 0;
		foreach ($_POST['pernyataan'] as $p) {
			$data_pernyataan = [
				'id_kuesioner' => $id_kuesioner,
				'pernyataan' => $p,
				'id_dimensi' => $_POST['dimensi'][$i],
			];
			$i++;
			$this->Pernyataan_model->tambah_pernyataan($data_pernyataan);
		}

		if ($result) {
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Ditambahkan</strong>
															<i class="bi bi-check-circle-fill"></i>');
		} else {
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Gagal Ditambahkan</strong>
													<i class="bi bi-exclamation-circle-fill"></i>');
		}
		redirect('admin/data-kuesioner');
	}

	public function edit_kuesioner()
	{
		$data['title'] = 'Edit Kuesioner';
		$data['kuesioner'] = $this->Kuesioner_model->dapat_satu_kuesioner($this->input->post('id_kuesioner'));
		$data['pernyataan'] = $this->Kuesioner_model->dapat_pernyataan($this->input->post('id_kuesioner'));
		$this->load->view('templates/header', $data);
		$this->load->view('admin/kuesioner/edit_kuesioner', $data);
		$this->load->view('templates/footer');
	}

	public function proses_edit_kuesioner()
	{
		try {

			$data_kuesioner = [
				'judul_kuesioner' => $this->input->post('judul_kuesioner'),
				'mulai' => $this->input->post('mulai'),
				'selesai' => $this->input->post('selesai'),
			];

			$this->Kuesioner_model->edit_kuesioner($this->input->post('id_kuesioner'), $data_kuesioner);


			for ($i = 0; $i < count($_POST['id_pernyataan']); $i++) {
				$data_pernyataan = [
					'pernyataan' => $_POST['pernyataan'][$i],
				];

				$this->Kuesioner_model->edit_pernyataan($_POST['id_pernyataan'][$i], $data_pernyataan);
			}

			if (!empty($_POST['pernyataan_baru'])) {
				foreach ($_POST['pernyataan_baru'] as $p) {
					$data_pernyataan = [
						'id_kuesioner' => $this->input->post('id_kuesioner'),
						'pernyataan' => $p,
					];

					$this->Kuesioner_model->tambah_pernyataan($data_pernyataan);
				}
			}
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Diedit</strong>
															<i class="bi bi-check-circle-fill"></i>');
		} catch (Exception $e) {
			$this->session->set_flashdata('message', '<strong>Data Kuesioner Gagal Diedit</strong>
													<i class="bi bi-exclamation-circle-fill"></i>');
		}
		redirect('admin/data-kuesioner');
	}


	public function proses_hapus_kuesioner()
	{
		$this->db->where('id_kuesioner', $this->input->post('id_kuesioner'));
		$this->db->delete('t_kuesioner');
		$this->session->set_flashdata('message', '<strong>Data Kuesioner Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('admin/data-kuesioner');
	}

	public function kirim_email_ke_manajer()
	{
		$kuesioner = $this->Kuesioner_model->dapat_satu_kuesioner($this->input->post('id_kuesioner'));
		$this->load->library('email');
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'appcilogin@gmail.com',
			'smtp_pass' => 'iakd gazx zkva ghrk	',
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		);

		$this->email->initialize($config);

		$this->db->where('jabatan', 'Manajer');
		$query = $this->db->get('t_pegawai')->result();

		foreach ($query as $q) {
			$this->email->from('appcilogin@gmail.com', 'CV. Abell');
			$this->email->to($q->email);

			$this->email->subject('Kuesioner Telah Berakhir');
			$content = "Kuesioner : $kuesioner->judul_kuesioner <br>	
                    Tanggal Mulai : $kuesioner->mulai <br>
                    Tanggal Selesai : $kuesioner->selesai <br>";

			$this->email->message("$content<br> Silahkan periksa dan evaluasi jawaban dari pelanggan &#128512;");
			$this->email->send();
		}
		$this->session->set_flashdata('message', '<strong>Kirim Email Ke Manajer Telah Berhasil</strong>
		<i class="bi bi-check-circle-fill"></i>');
		redirect('admin/data-kuesioner');
	}
}
