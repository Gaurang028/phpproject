<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51R01cRQNLot0ZDRGSE3eccJIVz7y0HJJGC0SrgxzE5JACpcYuzvtknzEvosM6YNbNy7ABN9INSwOeN3mLEAkX7RH00jTqe4z1l');

if (!isset($_GET['session_id'])) {
    die("Invalid session.");
}

$session_id = $_GET['session_id'];

try {
    // Retrieve session details
    $session = \Stripe\Checkout\Session::retrieve($session_id);

    // Check if a customer exists
    if (!empty($session->customer)) {
        $customer = \Stripe\Customer::retrieve($session->customer);
        $customer_email = htmlspecialchars($customer->email);
    } else {
        $customer_email = "Guest (No customer ID)";
    }

    echo "<h2>Payment Successful!</h2>";
    echo "<p>Transaction ID: " . htmlspecialchars($session->id) . "</p>";
    echo "<p>Customer Email: " . $customer_email . "</p>";
    echo "<p>Amount Paid: $" . number_format($session->amount_total / 100, 2) . "</p>";

} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error fetching payment details: " . htmlspecialchars($e->getMessage());
}
?>
