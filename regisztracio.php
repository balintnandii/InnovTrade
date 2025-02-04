<?php
// Adatbázis kapcsolat (példaként MySQL-t használunk)
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
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];
    $jelszo_megerositese = $_POST['jelszo_megerositese'];

    // Ellenőrizzük, hogy a jelszavak egyeznek-e
    if ($jelszo !== $jelszo_megerositese) {
        echo "A jelszavak nem egyeznek meg!";
    } else {
        // Titkosítjuk a jelszót
        $hashed_password = password_hash($jelszo, PASSWORD_DEFAULT);

        // Az adatbázisba mentés
        $sql = "INSERT INTO users (felhasznalonev, email, jelszo) VALUES ('$felhasznalonev', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Sikeres regisztráció!";
        } else {
            echo "Hiba: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Kapcsolat bezárása
$conn->close();
?>
