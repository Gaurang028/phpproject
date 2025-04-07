<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51R01cRQNLot0ZDRGSE3eccJIVz7y0HJJGC0SrgxzE5JACpcYuzvtknzEvosM6YNbNy7ABN9INSwOeN3mLEAkX7RH00jTqe4z1l'); // Replace with your Secret Key

try {
    $line_item = [
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => 'T-Shirt',
                'description' => 'High-quality cotton T-Shirt',
            ],
            'unit_amount' => 2000, // Amount in cents ($20.00)
        ],
        'quantity' => 2, // Buying 2 T-Shirts
    ];

    // Optional: Only add `images` if a valid image URL exists
    $product_image = 'https://example.com/tshirt.png'; // Replace with your image URL or leave empty
    if (!empty($product_image)) {
        $line_item['price_data']['product_data']['images'] = [$product_image];
    }

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [$line_item],
        'mode' => 'payment',
        'success_url' => 'http://localhost/phptest/success.php',
        'cancel_url' => 'http://localhost/phptest/cancel.php',
    ]);

    echo json_encode(['id' => $session->id]); // Return session ID
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
