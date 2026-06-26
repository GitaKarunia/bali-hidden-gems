<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Bali Hidden Gems Explorer</title>

<link
rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link
rel="stylesheet"
href="css/style.css">

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav>

<div class="logo">

🌴 Bali Hidden Gems

</div>

<ul>

<li>

<a href="#hero">

Home

</a>

</li>

<li>

<a href="#about">

Tentang

</a>

</li>

<li>

<a href="#mapSection">

Peta

</a>

</li>

<li>

<a href="#gallery">

Galeri

</a>

</li>

<li>

<a
href="admin/login.php"
class="login-btn">

Admin Login

</a>

</li>

</ul>

</nav>

<!-- ================= HERO ================= -->

<section id="hero">

<div class="overlay">

<h1>

Discover Hidden Paradise

</h1>

<p>

Eksplorasi destinasi wisata tersembunyi di Kabupaten Karangasem,
Provinsi Bali.

Temukan pantai eksotis, bukit dengan panorama indah,
air terjun alami, hingga wisata budaya yang masih jarang diketahui wisatawan.

</p>

<a
href="#mapSection"
class="hero-btn">

Mulai Jelajah

</a>

</div>

</section>

<!-- ================= ABOUT ================= -->

<section id="about">

<div class="about-img">

<img
src="assets/about.jpg"
alt="About">

</div>

<div class="about-text">

<h2>

Tentang Website

</h2>

<p>

Bali Hidden Gems Explorer merupakan website Sistem Informasi Geografis
(SIG) berbasis Web yang dikembangkan untuk mempermudah wisatawan
menemukan destinasi wisata tersembunyi di Kabupaten Karangasem.

Website memanfaatkan peta digital Leaflet dan basis data PostgreSQL
untuk menyimpan informasi lokasi wisata beserta koordinat,
kategori, deskripsi, dan dokumentasi foto.

</p>

<div class="features">

<div>

<i class="fa-solid fa-location-dot"></i>

Peta Interaktif

</div>

<div>

<i class="fa-solid fa-camera"></i>

Foto Wisata

</div>

<div>

<i class="fa-solid fa-map"></i>

Koordinat GPS

</div>

<div>

<i class="fa-solid fa-earth-asia"></i>

Informasi Lengkap

</div>

</div>

</div>

</section>

<!-- ================= STATISTIK ================= -->

<section id="stats">

<div class="stat-card">

<h2 id="totalWisata">

20

</h2>

<p>

Jumlah Wisata

</p>

</div>

<div class="stat-card">

<h2>

8

</h2>

<p>

Pantai

</p>

</div>

<div class="stat-card">

<h2>

6

</h2>

<p>

Bukit

</p>

</div>

<div class="stat-card">

<h2>

4

</h2>

<p>

Budaya

</p>

</div>

<div class="stat-card">

<h2>

2

</h2>

<p>

Air Terjun

</p>

</div>

</section>

<!-- ================= MAP ================= -->

<section id="mapSection">

<h2 class="section-title">

Jelajahi Destinasi Wisata

</h2>

<div id="container">

<div id="sidebar">

<div class="search-box">

<input
type="text"
id="search"
placeholder="Cari wisata...">

<select id="kategori">

<option>Semua</option>

<option>Pantai</option>

<option>Bukit</option>

<option>Budaya</option>

<option>Air Terjun</option>

</select>

</div>

<div id="wisata-list">

<!-- Diisi otomatis oleh map.js -->

</div>

</div>

<div id="map">

</div>

</div>

</section>

<!-- ================= GALLERY ================= -->

<section id="gallery">

<div class="section-header">

<h2>

Galeri Destinasi

</h2>

<p>

Beberapa destinasi wisata unggulan di Kabupaten Karangasem.

</p>

</div>

<div class="gallery-grid">

<img src="uploads/lahangan-sweet.jpeg" alt="">

<img src="uploads/bukit-asah.jpg" alt="">

<img src="uploads/virgin-beach.webp" alt="">

<img src="uploads/pantai-bias-putih.jpg" alt="">

<img src="uploads/pantai-amed.jpg" alt="">

<img src="uploads/pantai-jemeluk.jpg" alt="">

<img src="uploads/taman-ujung.webp" alt="">

<img src="uploads/tirta-gangga.jpg" alt="">

</div>

</section>

<!-- ================= KEUNGGULAN ================= -->

<section id="why">

<div class="why-card">

<i class="fa-solid fa-map-location-dot"></i>

<h3>

Peta Interaktif

</h3>

<p>

Menampilkan lokasi wisata secara akurat menggunakan Leaflet.

</p>

</div>

<div class="why-card">

<i class="fa-solid fa-camera-retro"></i>

<h3>

Foto Wisata

</h3>

<p>

Setiap destinasi dilengkapi dokumentasi foto.

</p>

</div>

<div class="why-card">

<i class="fa-solid fa-database"></i>

<h3>

Database PostgreSQL

</h3>

<p>

Seluruh data wisata tersimpan aman pada PostgreSQL.

</p>

</div>

<div class="why-card">

<i class="fa-solid fa-user-shield"></i>

<h3>

Admin Dashboard

</h3>

<p>

Admin dapat menambah, mengubah, serta menghapus data wisata.

</p>

</div>

</section>

<!-- ================= CTA ================= -->

<section id="cta">

<div class="cta-box">

<h2>

Siap Menjelajahi Karangasem?

</h2>

<p>

Temukan berbagai destinasi wisata tersembunyi yang belum banyak diketahui wisatawan.

</p>

<a href="#mapSection">

Mulai Sekarang

</a>

</div>

</section>

<!-- ================= FOOTER ================= -->

<footer>

<div class="footer-container">

<div>

<h2>

🌴 Bali Hidden Gems Explorer

</h2>

<p>

Website Sistem Informasi Geografis Pariwisata Kabupaten Karangasem.

</p>

</div>

<div>

<h3>

Menu

</h3>

<ul>

<li><a href="#hero">Home</a></li>

<li><a href="#about">Tentang</a></li>

<li><a href="#mapSection">Peta</a></li>

<li><a href="#gallery">Galeri</a></li>

</ul>

</div>

<div>

<h3>

Admin

</h3>

<a
href="admin/login.php"
class="footer-login">

Masuk Dashboard

</a>

</div>

</div>

<hr>

<p class="copyright">

© 2026

<b>

Dewa Ayu Gita Karunia Putri Aryani

</b>

—

Bali Hidden Gems Explorer

</p>

</footer>

<!-- ================= SCRIPT ================= -->

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="js/map.js"></script>

<script>

// ===============================
// Navbar berubah saat scroll
// ===============================

const navbar = document.querySelector("nav");

window.addEventListener("scroll",function(){

    if(window.scrollY > 80){

        navbar.style.background="#0f766e";
        navbar.style.transition=".3s";

    }

    else{

        navbar.style.background="rgba(0,0,0,.45)";

    }

});

// ===============================
// Animasi Counter Statistik
// ===============================

const counters=document.querySelectorAll(".stat-card h2");

counters.forEach(counter=>{

let target=parseInt(counter.innerText);

let value=0;

let increment=Math.ceil(target/40);

let interval=setInterval(()=>{

value+=increment;

if(value>=target){

value=target;

clearInterval(interval);

}

counter.innerText=value;

},40);

});

// ===============================
// Gallery Click
// ===============================

document.querySelectorAll(".gallery-grid img").forEach(img=>{

img.onclick=function(){

window.open(this.src);

}

});

</script>

</body>

</html>