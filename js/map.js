// ===============================
// MEMBUAT PETA
// ===============================

var map = L.map('map').setView([-8.42,115.62],10);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution:'© OpenStreetMap',
    maxZoom:19
}
).addTo(map);

// ===============================
// VARIABEL
// ===============================

const sidebar=document.getElementById("wisata-list");

const search=document.getElementById("search");

let semuaData=[];

let semuaMarker=[];

// ===============================
// AMBIL DATA DATABASE
// ===============================

fetch("api/wisata.php")
  .then(res => {
    if (!res.ok) throw new Error("HTTP " + res.status);
    return res.json();
  })
  .then(data => {
    semuaData = data;
    tampilkanData(data);
  })
  .catch(err => {
    console.error("Gagal memuat data wisata:", err);
    sidebar.innerHTML = "<p>Gagal memuat data. Cek koneksi database.</p>";
  });

// ===============================
// TAMPILKAN DATA
// ===============================

function tampilkanData(data){

sidebar.innerHTML="";

semuaMarker.forEach(marker=>{

map.removeLayer(marker);

});

semuaMarker=[];

data.forEach(w=>{

let foto="uploads/"+w.foto;

let marker=L.marker([
w.latitude,
w.longitude
]).addTo(map);

marker.bindPopup(`

<img src="${foto}">

<h3>${w.nama_wisata}</h3>

<b>${w.kategori}</b>

<p>

${w.deskripsi}

</p>

`);

semuaMarker.push(marker);

let card=document.createElement("div");

card.className="card";

card.innerHTML=`

<img src="${foto}">

<div class="card-body">

<h3>

${w.nama_wisata}

</h3>

<div class="kategori">

${w.kategori}

</div>

<p>

${w.deskripsi.substring(0,100)}...

</p>

<a
href="detail.php?id=${w.id_wisata}"
class="btn-detail"
onclick="event.stopPropagation()">

Lihat Detail

</a>

</div>

`;

card.onclick=function(){

map.setView(
[
w.latitude,
w.longitude
],
15
);

marker.openPopup();

};

sidebar.appendChild(card);

});

}

// ===============================
// SEARCH REALTIME
// ===============================

if(search){

search.addEventListener("keyup",function(){

let keyword=this.value.toLowerCase();

let hasil=semuaData.filter(function(w){

return(

w.nama_wisata.toLowerCase().includes(keyword) ||

w.kategori.toLowerCase().includes(keyword)

);

});

tampilkanData(hasil);

});

}

// ===============================
// HITUNG STATISTIK OTOMATIS
// ===============================

const total=document.getElementById("totalWisata");

if(total){

total.innerHTML=semuaData.length;

}

// ===============================
// FIT BOUNDS
// ===============================

if(semuaData.length>0){

let group=[];

semuaData.forEach(function(w){

group.push([

parseFloat(w.latitude),

parseFloat(w.longitude)

]);

});

map.fitBounds(group);

}

// ===============================
// FILTER KATEGORI
// ===============================

const kategori=document.getElementById("kategori");

if(kategori){

kategori.addEventListener("change",function(){

let value=this.value;

if(value=="Semua"){

tampilkanData(semuaData);

return;

}

let hasil=semuaData.filter(function(w){

return w.kategori==value;

});

tampilkanData(hasil);

});

}

// ===============================
// ICON BERBEDA SETIAP KATEGORI
// ===============================

// Jika nanti ingin memakai icon custom,
// tinggal ganti marker menjadi icon Leaflet.

// ===============================
// SELESAI
// ===============================

console.log("Bali Hidden Gems Loaded Successfully");
