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

    public function getBarang()
    {
        return $this->db->get('barang')->result();
    }

    public function stok($id_barang)
    {
        // Check stok barang apakah jumlah barang yang akan diinputkan itu kurang dari stok barang, maka return true
        $query = "SELECT stok FROM barang
        WHERE barang.id_barang = '$id_barang'";
        $results = $this->db->query($query)->row_array('stok');
        return $results;
    }

    public function update_barang()
    {
        $id_barang = $this->input->post('id_barang');
        $nama_barang = $this->input->post('nama_barang');
        $stok = $this->input->post('stok');
        $harga_sewa = $this->input->post('harga_sewa');
        $harga_barang = $this->input->post('harga_barang');
        $data = [
            'id_barang' => $id_barang,
            'nama_barang' => $nama_barang,
            'stok' => $stok,
            'harga_sewa' => $harga_sewa,
            'harga_barang' => $harga_barang
        ];

        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $data);
    }

    public function hapus_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
    }
}
