<?php
// Adatbázis kapcsolat
$servername = "localhost";
$username = "root"; // a saját adatbázis felhasználóneved
$password = ""; // a saját adatbázis jelszavad
$dbname = "felhasznalok"; // az adatbázis neve

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódás ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ha POST kérés érkezik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // űrlap adatainak bekérése
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = $_POST['jelszo'];

    // Lekérdezzük a felhasználót az adatbázisból
    $sql = "SELECT * FROM users WHERE felhasznalonev='$felhasznalonev'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // A felhasználó létezik, ellenőrizzük a jelszót
        $row = $result->fetch_assoc();
        if (password_verify($jelszo, $row['jelszo'])) {
            echo "Sikeres belépés!";
        } else {
            echo "Hibás jelszó!";
        }
    } else {
        echo "Nincs ilyen felhasználó!";
    }
}

// Kapcsolat bezárása
$conn->close();
?>
