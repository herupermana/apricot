<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Banner_depan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_banner()
    {
        $query = $this->db->query('SELECT * FROM banner_depan ORDER BY id DESC');

        return $query->result_array();
    }
}
