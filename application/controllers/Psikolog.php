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
        $nama_psikolog = htmlspecialchars($this->input->post('nama_barang'));
        $notelp_psikolog = htmlspecialchars($this->input->post('jenis_barang'));
        $alamat_psikolog = htmlspecialchars($this->input->post('stok'));
        $alamat_psikolog = htmlspecialchars($this->input->post('stok'));

        $data = array(
            'nama_psikolog' => $nama_psikolog,
            'notelp_psikolog' => $notelp_psikolog,
            'alamat_psikolog' => $alamat_psikolog
        );

        $this->db->insert('psikolog', $data);

        redirect('psikolog');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        New Psikolog has been added!</div>');
    }

    public function deletePsikolog($id_psikolog)
    {
        $this->Psikolog_model->delete($id_psikolog);
        redirect('psikolog');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Psikolog has been deleted!</div>');
    }

    public function addJadwal()
    {
        $data['title'] = 'Buat Jadwal Konsultasi';
        $data['user'] = $this->User_model->user();
        $data['maxPs'] = $this->Psikolog_model->jumlah_psikolog();

        $this->form_validation->set_rules('popsize', 'Population size', 'required');
        $this->form_validation->set_rules('cr', 'Crossover rate', 'required|decimal');
        $this->form_validation->set_rules('mr', 'Mutation rate', 'required|decimal');
        $this->form_validation->set_rules('iterasi', 'Iterasi', 'required',);
        $this->form_validation->set_rules('thresholdSaget', 'Threshold', 'required|decimal');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jadwal/index', $data);
            $this->load->view('templates/footer');
        } else {
            $popsize = (int)$this->input->post('popsize');
            $cr = (float)$this->input->post('cr');
            $mr = (float)$this->input->post('mr');
            $iterasi = (int)$this->input->post('iterasi');
            $thresholdSaget = (float)$this->input->post('thresholdSaget');
            $maxPs = (int)$this->Psikolog_model->jumlah_psikolog();


            // $this->algoritma->run($popsize, $cr, $mr, $iterasi, $thresholdSaget, $maxPs);
        }
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
        $config['base_url'] = base_url() . 'psikolog/index';
        $config['total_rows'] = $this->db->count_all('psikolog');
        $config['per_page'] = 5;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        return $this->Psikolog_model->data($config['per_page'], $from);
    }
}
