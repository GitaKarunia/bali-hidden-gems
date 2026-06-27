<?php

$conn = pg_connect(
    "host="     . getenv("PGHOST")     .
    " port="    . getenv("PGPORT")     .
    " dbname="  . getenv("PGDATABASE") .
    " user="    . getenv("PGUSER")     .
    " password=". getenv("PGPASSWORD")
);

if (!$conn) {
    // Jangan pakai die() — biarkan file pemanggil yang handle error
    // supaya response tetap bisa berupa JSON
    $conn = null;
}
