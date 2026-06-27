// ===============================
// MEMBUAT PETA
// ===============================

var map = L.map('map').setView([-8.42, 115.62], 10);

L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution: '© OpenStreetMap',
        maxZoom: 19
    }
).addTo(map);

// ===============================
// VARIABEL
// ===============================

const sidebar = document.getElementById("wisata-list");

const search = document.getElementById("search");

let semuaData = [];

let semuaMarker = [];

// ===============================
// AMBIL DATA DATABASE
// ===============================

// ✅ FIX: tambahkan error handling pada fetch
fetch("api/wisata.php")

    .then(function (res) {

        // Cek apakah HTTP response OK (status 200-299)
        if (!res.ok) {
            throw new Error("Server error: HTTP " + res.status);
        }

        return res.json();

    })

    .then(function (data) {

        // ✅ FIX: cek kalau API mengembalikan error object
        if (data && data.error) {
            throw new Error(data.error);
        }

        semuaData = data;

        tampilkanData(data);

        // ✅ FIX: update statistik setelah data berhasil dimuat
        const total = document.getElementById("totalWisata");
        if (total) {
            total.innerHTML = semuaData.length;
        }

        // ✅ FIX: fitBounds dipindah ke sini supaya data sudah tersedia
        if (semuaData.length > 0) {
            let group = semuaData.map(function (w) {
                return [parseFloat(w.latitude), parseFloat(w.longitude)];
            });
            map.fitBounds(group);
        }

    })

    .catch(function (err) {

        // ✅ FIX: tampilkan pesan error ke user, bukan diam saja
        console.error("Gagal memuat data wisata:", err);

        if (sidebar) {
            sidebar.innerHTML =
                "<p style='color:#dc2626;padding:20px;text-align:center;'>" +
                "⚠️ Gagal memuat data wisata.<br><small>" + err.message + "</small>" +
                "</p>";
        }

    });

// ===============================
// TAMPILKAN DATA
// ===============================

function tampilkanData(data) {

    sidebar.innerHTML = "";

    semuaMarker.forEach(function (marker) {
        map.removeLayer(marker);
    });

    semuaMarker = [];

    data.forEach(function (w) {

        let foto = "uploads/" + w.foto;

        let marker = L.marker([
            parseFloat(w.latitude),
            parseFloat(w.longitude)
        ]).addTo(map);

        marker.bindPopup(`
            <img src="${foto}" alt="${w.nama_wisata}" style="width:100%;max-height:150px;object-fit:cover;border-radius:8px;">
            <h3>${w.nama_wisata}</h3>
            <b>${w.kategori}</b>
            <p>${w.deskripsi}</p>
        `);

        semuaMarker.push(marker);

        let card = document.createElement("div");

        card.className = "card";

        card.innerHTML = `
            <img src="${foto}" alt="${w.nama_wisata}">
            <div class="card-body">
                <h3>${w.nama_wisata}</h3>
                <div class="kategori">${w.kategori}</div>
                <p>${w.deskripsi.substring(0, 100)}...</p>
                <a
                    href="detail.php?id=${w.id_wisata}"
                    class="btn-detail"
                    onclick="event.stopPropagation()">
                    Lihat Detail
                </a>
            </div>
        `;

        card.onclick = function () {
            map.setView([parseFloat(w.latitude), parseFloat(w.longitude)], 15);
            marker.openPopup();
        };

        sidebar.appendChild(card);

    });

}

// ===============================
// SEARCH REALTIME
// ===============================

if (search) {

    search.addEventListener("keyup", function () {

        let keyword = this.value.toLowerCase();

        let hasil = semuaData.filter(function (w) {
            return (
                w.nama_wisata.toLowerCase().includes(keyword) ||
                w.kategori.toLowerCase().includes(keyword)
            );
        });

        tampilkanData(hasil);

    });

}

// ===============================
// FILTER KATEGORI
// ===============================

const kategori = document.getElementById("kategori");

if (kategori) {

    kategori.addEventListener("change", function () {

        let value = this.value;

        if (value == "Semua") {
            tampilkanData(semuaData);
            return;
        }

        let hasil = semuaData.filter(function (w) {
            return w.kategori == value;
        });

        tampilkanData(hasil);

    });

}

// ===============================
// SELESAI
// ===============================

console.log("Bali Hidden Gems Loaded Successfully");
