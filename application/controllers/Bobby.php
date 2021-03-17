<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bobby extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buku_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'BPPD ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['buku'] = $this->Buku_model->getALlbuku();
        if ($this->input->post('cari')) {
            $data['buku'] = $this->Buku_model->cariDatabuku();
        }

        $this->load->view('user/index', $data);
    }
    public function tamp()
    {
        $data['title'] = 'BPPD ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['buku'] = $this->Buku_model->getALlbuku();
        if ($this->input->post('cari')) {
            $data['buku'] = $this->Buku_model->cariDatabuku();
        }

        $this->load->view('user/tampil', $data);
    }
    public function print()
    {
        $data['title'] = 'BPPD ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['buku'] = $this->Buku_model->getALlbuku();
        if ($this->input->post('cari')) {
            $data['buku'] = $this->Buku_model->cariDatabuku();
        }

        $this->load->view('user/print', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Form ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('judul', 'Judul Buku', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('rep', 'rep', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/tambah', $data);
        } else {
            $this->Buku_model->tambahDatabuku();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('Bobby');
        }
    }

    public function hapus($id)
    {
        $this->Buku_model->hapusDatabuku($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('Bobby');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Form';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mahasiswa'] = $this->Buku_model->getbukuById($id);
        $this->load->view('user/detail', $data);
    }

    public function ubahx($id)
    {
        $data['title'] = 'ubah Form ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mahasiswa'] = $this->Buku_model->getbukuById($id);

        $this->form_validation->set_rules('judul', 'Judul Buku', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('rep', 'rep', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('user/ubah', $data);
        } else {
            $this->Buku_model->ubahbuku();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('Bobby');
        }
    }
}