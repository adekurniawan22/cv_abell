<?php
class Pengguna_model extends CI_Model
{
    public function dapat_pengguna()
    {
        // $this->db->where('role !=', 'Manajer');
        // $this->db->group_by('t_pengguna.id_pengguna'); // Gunakan GROUP BY agar tidak ada duplikat
        $query = $this->db->get('t_pengguna');
        return $query->result();
    }

    public function dapat_satu_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get('t_pengguna');
        return $query->row();
    }

    public function jumlah_pengguna()
    {
        $this->db->where('role', 'Pelanggan');
        $this->db->from('t_pengguna');
        $total_pengguna = $this->db->count_all_results();
        return $total_pengguna;
    }

    public function jumlah_pengguna_aktif()
    {
        $this->db->where('status_aktif', '1');
        $this->db->where('role', 'Pelanggan');
        $this->db->from('t_pengguna');
        $total_pengguna_aktif = $this->db->count_all_results();
        return $total_pengguna_aktif;
    }

    public function jumlah_pengguna_tidak_aktif()
    {
        $this->db->where('status_aktif', '0');
        $this->db->where('role', 'Pelanggan');
        $this->db->from('t_pengguna');
        $total_pengguna_tidak_aktif = $this->db->count_all_results();
        return $total_pengguna_tidak_aktif;
    }


    public function tambah_pengguna($data)
    {
        $this->db->insert('t_pengguna', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_pengguna($id_pengguna, $data)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->update('t_pengguna', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekDuplikat($field, $value)
    {
        $this->db->where($field, $value);
        $query = $this->db->get('t_pengguna'); // Ganti 'pengguna' dengan nama tabel Anda

        return $query->num_rows() > 0;
    }

    public function email_ada($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('t_pengguna'); // Gantilah 't_users' dengan nama tabel pengguna yang sesuai

        return $query->num_rows() > 0;
    }
}
