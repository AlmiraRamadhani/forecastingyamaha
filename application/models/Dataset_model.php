<?php
class Dataset_model extends CI_Model
{

    protected $table = 'tb_dataset';
    protected $kode = 'nomor';

    public function tampil($awal = '', $akhir = '')
    {
        $where = '';
        if ($awal)
            $where .= "AND tanggal>='$awal'";
        if ($akhir)
            $where .= "AND tanggal<='$akhir'";


        $rows = $this->db->query("SELECT *
            FROM tb_dataset d WHERE 1 $where                                          
            ORDER BY d.nomor, d.id_atribut")->result();

        return $rows;
    }

    public function get_dataset($ID = null)
    {
        $query = $this->db->get_where($this->table, array($this->kode => $ID));
        return $query->result();
    }

    public function get_nomor()
    {
        $row = $this->db->query("SELECT nomor + 1 AS nomor FROM tb_dataset ORDER BY nomor DESC LIMIT 1")->row();
        if ($row)
            return $row->nomor;
        else
            return 1;
    }

    public function tambah($fields)
    {
        $this->db->insert($this->table, $fields);
    }

    public function ubah($fields, $ID)
    {
        $this->db->update($this->table, $fields, array('id_dataset' => $ID));
    }

    public function hapus($ID)
    {
        $this->db->delete($this->table, array($this->kode => $ID));
    }
}
