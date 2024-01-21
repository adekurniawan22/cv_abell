<?php
class Pengguna_model extends CI_Model
{
    public function dapat_pengguna()
    {
        $this->db->select('t_pengguna.*, t_role.*'); // Gunakan * untuk memilih semua kolom
        $this->db->from('t_pengguna');
        $this->db->join('t_role', 't_pengguna.id_role = t_role.id_role');
        // $this->db->where('t_pengguna.id_role =', 3);
        $this->db->group_by('t_pengguna.id_pengguna'); // Gunakan GROUP BY agar tidak ada duplikat
        $query = $this->db->get();
        return $query->result();
    }

    public function dapat_satu_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get('t_pengguna');
        return $query->row();
    }

    public function jumlah_personil()
    {
        $this->db->from('t_personil');
        $total_personil = $this->db->count_all_results();
        return $total_personil;
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
}
