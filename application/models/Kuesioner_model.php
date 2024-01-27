<?php
class Kuesioner_model extends CI_Model
{
    public function dapat_kuesioner()
    {
        $query = $this->db->get('t_kuesioner');
        return $query->result();
    }

    public function dapat_satu_kuesioner($id_kuesioner)
    {
        $this->db->where('id_kuesioner', $id_kuesioner);
        $query = $this->db->get('t_kuesioner');
        return $query->row();
    }

    public function tambah_kuesioner($data)
    {
        $this->db->insert('t_kuesioner', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_kuesioner($id_kuesioner, $data)
    {
        $this->db->where('id_kuesioner', $id_kuesioner);
        $this->db->update('t_kuesioner', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
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

    public function dapat_pernyataan($id_kuesioner)
    {
        $this->db->where('id_kuesioner', $id_kuesioner);
        $query = $this->db->get('t_pernyataan');
        return $query->result();
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
}
