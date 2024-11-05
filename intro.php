<?php
session_start();

// Function to save flower records to a text file
function saveFlowerRecord($flowerName, $flowerType, $stockArrivalDate, $quantity, $pricePerUnit) {
    $record = "$flowerName|$flowerType|$stockArrivalDate|$quantity|$pricePerUnit\n";
    file_put_contents('flowerstock.txt', $record, FILE_APPEND);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flowerName = trim($_POST['flowerName']);
    $flowerType = trim($_POST['flowerType']);
    $stockArrivalDate = trim($_POST['stockArrivalDate']);
    $quantity = trim($_POST['quantity']);
    $pricePerUnit = trim($_POST['pricePerUnit']);

    // Validate required fields and ensure quantity and price are not negative
    if (empty($flowerName) || empty($flowerType) || empty($stockArrivalDate) || empty($quantity) || empty($pricePerUnit)) {
        $error = "All fields are required. Please complete the form.";
    } elseif ($quantity <= 0) {
        $error = "Quantity must be a positive number.";
    } elseif ($pricePerUnit <= 0) {
        $error = "Price per unit must be a positive number.";
    } else {
        // Save data to session for confirmation
        $_SESSION['new_stock'] = [
            'flowerName' => $flowerName,
            'flowerType' => $flowerType,
            'stockArrivalDate' => $stockArrivalDate,
            'quantity' => $quantity,
            'pricePerUnit' => $pricePerUnit
        ];

        // Save the data to a text file
        saveFlowerRecord($flowerName, $flowerType, $stockArrivalDate, $quantity, $pricePerUnit);
        header("Location: new_stock_details.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Pink Blossom Sdn Bhd</title>
    <style>
        body {
            background: #e6e6fa;
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        h1, h2 {
            text-align: center;
            color: #8B0000;
        }
        .flower-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 16px;
            margin: 16px;
            display: inline-block;
            width: 250px;
            text-align: center;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .flower-card:hover {
            transform: scale(1.05);
            box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.2);
        }
        .flower-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .intro-text {
            text-align: center;
            margin: 20px;
            font-size: 1.2em;
            background-color: #ffebcd;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }
        .get-started, .view-records {
            display: block;
            text-align: center;
            margin: 30px;
        }
        a.button {
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
        .flower-description {
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Welcome to Pink Blossom Flower Stock Management</h1>
    <p class="intro-text">At Pink Blossom Sdn Bhd, we cherish the beauty of nature and bring you a delightful variety of flowers, perfect for any occasion. Our goal is to make flower stock management a breeze. From roses to lilies, manage your favorite blossoms with ease using our user-friendly platform.</p>
    
    <h2>Available Flower Varieties</h2>
    <div class="flower-card">
        <img src="images/rose1.jpeg" alt="Rose">
        <h3>Rose</h3>
        <p class="flower-description">A beautiful flower known for its fragrance and vibrant colors, roses symbolize love and passion. Available in red, pink, yellow, and white.</p>
    </div>
    <div class="flower-card">
        <img src="images/tulip.jpeg" alt="Tulip">
        <h3>Tulip</h3>
        <p class="flower-description">Elegant and colorful, tulips represent joy and are perfect for any celebration. Available in a variety of colors, each with its own unique meaning.</p>
    </div>
    <div class="flower-card">
        <img src="images/orchid.jpeg" alt="Orchid">
        <h3>Orchid</h3>
        <p class="flower-description">Exotic and delicate, orchids symbolize beauty, luxury, and strength. They add a touch of sophistication to any space.</p>
    </div>
    <div class="flower-card">
        <img src="images/lily.jpeg" alt="Lily">
        <h3>Lily</h3>
        <p class="flower-description">Symbolizing purity and refined beauty, lilies are popular for their classic charm. Available in white, pink, and orange.</p>
    </div>

    <div class="get-started">
       
        <a href="flower_stock_registration.php" class="button">Flower Stock Registration</a>
    </div>

    <div class="view-records">
    
        <a href="view_flower_records.php" class="button">View All Records</a>
    </div>
</body>
</html>
