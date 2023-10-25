<?php
class Admin_model extends CI_Model
{
    public function show_kejahatan(){
        return $this->db->select('*, sum(jumlah_kejahatan) as total ')
                        ->from('tb_data_kejahatan')
                        ->join('tb_kejahatan', 'tb_data_kejahatan.id_kejahatan = tb_kejahatan.id_kejahatan', 'left')
                        ->join('tb_kabupaten', 'tb_data_kejahatan.id_kabupaten = tb_kabupaten.id_kabupaten', 'left')
                        ->group_by('kejahatan')
                        ->get()->result_array();
    }

    public function sum_kejahatan(){
        $this->db->select('*, sum(jumlah_kejahatan) as total');
        $this->db->from('tb_data_kejahatan');
        $this->db->group_by('id_kejahatan');
        return $this->db->get()->result_array();
    }
}