<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

include("../api/koneksi.php");

$id=$_GET['id'];

pg_query($conn,"
DELETE FROM wisata
WHERE id_wisata='$id'
");

echo "
<script>
alert('Data berhasil dihapus');
location='dashboard.php';
</script>
";
?>