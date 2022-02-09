<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Form_visitors extends AN_Apricot
{
    public function __construct()
    {
        parent::__construct();
        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            exit('DILARANG');
        }
        $this->output->enable_profiler(false);
        $this->load->helper(['url']);
    }

    public function contact()
    {
        $nama = $this->input->post('nama', true);
        $email = $this->input->post('email', true);
        $judul = $this->input->post('judul', true);
        $phone = $this->input->post('phone', true);
        $pesan = $this->input->post('pesan', true);
        $url = $this->input->post('url', true);
        $tanggal = date('Y:m:d H:i:s', now());

        if ($this->input->post('g-recaptcha-response') != false) {
            $secret = $this->recaptcha['secret_key'];
            $ip = $this->input->ip_address();
            $chaptcha = $this->input->post('g-recaptcha-response');
            $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$chaptcha&remoteip=$ip");

            $hasil = json_decode($rsp, true);
            if ($hasil['success'] == true) {
                $this->db->insert('kontak_masuk', ['nama'=>$nama, 'email'=>$email, 'judul'=>$judul, 'phone'=>$phone, 'pesan'=>$pesan, 'tanggal'=>$tanggal, 'ip'=>$ip]);

                if ($this->input->is_ajax_request()) {
                    echo json_encode(['status'=>'sukses']);
                } else {
                    redirect($url);
                }
            } else {
                if ($this->input->is_ajax_request()) {
                    echo json_encode(['status'=>'error', 'name'=>'chaptcha tidak benar']);
                } else {
                    redirect($url);
                }
            }
        } else {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status'=>'error', 'name'=>'chaptcha belum terisi']);
            } else {
                redirect($url);
            }
        }
    }

    public function search_article()
    {
        $keyword = $this->input->post('keyword', true);
        $clean = trim(preg_replace("/[^A-Za-z0-9-_\s]/", '', $keyword));
        $ip = $this->input->ip_address();

        $tanggal = date('Y:m:d H:i:s', now());

        if (strlen($clean) >= 3) {
            $this->db->insert('pencarian_artikel', ['keyword'=>$keyword, 'clean_keyword'=>$clean, 'tanggal'=>$tanggal, 'ip'=>$ip]);
            redirect(baseURL('search/article/'.$clean));
        } else {
            echo 'NEED ATLEAST 3 CHARACTERS
				<script>

				window.setTimeout(function(){
					window.history.back(-1);
				},3000)

				</script>
			';
        }
    }
}
