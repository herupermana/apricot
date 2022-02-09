<?php

if (file_exists('../starting') and isset($_POST['akses'])) {
    unlink('../starting');
    unlink('proses.php');
    unlink('index.php');
    unlink('../index.php');
    unlink('cek_database.php');
    unlink('db.sql');
    rename('../index', '../index.php');

    echo '{}';
}
