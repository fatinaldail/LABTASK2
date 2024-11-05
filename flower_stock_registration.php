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
    <title>Flower Shop - Flower Registration</title>
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
        form {
            background-color: #ffebcd;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #8B0000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #B22222;
            transform: scale(1.05);
        }
        .error-message {
            color: red;
            text-align: center;
            font-weight: bold;
        }
        .view-records {
            text-align: center;
            margin-top: 30px;
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
    </style>
</head>
<body>
    <h1>Flower Stock Registration</h1>
    
    <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>

    <form method="post" action="">
        <label for="flowerName">Flower Name:</label>
        <input type="text" id="flowerName" name="flowerName" required><br>
        
        <label for="flowerType">Flower Type:</label>
        <select id="flowerType" name="flowerType" required>
            <option value="">Select Type</option>
            <option value="Rose">Rose</option>
            <option value="Tulip">Tulip</option>
            <option value="Orchid">Orchid</option>
            <option value="Lily">Lily</option>
        </select><br>
        
        <label for="stockArrivalDate">Stock Arrival Date:</label>
        <input type="date" id="stockArrivalDate" name="stockArrivalDate" required><br>
        
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>
        
        <label for="pricePerUnit">Price per Unit:</label>
        <input type="number" id="pricePerUnit" name="pricePerUnit" step="0.01" required><br>
        
        <input type="submit" value="Submit">
    </form>

    <div class="view-records">
        <h2>View Flower Records</h2>
        <a href="view_flower_records.php" class="button">View All Records</a>
    </div>
</body>
</html>
