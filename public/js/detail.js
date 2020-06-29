//  Import package

// Value

let jumlah = document.getElementById("jumlah");
let tambah = document.getElementById("tambah");
let kurang = document.getElementById("kurang");
let harga = document.getElementById("harga").textContent;
let total = document.getElementById("total");

// Listener

let id = document.getElementById("id").textContent;
let btn = document.getElementById("btn");
let token = document.head.querySelector('meta[name="csrf_token"]').content;
let alert = document.getElementById("alert").textContent;
let url = "/edit";

btn.addEventListener("click", async function() {
    console.log(token);
    const respon = await fetch(url, {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": token
        },
        body: JSON.stringify({
            id: id,
            jumlah: jumlah.value,
            total: total.textContent
        })
    });
    let result = await respon.text();
    if (result) {
        console.log(result);
        window.location.replace("/cart");
    } else if (!result) {
        window.location.replace("/cart");
    }
});

tambah.addEventListener("click", function() {
    nilaiSekarang = Number(jumlah.value);
    jumlah.value = nilaiSekarang + 1;
    totalHarga();
});

kurang.addEventListener("click", function() {
    if (jumlah.value == 0) {
        return 0;
    }
    nilaiSekarang = Number(jumlah.value);
    jumlah.value = nilaiSekarang - 1;
    totalHarga();
});

jumlah.addEventListener("input", function() {
    console.log(jumlah.value);
    totalHarga();
});

console.log(tambah.value);

function totalHarga() {
    harga = harga.split("/")[0];
    total.textContent = harga * jumlah.value;
}
