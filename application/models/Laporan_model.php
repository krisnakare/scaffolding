<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Laporan_model extends CI_Model
{
    public function data($number, $offset)
    {
        $this->db->join('detail_pengembalian', 'detail_pengembalian.invoice_id = tabel_sewa.invoice_id');
        $this->db->join('detail_sewa', 'detail_sewa.invoice_id = tabel_sewa.invoice_id');
        return $this->db->get('tabel_sewa', $number, $offset)->result();
    }

    public function getLaporan()
    {
        $query = "SELECT 
        tabel_sewa.invoice_id, nama_penyewa, tgl_sewa, tgl_pengembalian, total_biaya, jumlah_barang, biaya, status
        FROM tabel_sewa
        INNER JOIN detail_sewa
        ON tabel_sewa.invoice_id = detail_sewa.invoice_id
        INNER JOIN detail_pengembalian
        ON detail_pengembalian.invoice_id = detail_sewa.invoice_id
        -- ON detail_sewa.id_barang = barang.id_barang
        WHERE tabel_sewa.invoice_id = '$invoice_id'";
        return $this->db->query($query)->row_array();
    }

}
