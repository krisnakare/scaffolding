<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    public function get_barang_all()
    {
        $query = $this->db->get('barang');
        return $query->result_array();
    }

    public  function get_barang_id($id)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('id_barang', $id);
        return $this->db->get();
    }

    public function tambah_sewa($data)
    {
        $this->db->insert('tabel_sewa', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function tambah_detail_sewa($data)
    {
        $this->db->insert('detail_sewa', $data);
    }
}
