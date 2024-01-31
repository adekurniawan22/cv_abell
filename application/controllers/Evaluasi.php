<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Kuesioner_model');
		$this->load->model('Pelanggan_model');
		$this->load->model('Pernyataan_model');
		$this->load->model('Jawaban_model');
	}

	public function index()
	{
		$id_kuesioner = $this->input->post('id_kuesioner');

		$kuesioner = $this->Kuesioner_model->dapat_satu_kuesioner($id_kuesioner);
		$pernyataan = $this->Pernyataan_model->dapat_pernyataan($id_kuesioner);

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


		$data['title'] = "EValuasi Kuesioner . $kuesioner->judul_kuesioner";
		$data['pernyataan'] = $pernyataan;
		$data['jumlah_pelanggan'] = $this->Pelanggan_model->jumlah_pelanggan();
		$data['total_responden'] = $total_responden;
		$data['total_presepsi'] = $total_presepsi;
		$data['total_ekspetasi'] = $total_ekspetasi;
		$data['nilai_mis'] = $nilai_mis;
		$data['nilai_mss'] = $nilai_mss;
		$data['nilai_wf'] = $nilai_wf;
		$data['nilai_ws'] = $nilai_ws;
		$data['nilai_csi'] = $nilai_csi;
		$data['kriteria_nilai_csi'] = $kriteria;
		$data['nilai_gap'] = $nilai_gap;
		$this->load->view('admin/evaluasi/evaluasi', $data);
	}
}
