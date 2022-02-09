<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_tema extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_tema()
    {
        $this->db->order_by('id', 'DESC');
        $tema = $this->db->get('tema');

        return $tema->result_array();
    }
}
