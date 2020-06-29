// Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
var stripe = Stripe(
    "pk_test_51GvFZvL2Z5NpIn2qrAsI98Rzcth8nFX2iXiWPGtwDcl1ewGJ9ufpt3NWAWQglgsW668qM7xcYTMDZupKMFYbazrz00904cauYp"
);
var elements = stripe.elements();
// Set up Stripe.js and Elements to use in checkout form
var style = {
    base: {
        color: "#32325d"
    }
};
var card = elements.create("card", { style: style });
card.mount("#card-element");
card.on("change", function(event) {
    var displayError = document.getElementById("card-errors");
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = "";
    }
});

const btn = document.getElementById("btn");
let clientSecret = btn.getAttribute("data-secret");
var form = document.getElementById("payment-form");

form.addEventListener("submit", function(ev) {
    ev.preventDefault();
    const alamat = document.getElementById("alamat").value;
    const telp = document.getElementById("telp").value;
    const name1 = document.getElementById("name").value;
    const name2 = document.getElementById("name2").value;
    const name = `${name1} ${name2}`;
    const email = document.getElementById("email").value;
    const jumlah = document.getElementById("total-harga").textContent;
    console.log(jumlah);
    const token = document.querySelector('meta[name="csrf_token"]').content;
    stripe
        .confirmCardPayment(clientSecret, {
            payment_method: {
                card: card,
                billing_details: {
                    name: name,
                    address: alamat,
                    phone: telp
                }
            }
        })
        .then(function(result) {
            if (result.error) {
                // Show error to your customer (e.g., insufficient funds)
                console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === "succeeded") {
                    // Show a success message to your customer
                    // There's a risk of the customer closing the window before callback
                    // execution. Set up a webhook or plugin to listen for the
                    // payment_intent.succeeded event that handles any business critical
                    // post-payment actions.
                    function sendTransaction() {
                        let loader = document.getElementById("loader");
                        document.body.style.opacity = "0.4";
                        loader.style.display = "flex";
                        loader.style.opacity = "1";
                        setTimeout(async () => {
                            const respon = await fetch("payments/process", {
                                method: "post",
                                headers: {
                                    "Content-type": "application/json",
                                    "X-CSRF-TOKEN": token
                                },
                                body: JSON.stringify({
                                    name: name,
                                    alamat: alamat,
                                    email: email,
                                    jumlah: jumlah,
                                    telp: telp
                                })
                            });
                            const result = await respon.json();
                            if (result.success) {
                                loader.style.display = "none";
                                document.body.style.opacity = "1";
                                document.body.innerHTML = result.html;
                            }
                        }, 5000);
                    }
                    sendTransaction();
                }
            }
        });
});
