<?php
require 'vendor/autoload.php'; // Load Stripe PHP Library

\Stripe\Stripe::setApiKey('sk_test_51R01cRQNLot0ZDRGSE3eccJIVz7y0HJJGC0SrgxzE5JACpcYuzvtknzEvosM6YNbNy7ABN9INSwOeN3mLEAkX7RH00jTqe4z1l'); // Replace with your Secret Key

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount']; // Get amount from form (in cents)

    try {
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        echo "Payment Successful. Payment Intent ID: " . $paymentIntent->id;
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
