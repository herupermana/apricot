<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembilang
{
    public $terbilang = '';
    public $jml;
    public $angka;
    public $bilangan = [0=>['', ''], 1=>['se', 'satu '], 2=>['dua ', 'dua '], 3=>['tiga ', 'tiga '], 4=>['empat ', 'empat '], 5=>['lima ', 'lima '], 6=>['enam ', 'enam '], 7=>['tujuh ', 'tujuh '], 8=>['delapan ', 'delapan '], 9=>['sembilan ', 'sembilan ']];

    public $set = [];

    public function _set($angka)
    {
        $this->angka = $angka;

        $this->jml = strlen($angka);

        if ($this->jml > 0 and $angka > 0) {
            if ($this->jml >= ($min = 16) and $this->jml <= ($max = 18)) {
                //biliun
                $h = $this->ratus($this->angka, $this->jml, $min, $max);
                if ($h[1] == true) {
                    $this->terbilang .= 'biliun ';
                }
                $this->_set($h[0]);
            } elseif ($this->jml >= ($min = 13) and $this->jml <= ($max = 15)) {
                //trilun
                $h = $this->ratus($this->angka, $this->jml, $min, $max);
                if ($h[1] == true) {
                    $this->terbilang .= 'triliun ';
                }
                $this->_set($h[0]);
            } elseif ($this->jml >= ($min = 10) and $this->jml <= ($max = 12)) {
                //miliar
                $h = $this->ratus($this->angka, $this->jml, $min, $max);
                if ($h[1] == true) {
                    $this->terbilang .= 'miliar ';
                }
                $this->_set($h[0]);
            } elseif ($this->jml >= ($min = 7) and $this->jml <= ($max = 9)) {
                //juta
                $h = $this->ratus($this->angka, $this->jml, $min, $max);
                if ($h[1] == true) {
                    $this->terbilang .= 'juta ';
                }
                $this->_set($h[0]);
            } elseif ($this->jml >= ($min = 4) and $this->jml <= ($max = 6)) {

            //ribu
                $h = $this->ratus($this->angka, $this->jml, $min, $max, true);
                if ($h[1] == true) {
                    $this->terbilang .= 'ribu ';
                }
                $this->_set($h[0]);
            } elseif ($this->jml >= ($min = 1) and $this->jml <= ($max = 3)) {
                //ratus
                $h = $this->ratus($this->angka, $this->jml, 1, 3);
                $this->_set($h[0]);

                //echo "lol";
            }
        }
    }

    private function ratus($nilai, $jml, $min, $max, $an = false)
    {
        $min -= 1;
        $j = (strlen($nilai) >= 1 and strlen($nilai) <= 3) ? strlen($vall = substr($nilai, 0)) : strlen($vall = substr($nilai, 0, -$min));
        $jml = count($arr = str_split($vall));

        $In = ($an == true || $jml > 1) ? 0 : 1;

        foreach ($arr as $key => $val) {
            $l = false;

            if ($jml - $key == 3) {
                if ($val == 0) {
                    continue;
                } else {
                    $l = true;
                    $this->terbilang .= $this->bilangan[$val][$In];
                    $this->terbilang .= 'ratus ';
                }
            } elseif ($jml - $key == 2) {
                if ($val == 0) {
                    continue;
                } else {
                    $l = true;
                    $this->terbilang .= $this->bilangan[$val][$In];
                    $this->terbilang .= 'puluh ';
                }
            } elseif ($jml - $key < 2) {
                if ($val == 0) {
                    continue;
                } else {
                    $l = true;
                    $this->terbilang .= $this->bilangan[$val][$In];
                }
            }
        }

        return [(substr($nilai, $jml)), $l];
    }
}
