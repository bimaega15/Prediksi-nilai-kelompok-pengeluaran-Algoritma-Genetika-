<?php
class Kategori_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        if ($id != null) {
            $this->db->where('id_kategori', $id);
        }
        return $this->db->get();
    }
    public function joinData($id = null)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->join('databykategori', 'kategori.id_kategori = databykategori.kategori_id');
        if ($id != null) {
            $this->db->where('id_kategori', $id);
        }
        return $this->db->get();
    }
    public function update($data, $id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('kategori', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('kategori', $data);
        return $this->db->insert_id();
    }

    public function delete($id_kategori)
    {
        $this->db->delete('kategori', ['id_kategori' => $id_kategori]);
        return $this->db->affected_rows();
    }
}
