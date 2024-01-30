<?php
class Pelanggan_model extends CI_Model
{
    public function dapat_pelanggan()
    {
        $query = $this->db->get('t_pelanggan');
        return $query->result();
    }

    public function dapat_satu_pelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('t_pelanggan');
        return $query->row();
    }

    public function jumlah_pelanggan()
    {
        $this->db->from('t_pelanggan');
        $total_pelanggan = $this->db->count_all_results();
        return $total_pelanggan;
    }

    public function jumlah_pelanggan_aktif()
    {
        $this->db->where('status_aktif', '1');
        $this->db->from('t_pelanggan');
        $total_pelanggan_aktif = $this->db->count_all_results();
        return $total_pelanggan_aktif;
    }

    public function jumlah_pelanggan_tidak_aktif()
    {
        $this->db->where('status_aktif', '0');
        $this->db->from('t_pelanggan');
        $total_pelanggan_tidak_aktif = $this->db->count_all_results();
        return $total_pelanggan_tidak_aktif;
    }


    public function tambah_pelanggan($data)
    {
        $this->db->insert('t_pelanggan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_pelanggan($id_pelanggan, $data)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->update('t_pelanggan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekDuplikat($field, $value)
    {
        $this->db->where($field, $value);
        $query = $this->db->get('t_pelanggan'); // Ganti 'pelanggan' dengan nama tabel Anda

        return $query->num_rows() > 0;
    }
}
