<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Űrlapadatok beolvasása
    $autoNevek = $_POST['autonev']; // Az összes autó neve, amit a kosárba tett
    $datum = $_POST['datum'];
    $ido = $_POST['ido'];
    $nev = isset($_SESSION['felhasznalo']) ? $_SESSION['felhasznalo'] : "Nincs megadva";
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : "Nincs megadva";

    // Definiáljunk egy tömböt az autók nettó áraival
    $autoArak = array(
        "Fiat 500" => 15000, "Toyota Yaris" => 18000, "Volkswagen Polo" => 17000, "Kia Picanto" => 14000,
        "Renault Clio" => 16000, "Hyundai i20" => 16500, "Seat Ibiza" => 17500, "Opel Corsa" => 15800,
        "Renault Grand Scenic" => 20000, "Ford S-Max" => 22000, "Skoda Kodiaq" => 24000, "Toyota RAV4" => 23500,
        "Honda CR-V" => 22800, "Peugeot 5008" => 23800, "Volkswagen Tiguan" => 24500, "Mazda CX-5" => 23000,
        "BMW X5" => 50000, "Tesla Model S" => 70000, "Mercedes S-Class" => 90000, "Audi A8" => 85000,
        "Lexus LS" => 88000, "Jaguar XJ" => 95000, "Range Rover" => 100000, "Porsche Panamera" => 110000,
        "Ford Mustang" => 90000, "Chevrolet Camaro" => 85000, "Porsche 911" => 120000, "Ferrari F8" => 200000,
        "Lamborghini Huracan" => 250000, "McLaren 720S" => 300000, "Audi R8" => 180000, "Nissan GT-R" => 160000
    );

    // Összeg kiszámítása
    $teljesOsszeg = 0;
    $szamlaTetelek = [];

    $autokLista = explode(", ", $autoNevek); // Ha több autó van, külön kezeljük őket

    foreach ($autokLista as $autoNev) {
        if (isset($autoArak[$autoNev])) {
            $netar = $autoArak[$autoNev];
            $osszeg = $netar * $ido;
            $teljesOsszeg += $osszeg;

            $szamlaTetelek[] = [
                'termek' => $autoNev,
                'darab'  => $ido,
                'netar'  => $netar,
                'osszeg' => $osszeg
            ];
        }
    }

    // A számla adatai
    $_SESSION['szamla_adatok'] = [
        'felhasznalo_nev' => $nev,
        'felhasznalo_email' => $email,
        'datum' => date("Y-m-d"),
        'szamla_sorszam' => "INV" . date("Ymd") . rand(1000, 9999),
        'tetel_lista' => $szamlaTetelek,
        'teljes_osszeg' => $teljesOsszeg
    ];

    // Foglalás mentése az adatbázisba
    $sql = "INSERT INTO foglalasok (felhasznalonev, email, autok, datum, idotartam, osszeg)
            VALUES ('$nev', '$email', '$autoNevek', '$datum', '$ido', '$teljesOsszeg')";
    $kapcsolat->query($sql);

    // Visszajelzés és gomb megjelenítése
    $_SESSION['szamla_elkeszult'] = true;
    header("Location: index.php?foglalas_sikeres=1");
    exit();
}
?>
