<?php
class Pegawai_model extends CI_Model
{
    public function dapat_pegawai()
    {
        $query = $this->db->get('t_pegawai');
        return $query->result();
    }

    public function dapat_satu_pegawai($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $query = $this->db->get('t_pegawai');
        return $query->row();
    }

    public function jumlah_pegawai()
    {
        $this->db->from('t_pegawai');
        $total_pegawai = $this->db->count_all_results();
        return $total_pegawai;
    }

    public function tambah_pegawai($data)
    {
        $this->db->insert('t_pegawai', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_pegawai($id_pegawai, $data)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->update('t_pegawai', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekDuplikat($field, $value)
    {
        $this->db->where($field, $value);
        $query = $this->db->get('t_pegawai'); // Ganti 'pegawai' dengan nama tabel Anda

        return $query->num_rows() > 0;
    }

    public function checkEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('t_pegawai'); // Gantilah 't_users' dengan nama tabel pegawai yang sesuai

        return $query->num_rows() > 0;
    }
}
