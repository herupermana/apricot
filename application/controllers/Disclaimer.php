<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Disclaimer extends AN_Apricot
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = $this->public_data;

        $data['informasi']['title'] = $this->title->disclaimer('Disclaimer');
        $data['informasi']['current_page'] = 'disclaimer';
        $data['informasi']['uniqueid'] = 'disclaimer';

        $data['informasi']['og-url'] = current_url();
        $data['informasi']['og-title'] = $data['informasi']['title'];

        $this->load->view($this->tema.'/header', $data);
        $this->load->view($this->tema.'/disclaimer', $data);
        $this->load->view($this->tema.'/footer', $data);
    }
}
