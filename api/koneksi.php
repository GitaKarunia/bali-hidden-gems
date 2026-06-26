<?php

$conn = pg_connect(
"host=localhost port=5432 dbname=bali_hidden_gems user=postgres password=gisti"
);

if (!$conn) {
    die("Koneksi gagal");
}

?>