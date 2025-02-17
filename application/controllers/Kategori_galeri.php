<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_galeri extends AN_Apricot
{
    public function __construct()
    {
        parent::__construct();
    }

    public function detail($id = 0, $page = 0)
    {
        if ($id > 0 and ($kategori = $this->kategori->detail_kategori_galeri($id)) != false) {
            $this->load->library('pagination');

            $config['full_tag_open'] = "<nav> <ul class='pagination pagination-sm'>";
            $config['full_tag_close'] = '</ul> </nav>';

            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $config['cur_tag_open'] = "<li class='active'><a href='#'>";
            $config['cur_tag_close'] = '</a></li>';

            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['base_url'] = baseURL($this->uri->segment(1).'/'.$this->uri->segment(2));

            $config['uri_segment'] = 3;

            $config['total_rows'] = $this->galeri->hitung_galeri_per_kategori($id);
            $config['per_page'] = $this->system_info['max_tampil_galeri'];
            $this->pagination->initialize($config);

            $data = $this->public_data;
            $data['informasi']['title'] = 'Kategori galeri:'.$this->title->kategori($kategori['nama']);
            $data['informasi']['current_page'] = 'galeri-per-kategori';
            $data['informasi']['uniqueid'] = 'galeri-per-kategori';

            $data['informasi']['og-url'] = current_url();
            $data['informasi']['og-title'] = $data['informasi']['title'];

            $data['heading'] = 'Kategori :'.$kategori['nama'];
            $data['semua_galeri'] = $this->galeri->galeri_per_kategori($id, $config['per_page'], $page);
            $data['pagination'] = $this->pagination->create_links();

            $this->load->view($this->tema.'/header', $data);
            $this->load->view($this->tema.'/galeri_per_kategori', $data);
            $this->load->view($this->tema.'/footer', $data);
        } else {
            show_404();
        }
    }
}
