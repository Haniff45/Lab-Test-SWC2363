<?php
// Initialize variables
$name = '';
$month = '';
$salesAmount = 0;
$commission = 0;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'] ?? '';
    $month = $_POST['month'] ?? '';
    $salesAmount = floatval($_POST['salesAmount'] ?? 0);
    
    // Calculate commission based on sales amount
    $commissionRate = 0;
    if ($salesAmount >= 1 && $salesAmount <= 2000) {
        $commissionRate = 0.03;  // 3%
    } elseif ($salesAmount <= 5000) {
        $commissionRate = 0.04;  // 4%
    } elseif ($salesAmount <= 7000) {
        $commissionRate = 0.07;  // 7%
    } else {
        $commissionRate = 0.10;  // 10%
    }
    
    $commission = $salesAmount * $commissionRate;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Commission Calculation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            border: 1px solid #000;
            padding: 20px;
            max-width: 500px;
        }
        .form-title {
            text-decoration: underline;
            margin-bottom: 20px;
        }
        .form-row {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 120px;
        }
        input[type="text"], 
        input[type="number"] {
            width: 150px;
            padding: 5px;
        }
        .result {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .result-row {
            margin-bottom: 10px;
        }
        .label {
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">Sales Commission Calculation</h2>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-row">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-row">
                <label for="month">Month:</label>
                <input type="text" id="month" name="month" required>
            </div>
            
            <div class="form-row">
                <label for="salesAmount">Sales Amount:</label>
                <input type="number" id="salesAmount" name="salesAmount" step="0.01" required>
            </div>
            
            <div class="form-row">
                <input type="submit" value="Calculate Commission" style="margin-left: 120px; padding: 8px 16px;">
            </div>
        </form>
        
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $salesAmount > 0): ?>
            <div class="result">
                <h2 class="form-title">Sales Commission</h2>
                
                <div class="result-row">
                    <span class="label">Name</span>: <?php echo htmlspecialchars($name); ?>
                </div>
                
                <div class="result-row">
                    <span class="label">Month</span>: <?php echo htmlspecialchars($month); ?>
                </div>
                
                <div class="result-row">
                    <span class="label">Sales Amount</span>: RM <?php echo number_format($salesAmount, 2); ?>
                </div>
                
                <div class="result-row">
                    <span class="label">Sales Commission</span>: RM <?php echo number_format($commission, 2); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>