<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InnovTrade - Autókölcsönző</title>
  <link rel="stylesheet" href="vizsga.css">
  <script src="vizsga.js" defer></script>
  <style>
    /* Legördülő menü stílus – csak hover esetén jelenik meg az opciók listája */
    .dropdown {
      position: relative;
      display: inline-block;
    }
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #dddddd;
      min-width: 200px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      z-index: 1;
      border-radius: 5px;
    }
    .dropdown-menu a {
      color: #000;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    .dropdown-menu a:hover {
      background-color: #ff0000;
    }
    .dropdown:hover .dropdown-menu {
      display: block;
    }
    
    /* Modális ablakok középre igazítása */
    #regisztracio, #belepes {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 90%;
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      border-radius: 10px;
      z-index: 1000;
      display: none;
    }
    /* Felhasználói információ a jobb felső sarokban */
    #felhasznalo-info {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: #2a9d8f;
      color: #fff;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 0.9rem;
    }
    #felhasznalo-info a {
      color: #fff;
      text-decoration: none;
      margin-left: 10px;
    }
  </style>
</head>
<body>
  <header>
    <div class="header-container">
      <img src="kepek/logo.png" alt="InnovTrade Logó" class="logo">
      <h1>InnovTrade - Autókölcsönző</h1>
    </div>
    <p class="header-description">Minőségi autók minden kategóriában. Találd meg az igazit!</p>
    <nav>
      <ul>
        <li><a href="#kezdolap">Kezdőlap</a></li>
        <li class="dropdown">
          <a href="#autok">Autók ▼</a>
          <div class="dropdown-menu">
            <a href="#gazdasagos" onclick="kategoriaMegjelenites('gazdasagos')">Gazdaságos Autók</a>
            <a href="#csaladi" onclick="kategoriaMegjelenites('csaladi')">Családi Autók</a>
            <a href="#luxus" onclick="kategoriaMegjelenites('luxus')">Luxus Autók</a>
            <a href="#sport" onclick="kategoriaMegjelenites('sport')">Sport Autók</a>
          </div>
        </li>
        <li><a href="#foglalas">Foglalás</a></li>
        <li><a href="#kapcsolat">Kapcsolat</a></li>
        <li><a href="#velemenyek">Vélemények</a></li>
      </ul>
    </nav>
  </header>
  
  <div id="felhasznalo-info">
    <?php if(isset($_SESSION['felhasznalo'])): ?>
        <span>Bejelentkezve: <?php echo htmlspecialchars($_SESSION['felhasznalo']); ?></span>
        <a href="kijelentkezes.php" title="Kijelentkezés">
            <img src="kepek/logout_icon.png" alt="Kijelentkezés" style="width:25px; vertical-align:middle;">
        </a>
    <?php else: ?>
        <a href="#" id="belepes-gomb">Bejelentkezés</a> |
        <a href="#" id="regisztracio-gomb">Regisztráció</a>
    <?php endif; ?>
