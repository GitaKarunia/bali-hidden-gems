<?php

session_start();

include("../api/koneksi.php");

// ✅ FIX: validasi input ada
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

// ✅ FIX: gunakan pg_query_params() untuk mencegah SQL Injection
// Ambil data berdasarkan username saja, password dicek pakai password_verify()
$query = pg_query_params($conn, "
    SELECT *
    FROM admin
    WHERE username = $1
", [$username]);

if ($query && pg_num_rows($query) > 0) {

    $row = pg_fetch_assoc($query);

    // ✅ FIX: cek password dengan password_verify()
    // Pastikan password di database sudah di-hash dengan password_hash()
    // Kalau password di DB masih plain text, ganti kondisi ini sementara:
    //   if ($row['password'] === $password) {
    if (password_verify($password, $row['password'])) {

        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];

        header("Location: dashboard.php");
        exit;

    }

}

// Login gagal
echo "
<script>
alert('Username atau Password salah');
location='login.php';
</script>
";
