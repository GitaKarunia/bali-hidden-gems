<?php

require_once __DIR__ . "/../koneksi.php";

$query = pg_query($conn, "
SELECT *
FROM wisata
ORDER BY nama_wisata
");

$data = [];

while($row = pg_fetch_assoc($query)){
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

?>
