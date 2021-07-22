<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Barang_model extends CI_Model
{
    public function data($number, $offset)
    {
        return $this->db->get('barang', $number, $offset)->result();
    }

    public function getBarangById($id)
    {
        $query = "SELECT * FROM barang
        WHERE id_barang = $id";

        
        return $this->db->query($query)->row_array();
    }

    public function update_barang()
    {
        $id_barang = $this->input->post('id_barang');
        $nama_barang = $this->input->post('nama_barang');
        $jenis_barang = $this->input->post('jenis_barang');
        $stok = $this->input->post('stok');
        $harga_sewa = $this->input->post('harga_sewa');
        $harga_barang = $this->input->post('harga_barang');
        $data = [
            'id_barang' => $id_barang,
            'nama_barang' => $nama_barang,
            'jenis_barang' => $jenis_barang,
            'stok' => $stok,
            'harga_sewa' => $harga_sewa,
            'harga_barang' => $harga_barang
        ];

        $this->db->where('id_barang',$id_barang);
        $this->db->update('barang', $data);
    }

    public function hapus_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
    }
}
