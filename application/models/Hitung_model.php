<?php
class Stok_model extends CI_Model {
    
    protected $table = 'tb_stok';
    protected $kode = 'id_stok';
    
    public function tampil($tanggal_awal, $tanggal_akhir, $search='')
    {                              
        $query = $this->db->query( "SELECT *             
            FROM tb_stok s INNER JOIN tb_barang b ON b.kode_barang=s.kode_barang
            WHERE nama_barang LIKE '%$search%' AND tanggal>='$tanggal_awal' AND tanggal<='$tanggal_akhir'" );
        return $query->result();
    }
    
    public function tambah($fields)
    {
        $this->db->insert($this->table, $fields);          
        refresh_stok($fields['kode_barang']);       
    }
    
    public function hapus( $ID , $kode_barang)
    {
        $this->db->delete($this->table, array($this->kode=> $ID));        
        refresh_stok($kode_barang);            
    }   
       
     
}