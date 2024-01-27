<?php
class Jawaban_model extends CI_Model
{

    public function tambah_jawaban($data)
    {
        $this->db->insert('t_jawaban', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
