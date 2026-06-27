<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include("../api/koneksi.php");

// ✅ FIX: validasi id harus ada dan berupa angka
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

// ✅ FIX: gunakan pg_query_params() untuk mencegah SQL Injection
$result = pg_query_params($conn, "
    DELETE FROM wisata
    WHERE id_wisata = $1
", [$id]);

if ($result) {
    echo "
    <script>
    alert('Data berhasil dihapus');
    location='dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Gagal menghapus data.');
    location='dashboard.php';
    </script>
    ";
}
?>
