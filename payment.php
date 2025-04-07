<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51R01cRQNLot0ZDRGSE3eccJIVz7y0HJJGC0SrgxzE5JACpcYuzvtknzEvosM6YNbNy7ABN9INSwOeN3mLEAkX7RH00jTqe4z1l'); // Replace with your Secret Key

try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 4000, // $50.00 in cents
        'currency' => 'usd',
        'metadata' => [
            'product_name' => 'Wireless Mouse',
            'product_id' => 'mouse_001',
            'quantity' => 1,
        ],
    ]);

    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
