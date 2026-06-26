const searchInput = document.getElementById("searchInput");

if (searchInput) {
    searchInput.addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase();
        const rows    = document.querySelectorAll("#wisataTable tbody tr");

        rows.forEach(function (row) {
            // kolom index 1 = Nama Wisata (setelah No)
            const nama = row.cells[1].innerText.toLowerCase();
            row.style.display = nama.includes(keyword) ? "" : "none";
        });
    });
}