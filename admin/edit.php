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

if (isset($_POST['update'])) {

    $nama      = trim($_POST['nama']);
    $kategori  = trim($_POST['kategori']);
    $deskripsi = trim($_POST['deskripsi']);
    $latitude  = trim($_POST['latitude']);
    $longitude = trim($_POST['longitude']);

    // ✅ FIX: validasi latitude & longitude harus angka
    if (!is_numeric($latitude) || !is_numeric($longitude)) {
        echo "
        <script>
        alert('Latitude dan Longitude harus berupa angka.');
        history.back();
        </script>
        ";
        exit;
    }

    // ✅ FIX: gunakan pg_query_params() untuk mencegah SQL Injection
    $result = pg_query_params($conn, "
        UPDATE wisata SET
        nama_wisata = $1,
        kategori    = $2,
        deskripsi   = $3,
        latitude    = $4,
        longitude   = $5
        WHERE id_wisata = $6
    ", [$nama, $kategori, $deskripsi, $latitude, $longitude, $id]);

    if ($result) {
        echo "
        <script>
        alert('Data berhasil diperbarui');
        location='dashboard.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Gagal memperbarui data.');
        history.back();
        </script>
        ";
    }

}

// ✅ FIX: gunakan pg_query_params() untuk mencegah SQL Injection
$result = pg_query_params($conn, "
    SELECT *
    FROM wisata
    WHERE id_wisata = $1
", [$id]);

if (!$result || pg_num_rows($result) === 0) {
    header("Location: dashboard.php");
    exit;
}

$data = pg_fetch_assoc($result);

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Edit Wisata</title>

<link rel="stylesheet" href="../css/admin.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

.form-box{

background:white;

padding:30px;

border-radius:15px;

box-shadow:0 5px 20px rgba(0,0,0,.08);

max-width:700px;

}

input,textarea,select{

width:100%;

padding:12px;

margin-bottom:20px;

border-radius:10px;

border:1px solid #ccc;

font-size:15px;

}

textarea{

height:120px;

resize:none;

}

button{

padding:12px 25px;

background:#2563eb;

border:none;

color:white;

border-radius:10px;

cursor:pointer;

font-size:16px;

}

button:hover{

background:#1d4ed8;

}

</style>

</head>

<body>

<div class="sidebar">

<h2>🌴 Bali Hidden Gems</h2>

<a href="dashboard.php">Dashboard</a>

<a href="tambah.php">Tambah Wisata</a>

<a href="../index.php">Lihat Website</a>

<a href="logout.php">Logout</a>

</div>

<div class="main">

<h1 class="title">Edit Wisata</h1>

<div class="form-box">

<form method="POST">

<label>Nama Wisata</label>

<input
type="text"
name="nama"
value="<?= htmlspecialchars($data['nama_wisata']); ?>"
required>

<label>Kategori</label>

<select name="kategori">

<option <?= $data['kategori'] == "Pantai"     ? "selected" : "" ?>>Pantai</option>

<option <?= $data['kategori'] == "Bukit"      ? "selected" : "" ?>>Bukit</option>

<option <?= $data['kategori'] == "Budaya"     ? "selected" : "" ?>>Budaya</option>

<option <?= $data['kategori'] == "Air Terjun" ? "selected" : "" ?>>Air Terjun</option>

</select>

<label>Deskripsi</label>

<textarea
name="deskripsi"
required><?= htmlspecialchars($data['deskripsi']); ?></textarea>

<label>Latitude</label>

<input
type="text"
name="latitude"
value="<?= htmlspecialchars($data['latitude']); ?>"
required>

<label>Longitude</label>

<input
type="text"
name="longitude"
value="<?= htmlspecialchars($data['longitude']); ?>"
required>

<button
type="submit"
name="update">

Update Data

</button>

</form>

</div>

</div>

</body>

</html>
