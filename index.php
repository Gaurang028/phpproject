<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h2>Pay with Stripe</h2>
    <form id="payment-form">
        <input type="text" id="name" placeholder="Full Name" required><br><br>
        <input type="email" id="email" placeholder="Email Address" required><br><br>
        <div id="card-element"></div> <!-- Stripe Card Element -->
        <button type="submit">Pay Now</button>
    </form>

    <script>
        var stripe = Stripe("pk_test_51R01cRQNLot0ZDRGRatz9kZWNJeiHMoasUNwMhD2zLEqJgxmC9ULN46MF4EHxNTOB0g8yos6kVDob1qdhXwExMiS00KA5BOlhN"); // Replace with your Stripe Publishable Key
        var elements = stripe.elements();
        var card = elements.create("card");
        card.mount("#card-element");

        var form = document.getElementById("payment-form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            stripe.createPaymentMethod({
                type: "card",
                card: card,
                billing_details: {
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value
                }
            }).then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                } else {
                    // Send PaymentMethod ID to server
                    fetch("charge.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({
                            payment_method_id: result.paymentMethod.id,
                            name: document.getElementById("name").value,
                            email: document.getElementById("email").value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Payment Successful!");
                        } else {
                            alert("Payment Failed: " + data.error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
