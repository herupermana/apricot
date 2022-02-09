<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Otorisasi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isOwner($id)
    {
        $query = $this->db->query("SELECT artikel_id_user,artikel_editable FROM artikel WHERE artikel_id='$id'");
        $row = $query->row();

        return @$row->artikel_id_user == $this->session->userdata('id_user') or $this->session->userdata('level_user') == 1 or $row->artikel_editable == 'Y';
    }
}
