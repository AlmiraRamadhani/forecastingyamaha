<?php
class Ajax extends CI_Controller {

    public function __construct()
    {
        parent::__construct();          
    }
    
    public function testing(){
        $testing = $this->input->post('testing');
        $ID = $this->input->post('ID');
        $testing = $testing=='true' ? 1 : 0;
        $this->db->query("UPDATE tb_data SET testing='$testing' WHERE id_data='$ID'");    
        echo " $ID => $testing";            
    }            
}