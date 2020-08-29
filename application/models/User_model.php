<?php
class User_model extends CI_Model
{
    protected $table = 'tb_user';
    protected $kode = 'id_user';

    public function tampil($search = '')
    {
        return $this->db->query("SELECT * FROM tb_user WHERE user LIKE '%" . $search . "%' ORDER BY id_user")->result();
    }

    public function get_user($ID = null)
    {
        $query = $this->db->get_where($this->table, array($this->kode => $ID));
        return $query->row();
    }

    public function tambah($fields)
    {
        $this->db->insert($this->table, $fields);
    }

    public function ubah($fields, $ID)
    {
        $this->db->update($this->table, $fields, array($this->kode => $ID));
    }

    public function hapus($ID)
    {
        $this->db->delete($this->table, array($this->kode => $ID));
    }
    public function login($user, $pass)
    {
        $query = $this->db->get_where('tb_user', array('user' => $user, 'pass' => $pass));
        return $row = $query->row();
    }

    public function cek_pass($level, $user, $pass)
    {
        return $this->db->get_where('tb_user', array('user' => $user, 'pass' => $pass))->result();
    }

    public function update($data, $user)
    {
        $this->db->update('tb_user', $data, array('user' => $user));
    }
     public function getUserByUsername($username)
    {
        return $this->db->get_where('tb_user', ['user' => $username])->row_array();
    }

    public function getUserByIbu($nama_ibu)
    {
       
        // return $this->db->get_where('tb_user', ['nama_ibu' => $nama_ibu])->row_array();
        $query = $this->db->get_where('tb_user', array('user' => $user, 'nama_ibu' => $nama_ibu));
        return $row = $query->row();
    }

    public function resetPassword($password, $username)
    {
        $this->db->set('pass', $password);
        $this->db->where('user', $username);
        $this->db->update('tb_user');
    } 
}
