<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Konversi Massa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            overflow: hidden;
        }
        .container {
            max-width: 45vw;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
        }
        h2 {
            color: #31453a;
        }
        .table-container {
            max-height: 43vh;
            overflow-y: auto;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        button {
            padding: 10px 15px;
            background-color: #486e59;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #31453a;
        }
        .nav-button {
            background-color: #6c757d;
        }
        .nav-button:hover {
            background-color: #565e64;
        }
        /* Hide scrollbar */
        ::-webkit-scrollbar {
            width: 0;
            background: transparent; /* make scrollbar transparent */
        }
        /* Handle scrollbar in Firefox */
        html {
            scrollbar-width: none;
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
    </style>
</head>
<body style="background-image: url(src/background.jpg); background-size: cover;">
    <div class="container">
        <h2>Riwayat Konversi Massa</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Massa</th>
                        <th>Satuan Awal</th>
                        <th>Hasil Konversi</th>
                        <th>Satuan Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    if (isset($_SESSION['history'])) {
                        $history = array_reverse($_SESSION['history']);
                        $count = count($history);
                        for ($i = 0; $i < $count; $i++) {
                            $record = $history[$i];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($record['mass']) . "</td>";
                            echo "<td>" . htmlspecialchars($record['inputUnit']) . "</td>";
                            echo "<td>" . htmlspecialchars(number_format($record['result'], 2)) . "</td>";
                            echo "<td>" . htmlspecialchars($record['outputUnit']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada riwayat konversi.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div style="display: flex">
            <form action="tugas_akhir_ezar.php" method="get">
                <button type="submit" class="nav-button">Kembali</button>
            </form>
            <form action="clear_history.php" method="post">
                <button type="submit" class="nav-button" style="margin-left: 1vw;">Hapus Riwayat</button>
            </form>
        </div>
    </div>
    <div class="footer">
        <p>Created by Ezar Hardin Wiratama</br>Menyala abangkuh &#128293 &#128293</p>
    </div>
</body>
</html>