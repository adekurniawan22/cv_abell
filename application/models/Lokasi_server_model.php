<?php
class Lokasi_server_model extends CI_Model
{
    public function dapat_lokasi_server()
    {
        $query = $this->db->get('t_lokasi_server');
        return $query->result();
    }

    public function dapat_satu_lokasi_server($id_lokasi_server)
    {
        $this->db->where('id_lokasi_server', $id_lokasi_server);
        $query = $this->db->get('t_lokasi_server');
        return $query->row();
    }

    public function tambah_lokasi_server($data)
    {
        $this->db->insert('t_lokasi_server', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_lokasi_server($id_lokasi_server, $data)
    {
        $this->db->where('id_lokasi_server', $id_lokasi_server);
        $this->db->update('t_lokasi_server', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
