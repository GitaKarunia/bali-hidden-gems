<?php

// Header JSON harus paling atas sebelum output apapun
header('Content-Type: application/json');

// ✅ FIX: path benar — koneksi.php ada di folder yang sama (api/)
require_once __DIR__ . "/koneksi.php";

// ✅ FIX: cek koneksi, kembalikan JSON jika gagal
if (!$conn) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi database gagal. Periksa environment variables."]);
    exit;
}

$query = pg_query($conn, "
    SELECT *
    FROM wisata
    ORDER BY nama_wisata
");

// ✅ FIX: cek query gagal
if (!$query) {
    http_response_code(500);
    echo json_encode(["error" => "Query gagal: " . pg_last_error($conn)]);
    exit;
}

$data = [];

while ($row = pg_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
