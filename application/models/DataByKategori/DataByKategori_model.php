<?php
class DataByKategori_model extends CI_Model
{
    public function get($id = null, $kategori_id = null)
    {
        $this->db->select('*');
        $this->db->from('databykategori');
        if ($id != null) {
            $this->db->where('id_databykategori', $id);
        }
        if ($kategori_id != null) {
            $this->db->where('kategori_id', $kategori_id);
        }
        return $this->db->get();
    }
    public function update($data, $id_databykategori)
    {
        $this->db->where('id_databykategori', $id_databykategori);
        $this->db->update('databykategori', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('databykategori', $data);
        return $this->db->insert_id();
    }

    public function insertMany($data)
    {
        $this->db->insert_batch('databykategori', $data);
        return $this->db->affected_rows();
    }

    public function delete($id_databykategori)
    {
        $this->db->delete('databykategori', ['id_databykategori' => $id_databykategori]);
        return $this->db->affected_rows();
    }
}
