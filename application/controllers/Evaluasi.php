<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Kuesioner_model');
		$this->load->model('Pernyataan_model');
		$this->load->model('Evaluasi_model');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$data['title'] = "Data Perhitungan";
		$data['evaluasi'] = $this->Evaluasi_model->dapat_evaluasi();

		$this->load->view('templates/header', $data);
		$this->load->view('manajer/evaluasi/evaluasi', $data);
		$this->load->view('templates/footer');
	}

	public function proses_evaluasi_kuesioner()
	{
		$id_kuesioner = $this->input->post('id_kuesioner');
		$pernyataan = $this->Pernyataan_model->dapat_pernyataan();

		$this->db->from('t_jawaban');
		$this->db->where('id_kuesioner', $id_kuesioner);
		$this->db->group_by('id_pelanggan');
		$total_responden = $this->db->count_all_results();

		$nilai_mis = [];
		$nilai_mss = [];
		$total_presepsi = [];
		$total_ekspetasi = [];
		foreach ($pernyataan as $key) {
			$tampung = [];
			$tampung2 = [];
			$this->db->where('id_kuesioner', $id_kuesioner);
			$this->db->where('id_pernyataan', $key->id_pernyataan);
			$jawaban = $this->db->get('t_jawaban')->result();
			foreach ($jawaban as $j) {
				array_push($tampung, $j->presepsi);
				array_push($tampung2, $j->ekspetasi);
			}
			$a = array_sum($tampung);
			$b = array_sum($tampung2);

			array_push($total_presepsi, $a);
			array_push($total_ekspetasi, $b);
			array_push($nilai_mis, round($b / $total_responden, 2));
			array_push($nilai_mss, round($a / $total_responden, 2));
		}

		$sum_nilai_mis = array_sum($nilai_mis);
		$nilai_wf = [];
		for ($i = 0; $i < count($nilai_mis); $i++) {
			array_push($nilai_wf, round((($nilai_mis[$i] / $sum_nilai_mis) * 100), 2));
		}

		$nilai_ws = [];
		for ($i = 0; $i < count($nilai_wf); $i++) {
			array_push($nilai_ws, round(($nilai_wf[$i] * $nilai_mss[$i]), 2));
		}

		$sum_nilai_ws = array_sum($nilai_ws);
		$nilai_csi = round(($sum_nilai_ws / 5), 2);
		if ($nilai_csi > 80 and $nilai_csi <= 100) {
			$kriteria = 'Sangat Puas';
		} else if ($nilai_csi > 60 and $nilai_csi <= 80) {
			$kriteria = 'Puas';
		} else if ($nilai_csi > 40 and $nilai_csi <= 60) {
			$kriteria = 'Cukup Puas';
		} else if ($nilai_csi > 20 and $nilai_csi <= 40) {
			$kriteria = 'Kurang Puas';
		} else if ($nilai_csi > 0 and $nilai_csi <= 20) {
			$kriteria = 'Tidak Puas';
		} else {
			$kriteria = 'Error';
		}

		$nilai_gap = [];
		for ($i = 0; $i < count($nilai_mis); $i++) {
			array_push($nilai_gap, round(($nilai_mis[$i] - $nilai_mss[$i]), 2));
		}
		date_default_timezone_set('Asia/Jakarta');
		$tanggal_evaluasi = date('Y-m-d H:i:s');
		$data_evaluasi = [
			'id_kuesioner' =>  $id_kuesioner,
			'total_responden' => $total_responden,
			'nilai_csi' => $nilai_csi,
			'indeks_csi' => $kriteria,
			'tanggal_evaluasi' => $tanggal_evaluasi,
		];

		$add_evaluasi = $this->Evaluasi_model->tambah_evaluasi($data_evaluasi);
		$id_evaluasi = $this->db->insert_id();

		$i = 0;
		foreach ($pernyataan as $p) {
			$data = [
				'id_evaluasi' => $id_evaluasi,
				'id_pernyataan' => $p->id_pernyataan,
				'total_ekspetasi' => $total_ekspetasi[$i],
				'total_presepsi' => $total_presepsi[$i],
				'mis' => $nilai_mis[$i],
				'mss' => $nilai_mss[$i],
				'wf' => $nilai_wf[$i],
				'ws' => $nilai_ws[$i],
				'gap' => $nilai_gap[$i],
			];
			$this->Evaluasi_model->tambah_detail_evaluasi($data);
			$i++;
		}

		if ($add_evaluasi) {
			$this->session->set_flashdata('message', '<strong>Evaluasi Berhasil</strong>
											<i class="bi bi-check-circle-fill"></i>');
		} else {
			$this->session->set_flashdata('message', '<strong>Evaluasi Gagal, Silahkan coba ulang</strong>
																			<i class="bi bi-exclamation-circle-fill"></i>');
		}
		redirect('manajer/data-evaluasi');
	}

	public function proses_hapus_evaluasi()
	{
		$this->db->where('id_evaluasi', $this->input->post('id_evaluasi'));
		$this->db->delete('t_evaluasi');
		$this->session->set_flashdata('message', '<strong>Data Perhitungan Berhasil Dihapus</strong>
															<i class="bi bi-check-circle-fill"></i>');
		redirect('manajer/data-evaluasi');
	}

	public function cetak_pdf()
	{
		$id_evaluasi = $this->input->post('id_evaluasi');
		$id_kuesioner = $this->input->post('id_kuesioner');

		$kuesioner = $this->Kuesioner_model->dapat_satu_kuesioner($id_kuesioner);
		$evaluasi = $this->Evaluasi_model->dapat_satu_evaluasi($id_evaluasi);

		$this->db->where('id_evaluasi', $id_evaluasi);
		$this->db->where('gap <=', 0);
		$detail_evaluasi = $this->db->get('t_detail_evaluasi')->result();

		$nama_file_pdf = "Hasil_Evaluasi_" . $kuesioner->judul_kuesioner . '_' . $evaluasi->tanggal_evaluasi . '_' . $evaluasi->id_evaluasi;
		$foto = $this->encode_img_base64(base_url('assets/img/LogoAbell.png'));

		if ($evaluasi and $detail_evaluasi) {
			$html = $this->load->view('manajer/evaluasi/pdf', [
				'kuesioner' => $kuesioner,
				'evaluasi' => $evaluasi,
				'detail_evaluasi' => $detail_evaluasi,
				'foto' => $foto,
			], true);
		}

		$filename = $nama_file_pdf;
		$paper = 'A4';
		$orientation = 'portrait';
		$stream = true;

		$this->pdfgenerator->generate($html, $filename, $paper, $orientation, $stream);
	}

	function encode_img_base64($img_path = false): string
	{
		if ($img_path) {
			$path = $img_path;
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			return 'data:image/' . $type . ';base64,' . base64_encode($data);
		}
		return '';
	}
}
