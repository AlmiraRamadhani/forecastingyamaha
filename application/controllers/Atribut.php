<?php
class Atribut extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login'))
            redirect('user/login');

        $this->load->model('atribut_model');
    }

    public function index()
    {
        $data['rows'] = $this->atribut_model->tampil($this->input->get('search'));
        $data['title'] = 'Data Barang';

        load_view('atribut/tampil', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('id_atribut', 'ID atribut', 'required|is_unique[tb_atribut.id_atribut]');
        $this->form_validation->set_rules('nama_atribut', 'Nama atribut', 'required|is_unique[tb_atribut.nama_atribut]');

        $data['title'] = 'Tambah Barang';

        if ($this->form_validation->run() === FALSE) {
            load_view('atribut/tambah', $data);
        } else {
            $fields = array(
                'id_atribut' => $this->input->post('id_atribut'),
                'nama_atribut' => $this->input->post('nama_atribut'),
            );
            $this->atribut_model->tambah($fields);
            redirect('atribut');
        }
    }

    public function ubah($ID = null)
    {
        $this->form_validation->set_rules('id_atribut', 'ID atribut', 'required');
        $this->form_validation->set_rules('nama_atribut', 'Nama atribut', 'required');

        $data['title'] = 'Ubah Barang';

        if ($this->form_validation->run() === FALSE) {
            $data['row'] = $this->atribut_model->get_atribut($ID);
            load_view('atribut/ubah', $data);
        } else {
            $fields = array(
                'id_atribut' => $this->input->post('id_atribut'),
                'nama_atribut' => $this->input->post('nama_atribut'),
            );
            $this->atribut_model->ubah($fields, $ID);
            redirect('atribut');
        }
    }

    public function hapus($ID = null)
    {
        $this->atribut_model->hapus($ID);
        redirect('atribut');
    }
}
