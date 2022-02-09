<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Do_download extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('download');
    }

    public function d($id)
    {
        $download = $this->db->get_where('download', ['id'=>$id]);
        if ($download->num_rows() < 1) {
            echo 'FILE NOT FOUND';
            exit;
        }

        $total_download = (int) $download->row()->jumlah_download + 1;
        $this->db->where('id', $id)->update('download', ['jumlah_download'=>$total_download]);

        $download = $download->row_array();

        force_download(FCPATH.'/an-component/media/download/'.$download['file'], null);
    }
}
