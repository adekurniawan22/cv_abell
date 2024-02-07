<?php
class Pernyataan_model extends CI_Model
{

    public function dapat_pernyataan()
    {
        $query = $this->db->get('t_pernyataan');
        return $query->result();
    }

    public function dapat_satu_pernyataan($id_pernyataan)
    {
        $this->db->where('id_pernyataan', $id_pernyataan);
        $query = $this->db->get('t_pernyataan');
        return $query->row();
    }

    public function tambah_pernyataan($data)
    {
        $this->db->insert('t_pernyataan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_pernyataan($id_pernyataan, $data)
    {
        $this->db->where('id_pernyataan', $id_pernyataan);
        $this->db->update('t_pernyataan', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function dapat_dimensi()
    {
        $query = $this->db->get('t_dimensi');
        return $query->result();
    }
}
