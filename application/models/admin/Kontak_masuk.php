<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kontak_masuk extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_data()
    {
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('kontak_masuk');

        return $data->result_array();
    }
}
