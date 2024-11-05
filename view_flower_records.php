<?php
$records = file('flowerstock.txt', FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop - View Flower Records</title>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #8B0000;
        }
        th, td {
            padding: 12px;
            text-align: left;
            background-color: #fff;
        }
        th {
            background-color: #ffebcd;
            color: #8B0000;
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
    <h1>Flower Stock Records</h1>
    <table>
        <thead>
            <tr>
                <th>Flower Name</th>
                <th>Flower Type</th>
                <th>Stock Arrival Date</th>
                <th>Quantity</th>
                <th>Price per Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
                <?php $fields = explode('|', $record); ?>
                <tr>
                    <td><?php echo htmlspecialchars($fields[0]); ?></td>
                    <td><?php echo htmlspecialchars($fields[1]); ?></td>
                    <td><?php echo htmlspecialchars($fields[2]); ?></td>
                    <td><?php echo htmlspecialchars($fields[3]); ?></td>
                    <td><?php echo htmlspecialchars($fields[4]); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <a href="flower_stock_registration.php" class="button">Register New Stock</a>
</body>
</html>
