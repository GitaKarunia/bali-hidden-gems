<?php

include("api/koneksi.php");

$id=$_GET['id'];

$data=pg_query($conn,"
SELECT *
FROM wisata
WHERE id_wisata='$id'
");

$w=pg_fetch_assoc($data);

?>
<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?= $w['nama_wisata']; ?></title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<style>

body{

background:#f8fafc;

font-family:'Poppins',sans-serif;

}

.detail{

max-width:1100px;

margin:50px auto;

background:white;

border-radius:20px;

overflow:hidden;

box-shadow:0 15px 40px rgba(0,0,0,.1);

}

.detail img{

width:100%;

height:500px;

object-fit:cover;

}

.content{

padding:40px;

}

.kategori{

display:inline-block;

background:#0f766e;

color:white;

padding:8px 18px;

border-radius:30px;

margin-bottom:20px;

font-weight:600;

}

h1{

margin-bottom:20px;

}

.info{

display:grid;

grid-template-columns:repeat(2,1fr);

gap:20px;

margin-top:30px;

}

.box{

background:#f1f5f9;

padding:20px;

border-radius:15px;

}

.btn{

display:inline-block;

margin-top:35px;

padding:14px 25px;

border-radius:30px;

background:#0f766e;

color:white;

text-decoration:none;

margin-right:15px;

}

.btn:hover{

background:#14b8a6;

}

</style>

</head>

<body>

<div class="detail">

<img src="uploads/<?= $w['foto']; ?>">

<div class="content">

<span class="kategori">

<?= $w['kategori']; ?>

</span>

<h1>

<?= $w['nama_wisata']; ?>

</h1>

<p>

<?= nl2br($w['deskripsi']); ?>

</p>

<div class="info">

<div class="box">

<h3>Latitude</h3>

<p>

<?= $w['latitude']; ?>

</p>

</div>

<div class="box">

<h3>Longitude</h3>

<p>

<?= $w['longitude']; ?>

</p>

</div>

</div>

<a

class="btn"

href="https://www.google.com/maps?q=<?= $w['latitude']; ?>,<?= $w['longitude']; ?>"

target="_blank">

🗺 Buka Google Maps

</a>

<a

class="btn"

href="index.php">

⬅ Kembali

</a>

</div>

</div>

</body>

</html>