</div>


  
  <!-- Regisztráció és Belépés gombok (ha nincs bejelentkezve) -->
  <?php if(!isset($_SESSION['felhasznalo'])): ?>
  <?php endif; ?>
  
  <div id="overlay"></div>
  
  <!-- Regisztrációs űrlap -->
  <section id="regisztracio">
    <h2>Regisztráció</h2>
    <form id="regisztracio-urlap" action="regisztracio.php" method="POST">
      <label for="felhasznalonev">Felhasználónév:</label>
      <input type="text" id="felhasznalonev" name="felhasznalonev" required placeholder="Írd be a felhasználóneved">
      <label for="email">Email cím:</label>
      <input type="email" id="email" name="email" required placeholder="Írd be az email címed">
      <label for="jelszo">Jelszó:</label>
      <input type="password" id="jelszo" name="jelszo" required placeholder="Írd be a jelszavad">
      <label for="jelszo_megerositese">Jelszó megerősítése:</label>
      <input type="password" id="jelszo_megerositese" name="jelszo_megerositese" required placeholder="Erősítsd meg a jelszavad">
      <button type="submit">Regisztrálok</button>
    </form>
    <button class="bezaras-gomb" onclick="zarasFelulet()">Bezárás</button>
  </section>
  
  <!-- Belépési űrlap -->
  <section id="belepes">
    <h2>Belépés</h2>
    <form id="belepes-urlap" action="bejelentkezes.php" method="POST">
      <label for="felhasznalonev">Felhasználónév:</label>
      <input type="text" id="felhasznalonev" name="felhasznalonev" required placeholder="Írd be a felhasználóneved">
      <label for="jelszo">Jelszó:</label>
      <input type="password" id="jelszo" name="jelszo" required placeholder="Írd be a jelszavad">
      <button type="submit">Belépek</button>
    </form>
    <button class="bezaras-gomb" onclick="zarasFelulet()">Bezárás</button>
  </section>
  
  <main>
    <!-- Kezdőlap -->
    <section id="kezdolap">
      <h2>Üdvözlünk az InnovTrade Autókölcsönzőnél!</h2>
      <p>Találd meg a tökéletes autót bármilyen alkalomra. Foglalj egyszerűen és gyorsan!</p>
    </section>
    
    <!-- Autók -->
    <section id="autok">
      <h2>Bérelhető Autóink</h2>
      
      <!-- Gazdaságos autók -->
      <div id="gazdasagos" class="kategoria" style="display:block;">
        <h4>Gazdaságos Autók</h4>
        <div class="autok-halo">
          <div class="auto gazdasagos">
            <img src="kepek/fiat500.jpg" alt="Fiat 500">
            <h3>Fiat 500</h3>
            <p>Napi díj: 15 000 Ft</p>
            <p>Kényelmes városi közlekedéshez.</p>
            <button onclick="hozzaadKosarhoz('Fiat 500', 15000)">Kosárba</button>
          </div>
          <div class="auto gazdasagos">
            <img src="kepek/toyota_yaris.jpg" alt="Toyota Yaris">
            <h3>Toyota Yaris</h3>
            <p>Napi díj: 18 000 Ft</p>
            <p>Megbízható és takarékos választás.</p>
            <button onclick="hozzaadKosarhoz('Toyota Yaris', 18000)">Kosárba</button>
          </div>
          <div class="auto gazdasagos">
            <img src="kepek/volkswagen_polo.jpg" alt="Volkswagen Polo">
            <h3>Volkswagen Polo</h3>
            <p>Napi díj: 17 000 Ft</p>
            <p>Praktikus és gazdaságos.</p>
            <button onclick="hozzaadKosarhoz('Volkswagen Polo', 17000)">Kosárba</button>
          </div>
          <div class="auto gazdasagos">
            <img src="kepek/kia_picanto.jpg" alt="Kia Picanto">
            <h3>Kia Picanto</h3>
            <p>Napi díj: 14 000 Ft</p>
            <p>Energiatakarékos kisautó.</p>
            <button onclick="hozzaadKosarhoz('Kia Picanto', 14000)">Kosárba</button>
          </div>
          <div class="auto gazdasagos">
            <img src="kepek/renault_clio.jpg" alt="Renault Clio">
            <h3>Renault Clio</h3>
            <p>Napi díj: 16 000 Ft</p>
            <p>Modern megjelenés és gazdaságos.</p>
            <button onclick="hozzaadKosarhoz('Renault Clio', 16000)">Kosárba</button>
          </div>
          <div class="auto gazdasagos">
            <img src="kepek/hyundai_i20.jpg" alt="Hyundai i20">
            <h3>Hyundai i20</h3>
            <p>Napi díj: 16 500 Ft</p>
            <p>Ideális városi közlekedéshez.</p>
            <button onclick="hozzaadKosarhoz('Hyundai i20', 16500)">Kosárba</button>
          </div>
          <div class="auto gazdasagos">
            <img src="kepek/seat_ibiza.jpg" alt="Seat Ibiza">
            <h3>Seat Ibiza</h3>
            <p>Napi díj: 17 500 Ft</p>
            <p>Kényelmes és energiatakarékos.</p>
            <button onclick="hozzaadKosarhoz('Seat Ibiza', 17500)">Kosárba</button>
          </div>
          <div class="auto gazdasagos">
            <img src="kepek/opel_corsa.jpg" alt="Opel Corsa">
            <h3>Opel Corsa</h3>
            <p>Napi díj: 15 800 Ft</p>
            <p>Gazdaságos és modern belső tér.</p>
            <button onclick="hozzaadKosarhoz('Opel Corsa', 15800)">Kosárba</button>
          </div>
        </div>
      </div>
      
      <!-- Családi autók -->
      <div id="csaladi" class="kategoria" style="display:none;">
        <h4>Családi Autók</h4>
        <div class="autok-halo">
          <div class="auto csaladi">
            <img src="kepek/renault_grand_scenic.jpg" alt="Renault Grand Scenic">
            <h3>Renault Grand Scenic</h3>
            <p>Napi díj: 20 000 Ft</p>
            <p>Ideális nagycsaládok számára.</p>
            <button onclick="hozzaadKosarhoz('Renault Grand Scenic', 20000)">Kosárba</button>
          </div>
          <div class="auto csaladi">
            <img src="kepek/ford_smax.jpg" alt="Ford S-Max">
            <h3>Ford S-Max</h3>
            <p>Napi díj: 22 000 Ft</p>
            <p>Hosszú utakra kényelmes választás.</p>
            <button onclick="hozzaadKosarhoz('Ford S-Max', 22000)">Kosárba</button>
          </div>
          <div class="auto csaladi">
            <img src="kepek/skoda_kodiaq.jpg" alt="Skoda Kodiaq">
            <h3>Skoda Kodiaq</h3>
            <p>Napi díj: 24 000 Ft</p>
            <p>Tágas és biztonságos.</p>
            <button onclick="hozzaadKosarhoz('Skoda Kodiaq', 24000)">Kosárba</button>
          </div>
          <div class="auto csaladi">
            <img src="kepek/toyota_rav4.jpg" alt="Toyota RAV4">
            <h3>Toyota RAV4</h3>
            <p>Napi díj: 23 500 Ft</p>
            <p>Gazdaságos családi SUV.</p>
            <button onclick="hozzaadKosarhoz('Toyota RAV4', 23500)">Kosárba</button>
          </div>
          <div class="auto csaladi">
            <img src="kepek/honda_crv.jpg" alt="Honda CR-V">
            <h3>Honda CR-V</h3>
            <p>Napi díj: 22 800 Ft</p>
            <p>Prémium komfort a családnak.</p>
            <button onclick="hozzaadKosarhoz('Honda CR-V', 22800)">Kosárba</button>
          </div>
          <div class="auto csaladi">
            <img src="kepek/peugeot_5008.jpg" alt="Peugeot 5008">
            <h3>Peugeot 5008</h3>
            <p>Napi díj: 23 800 Ft</p>
            <p>Tágas és modern belső tér.</p>
            <button onclick="hozzaadKosarhoz('Peugeot 5008', 23800)">Kosárba</button>
          </div>
          <div class="auto csaladi">
            <img src="kepek/volkswagen_tiguan.jpg" alt="Volkswagen Tiguan">
            <h3>Volkswagen Tiguan</h3>
            <p>Napi díj: 24 500 Ft</p>
            <p>Biztonságos SUV hosszú utakra.</p>
            <button onclick="hozzaadKosarhoz('Volkswagen Tiguan', 24500)">Kosárba</button>
          </div>
          <div class="auto csaladi">
            <img src="kepek/mazda_cx5.jpg" alt="Mazda CX-5">
            <h3>Mazda CX-5</h3>
            <p>Napi díj: 23 000 Ft</p>
            <p>Sportos SUV családi használatra.</p>
            <button onclick="hozzaadKosarhoz('Mazda CX-5', 23000)">Kosárba</button>
          </div>
        </div>
      </div>
      
      <!-- Luxus autók -->
      <div id="luxus" class="kategoria" style="display:none;">
        <h4>Luxus Autók</h4>
        <div class="autok-halo">
          <div class="auto luxus">
            <img src="kepek/bmw_x5.jpg" alt="BMW X5">
            <h3>BMW X5</h3>
            <p>Napi díj: 50 000 Ft</p>
            <p>Prémium SUV elegáns vezetési élményhez.</p>
            <button onclick="hozzaadKosarhoz('BMW X5', 50000)">Kosárba</button>
          </div>
          <div class="auto luxus">
            <img src="kepek/tesla_model_s.jpg" alt="Tesla Model S">
            <h3>Tesla Model S</h3>
            <p>Napi díj: 70 000 Ft</p>
            <p>Villanyautó modern technológiával.</p>
            <button onclick="hozzaadKosarhoz('Tesla Model S', 70000)">Kosárba</button>
          </div>
          <div class="auto luxus">
            <img src="kepek/mercedes_s_class.jpg" alt="Mercedes S-Class">
            <h3>Mercedes S-Class</h3>
            <p>Napi díj: 90 000 Ft</p>
            <p>Luxus limuzin kiváló kényelemmel.</p>
            <button onclick="hozzaadKosarhoz('Mercedes S-Class', 90000)">Kosárba</button>
          </div>
          <div class="auto luxus">
            <img src="kepek/audi_a8.jpg" alt="Audi A8">
            <h3>Audi A8</h3>
            <p>Napi díj: 85 000 Ft</p>
            <p>Luxus szedán csúcstechnológiával.</p>
            <button onclick="hozzaadKosarhoz('Audi A8', 85000)">Kosárba</button>
          </div>
          <div class="auto luxus">
            <img src="kepek/lexus_ls.jpg" alt="Lexus LS">
            <h3>Lexus LS</h3>
            <p>Napi díj: 88 000 Ft</p>
            <p>Elegancia és modernitás kombinációja.</p>
            <button onclick="hozzaadKosarhoz('Lexus LS', 88000)">Kosárba</button>
          </div>
          <div class="auto luxus">
            <img src="kepek/jaguar_xj.jpg" alt="Jaguar XJ">
            <h3>Jaguar XJ</h3>
            <p>Napi díj: 95 000 Ft</p>
            <p>Elegáns és sportos luxusautó.</p>
            <button onclick="hozzaadKosarhoz('Jaguar XJ', 95000)">Kosárba</button>
          </div>
          <div class="auto luxus">
            <img src="kepek/range_rover.jpg" alt="Range Rover">
            <h3>Range Rover</h3>
            <p>Napi díj: 100 000 Ft</p>
            <p>Prémium SUV kiemelkedő kényelemmel.</p>
            <button onclick="hozzaadKosarhoz('Range Rover', 100000)">Kosárba</button>
          </div>
          <div class="auto luxus">
            <img src="kepek/porsche_panamera.jpg" alt="Porsche Panamera">
            <h3>Porsche Panamera</h3>
            <p>Napi díj: 110 000 Ft</p>
            <p>Luxus és teljesítmény tökéletes kombinációja.</p>
            <button onclick="hozzaadKosarhoz('Porsche Panamera', 110000)">Kosárba</button>
          </div>
        </div>
      </div>
      
      <!-- Sport autók -->
      <div id="sport" class="kategoria" style="display:none;">
        <h4>Sport Autók</h4>
        <div class="autok-halo">
          <div class="auto sport">
            <img src="kepek/ford_mustang.jpg" alt="Ford Mustang">
            <h3>Ford Mustang</h3>
            <p>Napi díj: 90 000 Ft</p>
            <p>Sportos vezetési élmény.</p>
            <button onclick="hozzaadKosarhoz('Ford Mustang', 90000)">Kosárba</button>
          </div>
          <div class="auto sport">
            <img src="kepek/chevrolet_camaro.jpg" alt="Chevrolet Camaro">
            <h3>Chevrolet Camaro</h3>
            <p>Napi díj: 85 000 Ft</p>
            <p>Lenyűgöző teljesítmény és stílus.</p>
            <button onclick="hozzaadKosarhoz('Chevrolet Camaro', 85000)">Kosárba</button>
          </div>
          <div class="auto sport">
            <img src="kepek/porsche_911.jpg" alt="Porsche 911">
            <h3>Porsche 911</h3>
            <p>Napi díj: 120 000 Ft</p>
            <p>Sportautó csúcsteljesítménnyel.</p>
            <button onclick="hozzaadKosarhoz('Porsche 911', 120000)">Kosárba</button>
          </div>
          <div class="auto sport">
            <img src="kepek/ferrari_f8.jpg" alt="Ferrari F8">
            <h3>Ferrari F8</h3>
            <p>Napi díj: 200 000 Ft</p>
            <p>Lenyűgöző design és sebesség.</p>
            <button onclick="hozzaadKosarhoz('Ferrari F8', 200000)">Kosárba</button>
          </div>
          <div class="auto sport">
            <img src="kepek/lamborghini_huracan.jpg" alt="Lamborghini Huracan">
            <h3>Lamborghini Huracan</h3>
            <p>Napi díj: 250 000 Ft</p>
            <p>Extrém teljesítmény és luxus.</p>
            <button onclick="hozzaadKosarhoz('Lamborghini Huracan', 250000)">Kosárba</button>
          </div>
          <div class="auto sport">
            <img src="kepek/mclaren_720s.jpg" alt="McLaren 720S">
            <h3>McLaren 720S</h3>
            <p>Napi díj: 300 000 Ft</p>
            <p>Teljesítmény az autók szerelmeseinek.</p>
            <button onclick="hozzaadKosarhoz('McLaren 720S', 300000)">Kosárba</button>
          </div>
          <div class="auto sport">
            <img src="kepek/audi_r8.jpg" alt="Audi R8">
            <h3>Audi R8</h3>
            <p>Napi díj: 180 000 Ft</p>
            <p>Modern sportautó kiemelkedő dizájnnal.</p>
            <button onclick="hozzaadKosarhoz('Audi R8', 180000)">Kosárba</button>
          </div>
          <div class="auto sport">
            <img src="kepek/nissan_gt_r.jpg" alt="Nissan GT-R">
            <h3>Nissan GT-R</h3>
            <p>Napi díj: 160 000 Ft</p>
            <p>Kiváló ár-érték arány a sportkategóriában.</p>
            <button onclick="hozzaadKosarhoz('Nissan GT-R', 160000)">Kosárba</button>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Foglalás űrlap -->
    <section id="foglalas">
      <h2>Foglalás</h2>
      <div id="kosar-tartalom">
        <h3>Kosár tartalma</h3>
        <ul id="kosar-lista">
            <?php
            if (isset($_SESSION['kosar']) && count($_SESSION['kosar']) > 0) {
            foreach ($_SESSION['kosar'] as $auto) {
                echo "<li>" . htmlspecialchars($auto['nev']) . " - " . htmlspecialchars($auto['ar']) . " Ft/nap</li>";
            }
            } else {
                echo "<li>A kosár üres.</li>";
            }
            ?>
        </ul>

      </div>
      <form id="foglalas-urlap" action="foglalas.php" method="POST">
        <!-- Rejtett mező, amelybe a kosárból automatikusan beíródnak az autók nevei -->
        <input type="hidden" id="foglalas-autonev-hidden" name="autonev">
    
        <label for="foglalas-datum">Foglalás dátuma:</label>
        <input type="date" id="foglalas-datum" name="datum" required>
    
        <label for="foglalas-ido">Foglalás időtartalma (napok):</label>
        <input type="number" id="foglalas-ido" name="ido" min="1" required>
    
        <label for="foglalas-nev">Név:</label>
        <input type="text" id="foglalas-nev" name="nev" required value="<?php echo isset($_SESSION['felhasznalo']) ? htmlspecialchars($_SESSION['felhasznalo']) : ''; ?>" readonly>

        <label for="foglalas-email">Email:</label>
        <input type="email" id="foglalas-email" name="email" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" readonly>

        <input type="hidden" id="foglalas-autonev-hidden" name="autonev">

    
        <label for="foglalas-email">Email:</label>
        <input type="email" id="foglalas-email" name="email" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
    
        <button type="submit">Foglalás küldése</button>
      </form>
    </section>
    <?php if(isset($_SESSION['szamla_elkeszult']) && $_SESSION['szamla_elkeszult']): ?>
    <div style="text-align: center; margin-top: 20px;">
        <a href="szamla_megjelenites.php" class="stilusos-gomb">Számla megtekintése</a>
    </div>
    <?php unset($_SESSION['szamla_elkeszult']); ?>
    <?php endif; ?>

    
    <!-- Vélemények -->
    <section id="velemenyek">
      <h2>Vásárlói Vélemények</h2>
      <div id="velemenyek-lista">
        <?php
          $sqlVelemenyek = "SELECT v.auto_nev, v.szoveg, f.felhasznalonev 
                             FROM velemenyek v 
                             JOIN felhasznalok f ON v.felhasznalo_id = f.id 
                             ORDER BY v.letrehozas_datum DESC";
          $eredmenyVelemenyek = $kapcsolat->query($sqlVelemenyek);
          if ($eredmenyVelemenyek && $eredmenyVelemenyek->num_rows > 0) {
            while ($sor = $eredmenyVelemenyek->fetch_assoc()) {
              echo "<p><strong>" . htmlspecialchars($sor['felhasznalonev']) . " (" . htmlspecialchars($sor['auto_nev']) . "):</strong> " . htmlspecialchars($sor['szoveg']) . "</p>";
            }
          } else {
            echo "<p>Még nincs vélemény. Légy te az első!</p>";
          }
        ?>
      </div>
      <form id="velemeny-urlap">
        <label for="velemeny-autonev">Autó neve:</label>
        <input type="text" id="velemeny-autonev" placeholder="Pl.: Fiat 500" required>
        <label for="velemeny-szoveg">Véleményed:</label>
        <textarea id="velemeny-szoveg" rows="4" placeholder="Írd meg a véleményed!" required></textarea>
        <button type="button" onclick="velemenyHozzaadasa()">Vélemény Beküldése</button>
      </form>
    </section>
    
    <!-- Kapcsolat -->
    <section id="kapcsolat">
      <h2>Kapcsolat</h2>
      <p>Ügyfélszolgálatunk 0-24 elérhető</p>
      <form id="kapcsolat-urlap">
        <label for="kapcsolat-nev">Név:</label>
        <input type="text" id="kapcsolat-nev" required value="<?php echo isset($_SESSION['felhasznalo']) ? htmlspecialchars($_SESSION['felhasznalo']) : ''; ?>">
        <label for="kapcsolat-email">Email:</label>
        <input type="email" id="kapcsolat-email" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
        <label for="kapcsolat-uzenet">Üzenet:</label>
        <textarea id="kapcsolat-uzenet" rows="5" required></textarea>
        <button type="button" onclick="kapcsolatHozzaadasa()">Üzenet Küldése</button>
      </form>
    </section>
  </main>
  
  <footer>
        <p2>&copy; 2024 InnovTrade Autókölcsönző. Minden jog fenntartva.</p2>
        <p>Fedezz fel minket Instagramon és Facebookon!</p>
        <a href="https://www.instagram.com/innov_trade" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="40" height="40">
        
            <a href="https://www.facebook.com/yourusername" target="_blank">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" width="40" height="40">
        </a>
    </footer>
  
  <script>
    // Modális ablakok kezelése
    document.getElementById('regisztracio-gomb').addEventListener('click', function() {
      document.getElementById('regisztracio').style.display = 'block';
      document.getElementById('belepes').style.display = 'none';
      document.getElementById('overlay').style.display = 'block';
    });
    document.getElementById('belepes-gomb').addEventListener('click', function() {
      document.getElementById('belepes').style.display = 'block';
      document.getElementById('regisztracio').style.display = 'none';
      document.getElementById('overlay').style.display = 'block';
    });
    function zarasFelulet() {
      document.getElementById('regisztracio').style.display = 'none';
      document.getElementById('belepes').style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
    }
    document.getElementById('overlay').addEventListener('click', zarasFelulet);
    
    // A kosár tartalmának frissítése, és a rejtett foglalás autó neve mező frissítése
    session_start();

    if (!isset($_SESSION['kosar'])) {
        $_SESSION['kosar'] = []; // Ha még nincs kosár, inicializáljuk
    }

    let kosar = []; // Ez a globális kosár tömb
    function hozzaadKosarhoz(autoNev, ar) {
      kosar.push({ nev: autoNev, ar: ar });
      frissitKosar();
      alert(autoNev + " hozzáadva a kosárhoz!");
    }
    function frissitKosar() {
      const kosarLista = document.getElementById("kosar-lista");
      if (kosar.length === 0) {
        kosarLista.innerHTML = "<li>A kosár üres.</li>";
      } else {
        kosarLista.innerHTML = kosar
          .map(item => `<li>${item.nev} - ${item.ar} Ft/nap</li>`)
          .join("");
      }
      // Frissítjük a rejtett input mezőt a foglalás űrlapon
      document.getElementById("foglalas-autonev-hidden").value = kosar.map(item => item.nev).join(", ");
    }
    
    // A vélemény és kapcsolat funkciókat itt is megtalálhatod (a korábbi kód szerint)
    function velemenyHozzaadasa() {
      const autoNev = document.getElementById("velemeny-autonev").value;
      const szoveg = document.getElementById("velemeny-szoveg").value;
      if (autoNev && szoveg) {
        // Itt AJAX-kéréssel lehetne elküldeni a véleményt a szervernek, de most csak frissítjük a DOM-ot.
        const lista = document.getElementById("velemenyek-lista");
        lista.innerHTML += `<p><strong>${autoNev}</strong>: ${szoveg}</p>`;
        alert("Köszönjük a véleményed!");
        document.getElementById("velemeny-urlap").reset();
      } else {
        alert("Kérjük, tölts ki minden mezőt!");
      }
    }
    function kapcsolatHozzaadasa() {
      const nev = document.getElementById("kapcsolat-nev").value;
      const email = document.getElementById("kapcsolat-email").value;
      const uzenet = document.getElementById("kapcsolat-uzenet").value;
      if (nev && email && uzenet) {
        alert(`Köszönjük, ${nev}! Válaszunkat hamarosan elküldjük.`);
        document.getElementById("kapcsolat-urlap").reset();
      } else {
        alert("Kérjük, tölts ki minden mezőt!");
      }
    }
  </script>
  
  <?php
    // Visszajelzés URL paraméterek alapján
    if (isset($_GET['regisztracio']) && $_GET['regisztracio'] == 1) {
      echo "<p style='text-align:center; color:green;'>Sikeres regisztráció!</p>";
    }
    if (isset($_GET['bejelentkezes']) && $_GET['bejelentkezes'] == 1) {
      echo "<p style='text-align:center; color:green;'>Sikeres bejelentkezés!</p>";
    }
    if (isset($_GET['kijelentkezes']) && $_GET['kijelentkezes'] == 1) {
      echo "<p style='text-align:center; color:green;'>Sikeres kijelentkezés!</p>";
    }
  ?>
</body>
</html>
