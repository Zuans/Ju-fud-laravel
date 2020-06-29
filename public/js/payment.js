document.addEventListener("DOMContentLoaded", function() {
    var stripe = Stripe(
        "pk_test_51GvFZvL2Z5NpIn2qrAsI98Rzcth8nFX2iXiWPGtwDcl1ewGJ9ufpt3NWAWQglgsW668qM7xcYTMDZupKMFYbazrz00904cauYp"
    );
    var elements = stripe.elements();

    alert("awdwad");
    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: "16px",
            color: "#32325d"
        }
    };

    // Create an instance of the card Element.
    var card = elements.create("card", { style: style });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount("#card-element");

    // Create a token or display an error when the form is submitted.
    var form = document.getElementById("payment-form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById("payment-form");
        var hiddenInput = document.createElement("input");
        hiddenInput.setAttribute("type", "hidden");
        hiddenInput.setAttribute("name", "stripeToken");
        hiddenInput.setAttribute("value", token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
});
