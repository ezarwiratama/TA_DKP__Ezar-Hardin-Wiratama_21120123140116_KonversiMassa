<!DOCTYPE html>
<html>
<head>
    <title>Konversi Massa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            overflow: hidden;
        }
        .container {
            max-width: 400px;
            margin: auto;
            margin-bottom: 8vh;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
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
            background-color: #486e59;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #31453a;
        }
        .nav-button {
            background-color: #6c757d;
            margin-top: 10px;
        }
        .nav-button:hover {
            background-color: #565e64;
        }
        .footer {
            position: fixed;
            bottom: 0;
            right: 0;
            padding: 10px;
            display: flex; 
            justify-content: end;
            color: grey; 
            font-size: 13px;
        }
         /* Hide scrollbars but allow scrolling */
        .container::-webkit-scrollbar {
            display: none;
        }
        .container {
            -ms-overflow-style: none;  /* IE 10+ */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body style="background-image: url(src/background.jpg); background-size: cover;">
    <div class="container">
        <h2 style="color:#31453a">Konversi Massa</h2>
         <form method="POST" action="tugas_akhir_ezar.php">
            <div class="form-group">
                <label for="mass">Input Massa:</label>
                <input type="number" id="mass" name="mass" required value="<?php echo isset($_POST['mass']) ? htmlspecialchars($_POST['mass']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="input_unit">Satuan Input:</label>
                <select id="input_unit" name="input_unit" required>
                    <?php
                    $unitOptions = array(
                        'kilograms' => 'Kilogram (kg)',
                        'micrograms' => 'Microgram (µg)',
                        'milligrams' => 'Miligram (mg)',
                        'grams' => 'Gram (g)',
                        'pounds' => 'Pound (lb)',
                        'ounces' => 'Ons (oz)',
                        'metrictons' => 'Metrik Ton (t)',
                        'longtons' => 'Ton Panjang (long ton)',
                        'shorttons' => 'Ton Pendek (short ton)',
                        'stones' => 'Stone (st)'
                    );

                    $keys = array_keys($unitOptions);
                    $values = array_values($unitOptions);
                    $count = count($unitOptions);

                    for ($i = 0; $i < $count; $i++) {
                        $selected = isset($_POST['input_unit']) && $_POST['input_unit'] == $keys[$i] ? 'selected' : '';
                        echo "<option value='$keys[$i]' $selected>$values[$i]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="output_unit">Konversi ke:</label>
                <select id="output_unit" name="output_unit" required>
                    <?php
                    for ($i = 0; $i < $count; $i++) {
                        $selected = isset($_POST['output_unit']) && $_POST['output_unit'] == $keys[$i] ? 'selected' : '';
                        echo "<option value='$keys[$i]' $selected>$values[$i]</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit">Konversi</button>
        </form>
        
        <?php
        session_start();

        class MassConverter {
            private $mass_kg;
            private $inputUnit;
            private $outputUnit;

            public function setMass($mass) {
                $this->mass_kg = $mass;
            }

            public function setInputUnit($inputUnit) {
                $this->inputUnit = $inputUnit;
            }

            public function setOutputUnit($outputUnit) {
                $this->outputUnit = $outputUnit;
            }

            private function convertFromInput() {
                switch ($this->inputUnit) {
                    case 'micrograms':
                        return $this->mass_kg / 1e9;
                    case 'milligrams':
                        return $this->mass_kg / 1e6;
                    case 'grams':
                        return $this->mass_kg / 1000;
                    case 'kilograms':
                        return $this->mass_kg;
                    case 'metrictons':
                        return $this->mass_kg * 1000;
                    case 'longtons':
                        return $this->mass_kg * 1016.0469088;
                    case 'shorttons':
                        return $this->mass_kg * 907.18474;
                    case 'stones':
                        return $this->mass_kg * 6.35029318;
                    case 'pounds':
                        return $this->mass_kg * 0.45359237;
                    case 'ounces':
                        return $this->mass_kg * 0.0283495231;
                    default:
                        return 0;
                }
            }

            public function convertResult() {
                $mass_output = $this->convertFromInput();

                switch ($this->outputUnit) {
                    case 'kilograms':
                        return $mass_output;
                    case 'micrograms':
                        return $mass_output * 1e9;
                    case 'milligrams':
                        return $mass_output * 1000000;
                    case 'grams':
                        return $mass_output * 1000;
                    case 'pounds':
                        return $mass_output * 2.20462;
                    case 'ounces':
                        return $mass_output * 35.274;
                    case 'metrictons':
                        return $mass_output / 1000;
                    case 'longtons':
                        return $mass_output / 1016.0469088;
                    case 'shorttons':
                        return $mass_output / 907.18474;
                    case 'stones':
                        return $mass_output / 6.35029318;
                    default:
                        return 0;
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['mass']) && isset($_POST['input_unit']) && isset($_POST['output_unit'])) {
                $mass = $_POST['mass'];
                $inputUnit = $_POST['input_unit'];
                $outputUnit = $_POST['output_unit'];

                $converter = new MassConverter();
                $converter->setMass($mass);
                $converter->setInputUnit($inputUnit);
                $converter->setOutputUnit($outputUnit);
                $converted_mass = $converter->convertResult();

                // Save the conversion result to a session variable for history
                if (!isset($_SESSION['history'])) {
                    $_SESSION['history'] = array();
                }
                $_SESSION['history'][] = array(
                    'mass' => $mass,
                    'inputUnit' => $inputUnit,
                    'outputUnit' => $outputUnit,
                    'result' => $converted_mass
                );

                echo "<p>Hasil: " . number_format($converted_mass, 2) . " " . $outputUnit . "</p>";
            } else {
                echo "<p>Terjadi kesalahan, mohon coba lagi.</p>";
            }
        }
        ?>
        <form action="history.php" method="get">
            <button type="submit" class="nav-button">Lihat Riwayat Konversi</button>
        </form>
    </div>
    <div class="footer">
        <p>Created by Ezar Hardin Wiratama</br>Menyala abangkuh &#128293 &#128293</p>
    </div>
</body>
</html>
