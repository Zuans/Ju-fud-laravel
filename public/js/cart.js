let totalHarga = 0;
let totalSemua = document.getElementById("total");
const btn = document.getElementById("btn-pay");
const token = document.querySelector('meta[name="csrf_token"]').content;
const totalBarang = document.querySelectorAll(".total-barang").forEach(e => {
    totalHarga += Number(e.textContent);
});
totalSemua.textContent = totalHarga;
btn.addEventListener("click", async function() {
    const request = await fetch("payments", {
        method: "post",
        headers: {
            "Content-type": "application/json",
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({
            totalHarga: totalHarga
        })
    });

    let response = await request.json();
    if (response.success) {
        window.location.replace("/checkout");
    } else {
        alert("Something went wrong");
    }
});
