<?php
class Hitung extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //if(!$this->session->userdata('login'))
        //redirect('user/login');

        $this->load->model('dataset_model');
        $this->load->model('atribut_model');

        $this->load->helper('tm');
    }

    public function index()
    {
        $this->form_validation->set_rules('periode', 'Periode', 'required|less_than_equal_to[12]');
        $this->form_validation->set_rules('awal', 'Periode Awal', 'required');
        $this->form_validation->set_rules('akhir', 'Periode Akhir', 'required');

        $row_awal = $this->db->query("SELECT MIN(tanggal) AS awal FROM tb_dataset")->row();
        $row_akhir = $this->db->query("SELECT MAX(tanggal) AS akhir FROM tb_dataset")->row();

        $data['title'] = 'Peramalan';
        $data['atribut'] = get_atribut();
        $data['periode'] = $this->input->post('periode');

        if ($this->form_validation->run() === FALSE) {

            $data['awal'] = set_value('awal', $row_awal ? $row_awal->awal : '');
            $data['akhir'] = set_value('akhir', $row_akhir ? $row_akhir->akhir : '');

            load_view('hitung/hitung_form', $data);
        } else {
            $data['awal'] = set_value('awal', $row_awal ? $row_awal->awal : '');
            $data['akhir'] = set_value('akhir', $row_akhir ? $row_akhir->akhir : '');

            $data['dataset'] = get_dataset($data['awal'], $data['akhir']);

            $dt = strtotime($data['awal']);
            for ($a = 0; $a < count($data['dataset']) + $data['periode']; $a++) {
                $data['names'][] = date("M-Y", strtotime("+$a month", $dt));
            }

            //echo '<pre>' . print_r($data['names'], 1) . '</pre>';

            $this->load->view('header', $data);
            $this->load->view('hitung/hitung_form', $data);
            $this->load->view('hitung/hitung_hasil', $data);
            $this->load->view('footer', $data);
        }
    }
    public function cetak()
    {
        $data['title'] = 'Perhitungan';
        $data['atribut'] = get_atribut();
        $data['periode'] = $this->input->get('periode');
        $data['chart'] = $this->input->get('chart');
        $data['awal'] = $this->input->get('awal');
        $data['akhir'] = $this->input->get('akhir');

        $data['dataset'] = get_dataset($data['awal'], $data['akhir']);

        $dt = strtotime($data['awal']);
        for ($a = 0; $a < count($data['dataset']) + $data['periode']; $a++) {
            $data['names'][] = date("M-Y", strtotime("+$a month", $dt));
        }
        load_view_cetak('hitung/hitung_cetak', $data);
    }
}

