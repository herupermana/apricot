<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Galeri extends CI_Model
{
    public $id;
    public $hasil;
    public $photos = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function get_galeri($id)
    {
        $this->id = $id;

        if ($id > 0) {
            $query = $this->db->query("SELECT * FROM galeri WHERE galeri_id='$id'");
            if ($query->num_rows() > 0) {
                $row = $query->row();

                $this->hasil = [
                    'id'            => $row->galeri_id,
                    'nama'          => $row->galeri_nama,
                    'deskripsi'     => ($row->galeri_deskripsi),
                    'featured'      => $row->galeri_feature_img,
                    'url'           => $row->galeri_url,
                    'meta_keyword'  => $row->galeri_meta_keyword,
                    'meta_deskripsi'=> $row->galeri_meta_deskripsi,
                    'og_image'      => $row->galeri_og_image,
                    'og_deskripsi'  => $row->galeri_og_deskripsi,
                    'status'        => $row->galeri_status,
                    'kategori'      => $row->kategori_id,
                ];

                return true;
            } else {
                return false;
            }
        } else {
            $this->hasil = [
                'id'            => 0,
                'nama'          => '',
                'deskripsi'     => '',
                'featured'      => '',
                'url'           => '',
                'meta_keyword'  => '',
                'meta_deskripsi'=> '',
                'og_image'      => '',
                'og_deskripsi'  => '',
                'status'        => '',
                'kategori'      => '',
            ];

            return true;
        }
    }

    public function ambil_gambar()
    {
        if ($this->id > 0) {
            $query = $this->db->query("SELECT * FROM foto_galeri WHERE id_galeri='".$this->id."' ORDER BY id_foto DESC");
            if ($query->num_rows() > 0) {
                $this->photos = $query->result_array();
            }

            return true;
        } else {
            return false;
        }
    }

    public function ambil_kategori()
    {
        $query = $this->db->query("SELECT * FROM kategori_galeri WHERE aktif='Y' AND terhapus='N' ORDER BY id DESC");

        return $query->result_array();
    }
}
