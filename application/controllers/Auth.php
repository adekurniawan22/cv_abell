<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pegawai_model');
		$this->load->model('Pelanggan_model');
	}

	public function index()
	{
		$data['title'] = 'CV. Abell';
		$this->load->view('index', $data);
	}

	public function login_pegawai()
	{
		$data['title'] = 'Login Pegawai';
		$this->load->view('auth/pegawai/login', $data);
	}

	public function proses_login_pegawai()
	{
		$this->form_validation->set_rules('username_email', 'Username / Email', 'required|trim|regex_match[/^[a-z0-9]+$/]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->login_pegawai();
		} else {
			$username = $this->input->post('username_email');
			$password = $this->input->post('password');

			$this->db->where('username', $username);
			$this->db->or_where('email', $username);
			$user = $this->db->get('t_pegawai')->row_array();

			if ($user) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'username' => $user['username'],
						'nama_lengkap' => $user['nama_lengkap'],
						'jabatan' => $user['jabatan'],
						'id_pegawai' => $user['id_pegawai']
					];
					$this->session->set_userdata($data);
					$this->session->set_flashdata('message', '<strong>Login Berhasil</strong>
																<i class="bi bi-check-circle-fill"></i>');

					switch ($user['jabatan']) {
						case 'Manajer':
							redirect('manajer/dashboard');
							break;
						case 'Admin':
							redirect('admin/dashboard');
							break;
					}
				} else {
					$this->session->set_flashdata('message', '<strong>Password salah, silahkan coba lagi!</strong>
		                    <i class="bi bi-exclamation-circle-fill"></i>');
					redirect('login-pegawai');
				}
			} else {
				$this->session->set_flashdata('message', '<strong>Akun anda tidak ditemukan!</strong>
		                <i class="bi bi-exclamation-circle-fill"></i>');
				redirect('login-pegawai');
			}
		}
	}

	public function logout_pegawai()
	{
		unset(
			$_SESSION['username'],
			$_SESSION['nama_lengkap'],
			$_SESSION['jabatan'],
			$_SESSION['id_pegawai'],
		);
		$this->session->set_flashdata('message', '<strong>Anda berhasil Logout</strong><i class="bi bi-check-circle-fill"></i>');
		redirect('login-pegawai');
	}

	public function lupa_password()
	{
		$data['title'] = 'Lupa Password';
		$this->load->view('auth/pegawai/lupa_password', $data);
	}

	public function send_reset_link()
	{
		$email = $this->input->post('email');

		if ($this->Pegawai_model->checkEmail($email)) {
			$reset_code = bin2hex(random_bytes(16));
			$expiry_time = time() + (20 * 60); // Waktu kadaluarsa 5 menit

			// Kirim email dengan reset code dan waktu kadaluarsa
			$this->send_reset_email($email, $reset_code, $expiry_time);

			$this->session->set_flashdata('message', '<strong>Email reset telah dikirim, silahkan cek email anda</strong>
																<i class="bi bi-check-circle-fill"></i>');
			redirect('lupa-password');
		} else {
			$this->session->set_flashdata('message', '<strong>Email Tidak Terdaftar</strong>
			<i class="bi bi-exclamation-circle-fill"></i>');
			redirect('lupa-password');
		}
	}

	private function send_reset_email($email, $reset_code, $expiry_time)
	{
		$this->load->library('email');

		$this->db->where('email', $email);
		$query = $this->db->get('t_pegawai')->result();

		$kunci_rahasia = "rahasia123";
		$hash = urlencode($this->enkripsi($query[0]->id_pegawai, $kunci_rahasia));

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

		$this->email->from('appcilogin@gmail.com', 'CV. Abell');
		$this->email->to($email);

		$this->email->subject('Reset Password');
		$reset_link = base_url("reset-password?hash=$hash&code=$reset_code&expiry=$expiry_time");
		$this->email->message("Klik link berikut untuk reset password: $reset_link");

		$this->email->send();
	}

	public function reset_password()
	{
		$data['title'] = 'Reset Password';

		$hash_dari_url = $this->input->get('hash');

		$reset_code = $this->input->get('code');
		$expiry_time = $this->input->get('expiry');

		if (!empty($reset_code) && !empty($expiry_time) && !empty($hash_dari_url)) {
			if ($this->verify_reset_code($reset_code, $expiry_time)) {
				$data['hash'] = $hash_dari_url;
				$data['reset_code'] = $reset_code;
				$data['expiry_time'] = $expiry_time;
				$this->load->view('auth/pegawai/reset_password', $data);
			} else {
				$this->session->set_flashdata('message', '<strong>Email Reset Password Expired</strong>
			<i class="bi bi-exclamation-circle-fill"></i>');
				redirect('login-pegawai');
			}
		} else {
			$this->session->set_flashdata('message', '<strong>Alamat URL Salah</strong>
			<i class="bi bi-exclamation-circle-fill"></i>');
			redirect('login-pegawai');
		}
	}

	public function verify_reset_code($reset_code, $expiry_time)
	{
		$current_time = time();
		return ($current_time <= $expiry_time);
	}

	public function proses_reset_password()
	{
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim');
		$this->form_validation->set_rules('konfirmasi_password_baru', 'Konfirmasi Password Baru', 'required|trim|matches[password_baru]');

		if ($this->form_validation->run() == false) {
			$kunci_rahasia = "rahasia123";
			$hash = $this->input->post('hash');
			$reset_code = $this->input->post('reset_code'); // Retrieve reset code from form submission
			$expiry_time = $this->input->post('expiry_time');
			$this->session->set_flashdata('form_errors', validation_errors());
			redirect('reset-password?hash=' . $hash . '&code=' . $reset_code . '&expiry=' . $expiry_time);
		} else {
			if ($this->input->post('password_lama')) {
				$data['password'] = password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT);
			}

			$kunci_rahasia = "rahasia123";
			$hash_dari_url = $this->input->post('hash');
			$hash_didekode = urldecode($hash_dari_url);
			$hash = $this->dekripsi($hash_didekode, $kunci_rahasia);

			$result = $this->Pegawai_model->edit_pegawai($hash, ['password' => password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT)]);

			if ($result) {
				$this->session->set_flashdata('message', '<strong>Reset Password Berhasil</strong>
																<i class="bi bi-check-circle-fill"></i>');
			} else {
				$this->session->set_flashdata('message', '<strong>Reset Password Gagal</strong>
																<i class="bi bi-exclamation-circle-fill"></i>');
			}
			redirect('login-pegawai');
		}
	}

	function enkripsi($pesan, $kunci)
	{
		$method = 'aes-256-cbc';
		$iv_length = 16;
		$iv = openssl_random_pseudo_bytes($iv_length);

		$enkripsi = openssl_encrypt($pesan, $method, $kunci, 0, $iv);
		$teks_terenkripsi = $iv . $enkripsi;

		return base64_encode($teks_terenkripsi);
	}

	function dekripsi($teks_terenkripsi, $kunci)
	{
		$method = 'aes-256-cbc';
		$teks_terdekripsi = base64_decode($teks_terenkripsi);
		$iv_length = 16;
		$iv = substr($teks_terdekripsi, 0, $iv_length);
		$pesan_terdekripsi = openssl_decrypt(substr($teks_terdekripsi, $iv_length), $method, $kunci, 0, $iv);

		return $pesan_terdekripsi;
	}
}
