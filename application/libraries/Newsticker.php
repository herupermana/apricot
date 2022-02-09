<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Newsticker
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function get_news()
    {
        $cache_news_ticker = $this->CI->cache->file->get('news_ticker');
        if ($cache_news_ticker === false) {
            $data = $this->CI->db->query('SELECT id, berita, link, tanggal_posting AS tanggal FROM news_ticker ORDER BY id DESC');
            $data = $data->result_array();
            $this->CI->cache->file->save('news_ticker', $data, 6000000);

            return $data;
        } else {
            return $cache_news_ticker;
        }
    }
}
