<?php
session_start();

if (!isset($_SESSION['new_stock'])) {
    header("Location: flower_stock_registration.php");
    exit;
}

$newStock = $_SESSION['new_stock'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop - New Stock Details</title>
    <style>
        body {
            background: #e6e6fa;
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        h1 {
            text-align: center;
            color: #8B0000;
        }
        .stock-details {
            background-color: #ffebcd;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }
        p {
            font-size: 1.1em;
        }
        a.button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 12px 24px;
            color: #fff;
            background-color: #8B0000;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        a.button:hover {
            background-color: #B22222;
            transform: scale(1.1);
        }
    </style>
</head>

<body> 
    <h1>New Stock Details</h1>
    <div class="stock-details">
        <p><strong>Flower Name:</strong> <?php echo htmlspecialchars($newStock['flowerName']); ?></p>
        <p><strong>Flower Type:</strong> <?php echo htmlspecialchars($newStock['flowerType']); ?></p>
        <p><strong>Stock Arrival Date:</strong> <?php echo htmlspecialchars($newStock['stockArrivalDate']); ?></p>
        <p><strong>Quantity:</strong> <?php echo htmlspecialchars($newStock['quantity']); ?></p>
        <p><strong>Price per Unit:</strong> <?php echo htmlspecialchars($newStock['pricePerUnit']); ?></p>
    </div>

    <a href="flower_stock_registration.php" class="button">Register More Stock</a>
    <a href="view_flower_records.php" class="button">View All Records</a>
</body>
</html>
