<?php

$conn = pg_connect(
    "host=" . getenv("PGHOST") .
    " port=" . getenv("PGPORT") .
    " dbname=" . getenv("PGDATABASE") .
    " user=" . getenv("PGUSER") .
    " password=" . getenv("PGPASSWORD")
);

if (!$conn) {
    // Jangan pakai die() di sini, biarkan caller yang handle
    $conn = null;
}
