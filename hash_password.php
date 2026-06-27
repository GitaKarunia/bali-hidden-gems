<?php

/**
 * ============================================================
 * SCRIPT BANTU — Jalankan SEKALI untuk hash password admin
 * ============================================================
 * 
 * CARA PAKAI:
 * 1. Upload file ini ke server (folder root project)
 * 2. Buka di browser: https://domain-kamu.up.railway.app/hash_password.php
 * 3. Salin query SQL yang muncul, jalankan di database
 * 4. HAPUS file ini setelah selesai!
 * 
 * JANGAN biarkan file ini aktif di production!
 * ============================================================
 */

// Ganti sesuai password admin yang kamu inginkan
$password_baru = "admin123";

$hash = password_hash($password_baru, PASSWORD_BCRYPT);

echo "<h2>Hash Password Admin</h2>";
echo "<p>Password asli: <b>{$password_baru}</b></p>";
echo "<p>Hash: <code>{$hash}</code></p>";
echo "<hr>";
echo "<p><b>Jalankan query SQL berikut di database kamu (Railway → PostgreSQL → Query):</b></p>";
echo "<pre style='background:#f1f5f9;padding:20px;border-radius:10px;'>";
echo "UPDATE admin SET password = '{$hash}' WHERE username = 'admin';";
echo "</pre>";
echo "<p style='color:red;font-weight:bold;'>⚠️ HAPUS file ini setelah selesai!</p>";
