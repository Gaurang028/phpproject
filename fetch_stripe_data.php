<?php
require 'vendor/autoload.php'; // Load Stripe PHP SDK

\Stripe\Stripe::setApiKey('sk_test_51R01cRQNLot0ZDRGSE3eccJIVz7y0HJJGC0SrgxzE5JACpcYuzvtknzEvosM6YNbNy7ABN9INSwOeN3mLEAkX7RH00jTqe4z1l'); // Replace with your Secret Key

try {
    // Fetch last 10 payments
    $payments = \Stripe\PaymentIntent::all(['limit' => 10]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #6772E5;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .succeeded { background: #4CAF50; color: white; }
        .pending { background: #FFC107; color: black; }
        .failed { background: #F44336; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Recent Stripe Payments</h2>

        <?php if (count($payments->data) > 0) { ?>
            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Amount (USD)</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($payments->data as $payment) { ?>
                    <tr>
                        <td><?= $payment->id; ?></td>
                        <td>$<?= number_format($payment->amount / 100, 2); ?></td>
                        <td>
                            <span class="status <?= $payment->status; ?>">
                                <?= ucfirst($payment->status); ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>No payments found.</p>
        <?php } ?>
    </div>
</body>
</html>
