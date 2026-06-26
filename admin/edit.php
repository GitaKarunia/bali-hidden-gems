<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

include("../api/koneksi.php");

$id=$_GET['id'];

if(isset($_POST['update'])){

    $nama=$_POST['nama'];
    $kategori=$_POST['kategori'];
    $deskripsi=$_POST['deskripsi'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];

    pg_query($conn,"
    UPDATE wisata SET
    nama_wisata='$nama',
    kategori='$kategori',
    deskripsi='$deskripsi',
    latitude='$latitude',
    longitude='$longitude'
    WHERE id_wisata='$id'
    ");

    echo "
    <script>
    alert('Data berhasil diperbarui');
    location='dashboard.php';
    </script>
    ";

}

$data=pg_fetch_assoc(
pg_query($conn,"
SELECT *
FROM wisata
WHERE id_wisata='$id'
")
);

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
value="<?= $data['nama_wisata']; ?>"
required>

<label>Kategori</label>

<select name="kategori">

<option <?= $data['kategori']=="Pantai"?"selected":"" ?>>Pantai</option>

<option <?= $data['kategori']=="Bukit"?"selected":"" ?>>Bukit</option>

<option <?= $data['kategori']=="Budaya"?"selected":"" ?>>Budaya</option>

<option <?= $data['kategori']=="Air Terjun"?"selected":"" ?>>Air Terjun</option>

</select>

<label>Deskripsi</label>

<textarea
name="deskripsi"
required><?= $data['deskripsi']; ?></textarea>

<label>Latitude</label>

<input
type="text"
name="latitude"
value="<?= $data['latitude']; ?>"
required>

<label>Longitude</label>

<input
type="text"
name="longitude"
value="<?= $data['longitude']; ?>"
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