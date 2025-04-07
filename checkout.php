<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding: 50px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        button {
            background-color: #6772E5;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #5469d4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Stripe Payment Integration</h2>
        <form action="create-checkout-session.php" method="POST">
            <input type="hidden" name="amount" value="5000"> <!-- Amount in cents -->
            <button type="submit">Pay with Stripe</button>
        </form>
    </div>
</body>
</html>
