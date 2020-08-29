<?php
class Atribut_model extends CI_Model
{

    protected $table = 'tb_atribut';
    protected $kode = 'id_atribut';

    public function tampil($search = '')
    {
        return $this->db->query("SELECT * FROM tb_atribut WHERE nama_atribut LIKE '%" . $search . "%' ORDER BY id_atribut")->result();
    }

    public function get_atribut($ID = null)
    {
        $query = $this->db->get_where($this->table, array($this->kode => $ID));
        return $query->row();
    }

    public function tambah($fields)
    {
        $this->db->insert($this->table, $fields);
        $this->db->query("INSERT INTO tb_dataset (nomor, tanggal, id_atribut) 
            SELECT nomor, tanggal, '$fields[id_atribut]' FROM tb_dataset GROUP BY nomor");
    }

    public function ubah($fields, $ID)
    {
        $this->db->update($this->table, $fields, array($this->kode => $ID));
    }

    public function hapus($ID)
    {
        $this->db->delete($this->table, array($this->kode => $ID));
        $this->db->delete('tb_dataset', array($this->kode => $ID));
    }
}
