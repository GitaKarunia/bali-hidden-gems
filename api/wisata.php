<?php
header('Content-Type: application/json');

require_once __DIR__ . "/koneksi.php"; // ← PAKAI PATH YANG BARU NANTI DI CEK YAA GIT -Yudha

if (!$conn) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi database gagal"]);
    exit;
}

$query = pg_query($conn, "SELECT * FROM wisata ORDER BY nama_wisata");

if (!$query) {
    http_response_code(500);
    echo json_encode(["error" => pg_last_error($conn)]);
    exit;
}

$data = [];
while ($row = pg_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
