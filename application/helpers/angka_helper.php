<?php

defined('BASEPATH') or exit('No direct script access allowed');

function terbilang($angka)
{
    $bilangan = [1=>[0=>'satu', 1=>'se'], 2=>'dua', 3=>'tiga', 4=>'empat', 5=>'lima', 6=>'enam', 7=>'tujuh', 8=>'delapan', 9=>'sembilan'];

    $satuan = [0=>'', 1=>'puluh', 2=>'ratus', 3=>'ribu', 4=>'juta', 5=>'miliar'];

    $set = str_split($angka);

    $jml = strlen($angka);

    $terbilang = '';

    $hitung = 0;

    foreach ($set as  $value) {
        if ($jml >= 16 and $jml <= ($max = 18)) {
            return $jml;
        } elseif ($jml >= 13 and $jml <= ($max = 15)) {
            //trilun
        } elseif ($jml >= 10 and $jml <= ($max = 12)) {
            //miliar
        } elseif ($jml >= 7 and $jml <= ($max = 9)) {
            //juta
        } elseif ($jml >= 4 and $jml <= ($max = 6)) {
            //ribu
        } else {
            //ratus
        }
    }
}
