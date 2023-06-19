let btnAdd = document.querySelector("#btn-add-jumlah-barang");
let btnMin = document.querySelector("#btn-less-jumlah-barang");
let inputJumlahBarang = document.querySelector("#jumlah-barang");
let inputResultJumlahBarang = document.querySelector("#result-jumlah-barang");
let drafPesanan = [];
let tabelDrafPesanan = document.querySelector("#tabel-draf-pesanan");
let dataPesanan = [];

btnAdd.addEventListener("click", () => {
    inputJumlahBarang.value = parseInt(inputJumlahBarang.value) + 1;
    inputResultJumlahBarang.value = inputJumlahBarang.value;
});

btnMin.addEventListener("click", () => {
    if (inputJumlahBarang.value > 0) {
        inputJumlahBarang.value = parseInt(inputJumlahBarang.value) - 1;
        inputResultJumlahBarang.value = inputJumlahBarang.value;
    }
});

function minStock(id) {
    let inputJumlahBarang = document.querySelector(`#stock-barang${id}`);
    let inputResultJumlahBarang = document.querySelector(
        `#result-stock-barang${id}`
    );
    if (inputJumlahBarang.value > 0) {
        inputJumlahBarang.value = parseInt(inputJumlahBarang.value) - 1;
        inputResultJumlahBarang.value = inputJumlahBarang.value;
    }
}

function addStock(id) {
    let inputJumlahBarang = document.querySelector(`#stock-barang${id}`);
    let inputResultJumlahBarang = document.querySelector(
        `#result-stock-barang${id}`
    );
    inputJumlahBarang.value = parseInt(inputJumlahBarang.value) + 1;
    inputResultJumlahBarang.value = inputJumlahBarang.value;
}

function deleteStock(id) {
    let inputJumlahBarang = document.querySelector(`#stock-barang${id}`);
    let inputResultJumlahBarang = document.querySelector(
        `#result-stock-barang${id}`
    );
    inputJumlahBarang.value = 0;
    inputResultJumlahBarang.value = inputJumlahBarang.value;
}

function minQty(id) {
    let inputJumlahBarang = document.querySelector(`#qty-barang${id}`);
    let inputResultJumlahBarang = document.querySelector(
        `#result-qty-barang${id}`
    );
    if (inputJumlahBarang.value > 0) {
        inputJumlahBarang.value = parseInt(inputJumlahBarang.value) - 1;
        inputResultJumlahBarang.value = inputJumlahBarang.value;
    }
}

function addQty(id) {
    let inputStockBarang = document.querySelector(`#stock${id}`);
    let inputJumlahBarang = document.querySelector(`#qty-barang${id}`);
    let inputResultJumlahBarang = document.querySelector(
        `#result-qty-barang${id}`
    );
    if (parseInt(inputStockBarang.value) > parseInt(inputJumlahBarang.value)) {
        inputJumlahBarang.value = parseInt(inputJumlahBarang.value) + 1;
        inputResultJumlahBarang.value = inputJumlahBarang.value;
    }
}

function addToChart(id) {
    let inputStockBarang = document.querySelector(`#stock${id}`);
    let btnAddQty = document.querySelector(`#add-qty${id}`);
    let btnMinQty = document.querySelector(`#min-qty${id}`);
    let btnChart = document.querySelector(`#chart${id}`);
    let inputJumlahBarang = document.querySelector(`#qty-barang${id}`);
    let namaBarang = document.querySelector(`#nama${id}`).value;
    let hargaBarang = document.querySelector(`#harga${id}`).value;
    if (
        parseInt(inputStockBarang.value) &&
        parseInt(inputJumlahBarang.value) > 0
    ) {
        drafPesanan = [];
        drafPesanan.push({
            id: id,
            harga: hargaBarang,
            nama: namaBarang,
            jumlah: inputJumlahBarang.value,
        });
        drafPesanan.forEach((item) => {
            document.querySelector("#nothingOrder").classList.add("d-none");
            tabelDrafPesanan.innerHTML += `
        <tr>
            <td>
                <p>${item.nama}</p>
            </td>
            <td>
                <p>Rp ${item.harga}</p>
            </td>
            <td>
                <p>${item.jumlah}</p>
            </td>
        </tr>
        `;
            dataPesanan.push(drafPesanan);
        });
        btnChart.innerHTML = `<i class="fas fa-check"></i>`;
        btnChart.setAttribute("disabled", "disabled");
        btnAddQty.setAttribute("disabled", "disabled");
        btnMinQty.setAttribute("disabled", "disabled");
        document.querySelector("#dataPesanan").value =
            JSON.stringify(dataPesanan);
    }
}
