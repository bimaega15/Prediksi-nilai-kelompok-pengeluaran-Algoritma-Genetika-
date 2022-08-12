<?php
class Pengujian_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('pengujian');
        if ($id != null) {
            $this->db->where('id_pengujian', $id);
        }
        return $this->db->get();
    }
    public function getJoin($id = null)
    {
        $this->db->select('pj.*, kg.nama_kategori');
        $this->db->from('pengujian pj');
        $this->db->join('kategori kg', 'kg.id_kategori = pj.kategori_id', 'left');
        if ($id != null) {
            $this->db->where('pj.id_pengujian', $id);
        }
        return $this->db->get();
    }
    public function insert($data)
    {
        $this->db->insert('pengujian', $data);
        return $this->db->insert_id();
    }

    public function insertMany($data)
    {
        $this->db->insert_batch('pengujian', $data);
        return $this->db->affected_rows();
    }

    public function delete($id_pengujian)
    {
        $this->db->delete('pengujian', ['id_pengujian' => $id_pengujian]);
        return $this->db->affected_rows();
    }
}
