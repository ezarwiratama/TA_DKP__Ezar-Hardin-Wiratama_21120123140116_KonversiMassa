<!DOCTYPE html>
<html>
<head>
    <title>Konversi Massa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Konversi Massa</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="mass">Massa dalam Kilogram (kg):</label>
                <input type="number" step="0.01" id="mass" name="mass" required>
            </div>
            <div class="form-group">
                <label for="unit">Konversi ke:</label>
                <select id="unit" name="unit" required>
                    <option value="grams">Gram (g)</option>
                    <option value="milligrams">Miligram (mg)</option>
                    <option value="pounds">Pound (lb)</option>
                    <option value="ounces">Ons (oz)</option>
                </select>
            </div>
            <button type="submit">Konversi</button>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mass = $_POST['mass'];
            $unit = $_POST['unit'];
            $converted_mass = 0;

            switch ($unit) {
                case 'grams':
                    $converted_mass = $mass * 1000;
                    break;
                case 'milligrams':
                    $converted_mass = $mass * 1000000;
                    break;
                case 'pounds':
                    $converted_mass = $mass * 2.20462;
                    break;
                case 'ounces':
                    $converted_mass = $mass * 35.274;
                    break;
            }

            echo "<p>Hasil: " . number_format($converted_mass, 2) . " " . ucfirst($unit) . "</p>";
        }
        ?>
    </div>
</body>
</html>
