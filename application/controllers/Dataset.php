<?php
class Dataset extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login'))
            redirect('user/login');

        $this->load->model('dataset_model');
        $this->load->model('atribut_model');
    }

    public function index()
    {
        $data['title'] = 'Data Transaksi';
        $data['data'] = get_data($this->input->get('search'));
        $data['dataset'] = get_dataset($this->input->get('search'));
        $data['ATRIBUT'] = get_atribut();

        load_view('dataset/tampil', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nomor', 'Nomor', 'required|is_unique[tb_dataset.nomor]');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        $data['title'] = 'Tambah Transaksi';

        if ($this->form_validation->run() === FALSE) {
            $data['nomor'] = $this->dataset_model->get_nomor();
            $data['atribut'] = get_atribut();

            load_view('dataset/tambah', $data);
        } else {
            foreach ($this->input->post('nilai[]') as $key => $val) {
                $fields = array(
                    'nomor' => $this->input->post('nomor'),
                    'tanggal' => $this->input->post('tanggal'),
                    'id_atribut' => $key,
                    'nilai' => $val,
                );
                $this->dataset_model->tambah($fields);
            }
            redirect('dataset');
        }
    }

    public function import()
    {
        $data['title'] = "Import Transaksi";
        $data['atribut'] = get_atribut();
        load_view("dataset/import", $data);
    }

    public function ubah($ID = null)
    {
        $this->form_validation->set_rules('nomor', 'Nomor', 'required');
        $this->form_validation->set_rules('nilai[]', 'Nilai dataset', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        $data['title'] = 'Ubah Transaksi';

        if ($this->form_validation->run() === FALSE) {
            $data['rows'] = $this->dataset_model->get_dataset($ID);
            $data['atribut'] = get_atribut();
            load_view('dataset/ubah', $data);
        } else {
            foreach ($this->input->post('nilai') as $key => $val) {
                $fields = array(
                    'tanggal' => $this->input->post('tanggal'),
                    'nilai' => $val,
                );
                $this->dataset_model->ubah($fields, $key);
            }
            redirect('dataset');
        }
    }

    public function hapus($ID = null)
    {
        $this->dataset_model->hapus($ID);
        redirect('dataset');
    }
}
