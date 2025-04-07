<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51R01cRQNLot0ZDRGSE3eccJIVz7y0HJJGC0SrgxzE5JACpcYuzvtknzEvosM6YNbNy7ABN9INSwOeN3mLEAkX7RH00jTqe4z1l');

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => 'T-shirts'],
                'unit_amount' => 1000, // $50 in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/phptest/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/phptest/cancel.php',
    ]);

    header("Location: " . $session->url);
    exit();
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error: " . $e->getMessage();
}
?>
