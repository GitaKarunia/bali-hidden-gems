<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include("../api/koneksi.php");

if (isset($_POST['simpan'])) {

    $nama      = trim($_POST['nama']);
    $kategori  = trim($_POST['kategori']);
    $deskripsi = trim($_POST['deskripsi']);
    $latitude  = trim($_POST['latitude']);
    $longitude = trim($_POST['longitude']);

    // ✅ FIX: validasi latitude & longitude harus berupa angka
    if (!is_numeric($latitude) || !is_numeric($longitude)) {
        echo "
        <script>
        alert('Latitude dan Longitude harus berupa angka.');
        history.back();
        </script>
        ";
        exit;
    }

    // Upload Foto
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {

        $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            echo "
            <script>
            alert('Format foto tidak didukung. Gunakan JPG, PNG, atau WEBP.');
            history.back();
            </script>
            ";
            exit;
        }

        // Nama file aman: pakai nama unik supaya tidak bentrok
        $foto = uniqid('wisata_', true) . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);

    }

    // ✅ FIX: gunakan pg_query_params() untuk mencegah SQL Injection
    $result = pg_query_params($conn, "
        INSERT INTO wisata
        (nama_wisata, kategori, deskripsi, latitude, longitude, foto)
        VALUES ($1, $2, $3, $4, $5, $6)
    ", [$nama, $kategori, $deskripsi, $latitude, $longitude, $foto]);

    if ($result) {
        echo "
        <script>
        alert('Data berhasil ditambahkan');
        location='dashboard.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Gagal menyimpan data: " . pg_last_error($conn) . "');
        history.back();
        </script>
        ";
    }

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Tambah Wisata</title>

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

input,
textarea,
select{

    width:100%;
    padding:12px;
    margin-bottom:20px;
    border:1px solid #ccc;
    border-radius:10px;
    font-size:15px;

}

textarea{

    height:120px;
    resize:none;

}

button{

    padding:12px 25px;
    border:none;
    border-radius:10px;
    background:#0f766e;
    color:white;
    cursor:pointer;
    font-size:16px;

}

button:hover{

    background:#115e59;

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

<h1 class="title">Tambah Wisata</h1>

<div class="form-box">

<form method="POST" enctype="multipart/form-data">

<label>Nama Wisata</label>

<input
type="text"
name="nama"
required>

<label>Kategori</label>

<select name="kategori">

<option>Pantai</option>

<option>Bukit</option>

<option>Budaya</option>

<option>Air Terjun</option>

</select>

<label>Deskripsi</label>

<textarea
name="deskripsi"
required></textarea>

<label>Latitude</label>

<input
type="text"
name="latitude"
placeholder="-8.4234"
required>

<label>Longitude</label>

<input
type="text"
name="longitude"
placeholder="115.6234"
required>

<label>Foto Wisata</label>

<input
type="file"
name="foto"
accept=".jpg,.jpeg,.png,.webp"
required>

<button
type="submit"
name="simpan">

Simpan Wisata

</button>

</form>

</div>

</div>

</body>

</html>
