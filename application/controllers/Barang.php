<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Barang_model');
        
    }

    public function index()
    {
        $data['title'] = 'Daftar Barang';
        $data['user'] = $this->User_model->user();

        $data['barang'] = $this->pagination();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('psikolog/index', $data);
        $this->load->view('templates/footer');
    }


    public function tambah_barang()
    {
        $nama_barang = htmlspecialchars($this->input->post('nama_barang'));
        $jenis_barang = htmlspecialchars($this->input->post('jenis_barang'));
        $stok = htmlspecialchars($this->input->post('stok'));
        $harga_sewa = htmlspecialchars($this->input->post('harga_sewa'));
        $harga_barang = htmlspecialchars($this->input->post('harga_barang'));

        $data = array(
            'nama_barang' => $nama_barang,
            'jenis_barang' => $jenis_barang,
            'stok' => $stok,
            'harga_sewa' => $harga_sewa,
            'harga_barang' => $harga_barang
        );

        $this->db->insert('barang', $data);

        redirect('barang');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        New Item has been added!</div>');
    }

    public function hapus_barang($id_barang)
    {
        $this->Barang_model->delete($id_barang);
        redirect('barang');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Barang has been deleted!</div>');
    }

    public function update_barang()
    {
        $this->Barang_model->subMenuedit();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Barang Edited!</div>');
        redirect('barang');
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
        $config['base_url'] = base_url() . 'barang/index';
        $config['total_rows'] = $this->db->count_all('barang');
        $config['per_page'] = 5;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        return $this->Barang_model->data($config['per_page'], $from);
    }
}
