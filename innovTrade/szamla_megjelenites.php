<?php
session_start();

if (!isset($_SESSION['szamla_adatok'])) {
    die("Nincs elérhető számla.");
}

$szamla = $_SESSION['szamla_adatok'];
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Számla - InnovTrade</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .szamla-container { max-width: 600px; background: white; padding: 20px; margin: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .szamla-fejlec { text-align: center; margin-bottom: 20px; }
        .szamla-fejlec img { max-width: 100px; }
        .tetel-lista th, .tetel-lista td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .tetel-lista th { background-color: #2a9d8f; color: white; }
        .osszegzes { text-align: right; margin-top: 20px; }
        .gomb-container { text-align: center; margin-top: 20px; }
        .gomb-container button { background-color: #2a9d8f; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
    </style>
</head>
<body>
    <div class="szamla-container">
        <div class="szamla-fejlec">
            <img src="kepek/logo.png" alt="InnovTrade Logó">
            <h1>Számla</h1>
        </div>
        <p><strong>Számlázási név:</strong> <?= $szamla['felhasznalo_nev'] ?></p>
        <p><strong>Email:</strong> <?= $szamla['felhasznalo_email'] ?></p>
        <p><strong>Dátum:</strong> <?= $szamla['datum'] ?></p>
        <p><strong>Számla sorszáma:</strong> <?= $szamla['szamla_sorszam'] ?></p>

        <table class="tetel-lista">
            <tr><th>Termék</th><th>Mennyiség</th><th>Egységár</th><th>Összeg</th></tr>
            <?php foreach ($szamla['tetel_lista'] as $tetel): ?>
                <tr>
                    <td><?= $tetel['termek'] ?></td>
                    <td><?= $tetel['darab'] ?> nap</td>
                    <td><?= number_format($tetel['netar'], 0, ',', ' ') ?> Ft</td>
                    <td><?= number_format($tetel['osszeg'], 0, ',', ' ') ?> Ft</td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="osszegzes">
            <h3>Teljes összeg: <strong><?= number_format($szamla['teljes_osszeg'], 0, ',', ' ') ?> Ft</strong></h3>
        </div>
        <div class="gomb-container">
            <button onclick="window.print()">Számla nyomtatása</button>
        </div>
    </div>
</body>
</html>
