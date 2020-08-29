<?php
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dataset_model');
        $this->load->model('atribut_model');
        $this->load->helper('tm');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['atribut'] = get_atribut();

        $tahun = get_var("SELECT max(YEAR(tanggal)) FROM tb_dataset");

        $data['awal'] = $tahun . '-01-01';
        $data['akhir'] =   $tahun . '-12-31';

        $data['dataset'] = get_dataset($data['awal'], $data['akhir']);

        $dt = strtotime($data['awal']);
        for ($a = 0; $a < count($data['dataset']); $a++) {
            $data['names'][] = date("M-Y", strtotime("+$a month", $dt));
        }
        load_view('home', $data);
    }

    public function tentang()
    {
        $data['title'] = 'Tentang Kami';
        load_view('tentang', $data);
    }
}