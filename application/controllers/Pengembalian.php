<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pengembalian_model');
        $this->load->model('Barang_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Pengembalian';
        $data['user'] = $this->User_model->user();
        $data['pengembalian'] = $this->pagination();
        $data['barang'] = $this->Barang_model->getBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengembalian/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data['title'] = 'Form Pengembalian';
        $data['user'] = $this->User_model->user();
        $data['barang'] = $this->Barang_model->getBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengembalian/add', $data);
        $this->load->view('templates/footer');
    }

    // public function tambah_sewa()
    // {
    //     $invoice_id = date('y') . date('m') . date('d') . date('h') . date('i') . date('s');

    //     $nama_penyewa = htmlspecialchars($this->input->post('nama_penyewa'));
    //     $tgl_sewa = htmlspecialchars($this->input->post('tgl_sewa'));
    //     $lama_sewa = htmlspecialchars($this->input->post('lama_sewa'));
    //     $status = "pinjam";

    //     $data = array(
    //         'invoice_id' => $invoice_id,
    //         'nama_penyewa' => $nama_penyewa,
    //         'tgl_sewa' => $tgl_sewa,
    //         'lama_sewa' => $lama_sewa,
    //         'status' => $status
    //     );
    //     $this->db->insert('tabel_sewa', $data);


    //     $id_barang = htmlspecialchars($this->input->post('id_barang'));
    //     $harga_sewa = $this->Pengembalian_model->getHargaSewa($id_barang);
    //     $banyak_barang = htmlspecialchars($this->input->post('banyak_barang'));
    //     $total_biaya = $banyak_barang * $lama_sewa * $harga_sewa;

    //     $data_detail = array(
    //         'invoice_id' => $invoice_id,
    //         'id_barang' => $id_barang,
    //         'banyak_barang' => $banyak_barang,
    //         'total_biaya' => $total_biaya
    //     );
    //     $this->db->insert('detail_sewa', $data_detail);

    //     redirect('pengembalian');
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         New Item has been added!</div>');
    // }

    public function hapus_pengembalian($invoice_id)
    {
        $this->Pengembalian_model->hapus_pengembalian($invoice_id);
        $this->Pengembalian_model->hapus_detail($invoice_id);
        redirect('pengembalian');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data pengembalian has been deleted!</div>');
    }


    private function pagination()
    {
        $this->load->library('pagination');
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $config['base_url'] = base_url() . 'pengembalian/index';
        $config['total_rows'] = $this->db->count_all('tabel_pengembalian');
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        return $this->Pengembalian_model->data($config['per_page'], $from);
    }
}
