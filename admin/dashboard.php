<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include("../api/koneksi.php");

// ==========================
// Statistik
// ==========================

$total  = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) FROM wisata"));
$pantai = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) FROM wisata WHERE kategori='Pantai'"));
$bukit  = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) FROM wisata WHERE kategori='Bukit'"));
$budaya = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) FROM wisata WHERE kategori='Budaya'"));
$air    = pg_fetch_assoc(pg_query($conn, "SELECT COUNT(*) FROM wisata WHERE kategori='Air Terjun'"));

// ==========================
// Data Wisata
// ==========================

$data = pg_query($conn, "SELECT * FROM wisata ORDER BY id_wisata ASC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Bali Hidden Gems Explorer</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <h2>🌴 Bali Hidden Gems</h2>
            <p>Admin Panel</p>
        </div>

        <a href="dashboard.php" class="active">
            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="tambah.php">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Wisata</span>
        </a>

        <a href="../index.php" target="_blank">
            <i class="fa-solid fa-map-location-dot"></i>
            <span>Lihat Website</span>
        </a>

        <a href="logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>

    </div>

    <!-- CONTENT -->
    <div class="main">

        <!-- Header -->
        <div class="header-dashboard">
            <div>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang di sistem pengelolaan Bali Hidden Gems Explorer.</p>
            </div>
        </div>

        <!-- Hero -->
        <div class="hero">
            <div>
                <h2>Kelola Destinasi Wisata Bali</h2>
                <p>Tambah, edit, hapus, serta pantau seluruh data wisata dalam satu dashboard modern.</p>
                <a href="tambah.php" class="hero-btn">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Wisata Baru
                </a>
            </div>
            <i class="fa-solid fa-earth-asia hero-icon"></i>
        </div>

        <!-- Card Statistik (tanpa rating rata-rata) -->
        <div class="cards">

            <div class="card total">
                <div>
                    <h4>Total Wisata</h4>
                    <h2><?= $total['count']; ?></h2>
                </div>
                <i class="fa-solid fa-map-location-dot"></i>
            </div>

            <div class="card pantai">
                <div>
                    <h4>Pantai</h4>
                    <h2><?= $pantai['count']; ?></h2>
                </div>
                <i class="fa-solid fa-water"></i>
            </div>

            <div class="card bukit">
                <div>
                    <h4>Bukit</h4>
                    <h2><?= $bukit['count']; ?></h2>
                </div>
                <i class="fa-solid fa-mountain"></i>
            </div>

            <div class="card budaya">
                <div>
                    <h4>Budaya</h4>
                    <h2><?= $budaya['count']; ?></h2>
                </div>
                <i class="fa-solid fa-landmark"></i>
            </div>

            <div class="card air">
                <div>
                    <h4>Air Terjun</h4>
                    <h2><?= $air['count']; ?></h2>
                </div>
                <i class="fa-solid fa-droplet"></i>
            </div>

        </div>

        <!-- Search & Toolbar -->
        <div class="toolbar">
            <input type="text" id="searchInput" placeholder="Cari nama wisata...">
            <a href="tambah.php" class="btn tambah">
                <i class="fa-solid fa-plus"></i>
                Tambah Wisata
            </a>
        </div>

        <!-- Tabel -->
        <div class="table-box">
            <table id="wisataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Wisata</th>
                        <th>Kategori</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = pg_fetch_assoc($data)) {
                        switch ($row['kategori']) {
                            case 'Pantai':     $badge = 'pantai'; break;
                            case 'Bukit':      $badge = 'bukit';  break;
                            case 'Budaya':     $badge = 'budaya'; break;
                            case 'Air Terjun': $badge = 'air';    break;
                            default:           $badge = 'default';
                        }
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>

                        <td>
                            <div class="nama-wisata">
                                <strong><?= htmlspecialchars($row['nama_wisata']); ?></strong>
                                <small><?= htmlspecialchars($row['alamat']); ?></small>
                            </div>
                        </td>

                        <td>
                            <span class="badge <?= $badge; ?>">
                                <?= htmlspecialchars($row['kategori']); ?>
                            </span>
                        </td>

                        <td>
                            <span class="stars">⭐⭐⭐⭐</span>
                        </td>

                        <td>
                            <div class="aksi">
                                <a href="edit.php?id=<?= $row['id_wisata']; ?>" class="btn edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <a
                                    href="hapus.php?id=<?= $row['id_wisata']; ?>"
                                    class="btn hapus"
                                    onclick="return confirm('Yakin ingin menghapus wisata ini?')"
                                >
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer-dashboard">
            <div>
                <h3>Bali Hidden Gems Explorer</h3>
                <p>Dashboard Administrator untuk mengelola seluruh data destinasi wisata.</p>
            </div>
            <div class="footer-info">
                <div>
                    <h4><?= $total['count']; ?></h4>
                    <span>Total Destinasi</span>
                </div>
            </div>
        </div>

    </div><!-- /.main -->

    <script src="../js/dashboard.js"></script>

</body>
</html>