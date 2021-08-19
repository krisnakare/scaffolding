<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyewaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Penyewaan_model');
        // $this->form_validation();
    }

    public function index()
    {
        $data['title'] = 'Daftar Penyewaan';
        $data['user'] = $this->User_model->user();

        $data['penyewaan'] = $this->pagination();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penyewaan/index', $data);
        $this->load->view('templates/footer');
    }


    public function tambah_sewa()
    {
        $this->form_validation->set_rules('nama_penyewa', 'Nama Penyewa', 'required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Data Sewa';
            $data['user'] = $this->User_model->user();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('penyewaan/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_penyewa = htmlspecialchars($this->input->post('nama_penyewa'));
            $tgl_sewa = htmlspecialchars($this->input->post('tgl_sewa'));
            $lama_sewa = htmlspecialchars($this->input->post('lama_sewa'));
            $status = "pinjam";
    
            $data = array(
                'nama_penyewa' => $nama_penyewa,
                'tgl_sewa' => $tgl_sewa,
                'lama_sewa' => $lama_sewa,
                'status' => $status
                
            );
    
            $this->db->insert('tabel_sewa', $data);
    
            redirect('penyewaan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Item has been added!</div>');
        }
      
    }

    public function tambah_keranjang($id_barang)
    {
        $barang = $this->db->get_where('barang', array('id_barang' => $id_barang));
        $banyak_barang = intval($this->input->post('banyak_barang'));

        $data = array(
            'id_barang' => $barang->id_barang,
            'banyak_barang' => $banyak_barang,
            'total_biaya' => $barang->harga_sewa * $banyak_barang    
        );

        $this->cart->insert($data);
    }

    public function hapus_penyewaan($id_sewa)
    {
        $this->Penyewaan_model->hapus_penyewaan($id_sewa);
        redirect('penyewaan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Penyewaan has been deleted!</div>');
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
        $config['base_url'] = base_url() . 'penyewaan/index';
        $config['total_rows'] = $this->db->count_all('tabel_sewa');
        $config['per_page'] = 10;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        return $this->Penyewaan_model->data($config['per_page'], $from);
    }
}
