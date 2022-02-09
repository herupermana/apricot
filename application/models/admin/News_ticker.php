<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_ticker extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_news()
    {
        $query = $this->db->query('SELECT * FROM news_ticker ORDER BY id DESC');

        return $query->result_array();
    }
}
