// Magyar változók
let velemenyek = [];
let kapcsolatValaszok = [];
let foglalasok = [];
let kosar = [];

// Vélemények hozzáadása és frissítése
function velemenyHozzaadasa() {
    const autoNev = document.getElementById("velemeny-autonev").value;
    const szoveg = document.getElementById("velemeny-szoveg").value;

    if (autoNev && szoveg) {
        velemenyek.push({ autoNev, szoveg });
        frissitVelemenyek();
        alert("Köszönjük a véleményed!");
        document.getElementById("velemeny-urlap").reset();
    } else {
        alert("Kérjük, tölts ki minden mezőt!");
    }
}

function frissitVelemenyek() {
    const lista = document.getElementById("velemenyek-lista");
    if (velemenyek.length === 0) {
        lista.innerHTML = "<p>Még nincs vélemény. Légy te az első!</p>";
    } else {
        lista.innerHTML = velemenyek
            .map(velemeny => `<p><strong>${velemeny.autoNev}</strong>: ${velemeny.szoveg}</p>`)
            .join("");
    }
}

// Kapcsolatfelvételi űrlap kezelése
function kapcsolatHozzaadasa() {
    const nev = document.getElementById("kapcsolat-nev").value;
    const email = document.getElementById("kapcsolat-email").value;
    const uzenet = document.getElementById("kapcsolat-uzenet").value;

    if (nev && email && uzenet) {
        kapcsolatValaszok.push({ nev, email, uzenet });
        alert(`Köszönjük, ${nev}! Válaszunkat hamarosan elküldjük.`);
        document.getElementById("kapcsolat-urlap").reset();
    } else {
        alert("Kérjük, tölts ki minden mezőt!");
    }
}

// Kategória megjelenítése
function kategoriaMegjelenites(kategoriaId) {
    const kategoriak = ["gazdasagos", "csaladi", "luxus", "sport"];
    
    // Az összes kategória elrejtése
    kategoriak.forEach(id => {
        const kategoriaElem = document.getElementById(id);
        if (kategoriaElem) {
            kategoriaElem.style.display = "none";
        }
    });

    // Kiválasztott kategória megjelenítése
    const kivalasztottKategoria = document.getElementById(kategoriaId);
    if (kivalasztottKategoria) {
        kivalasztottKategoria.style.display = "block";
    }
}
// Alapértelmezett kategória betöltése
document.addEventListener("DOMContentLoaded", () => {
    kategoriaMegjelenites("gazdasagos");
});
// Foglalás hozzáadása
function foglalasHozzaadasa() {
    const autoNev = document.getElementById("foglalas-autonev").value;
    const datum = document.getElementById("foglalas-datum").value;
    const ido = document.getElementById("foglalas-ido").value;
    const nev = document.getElementById("foglalas-nev").value;
    const email = document.getElementById("foglalas-email").value;

    if (autoNev && datum && ido && nev && email) {
        const foglalas = {
            autoNev,
            datum,
            ido,
            nev,
            email
        };

        foglalasok.push(foglalas);
        frissitFoglalasok();
        alert("Foglalás sikeresen rögzítve!");
        document.getElementById("foglalas-urlap").reset();
    } else {
        alert("Kérjük, tölts ki minden mezőt!");
    }
}

// Vélemények hozzáadása és frissítése
function velemenyHozzaadasa() {
    const autoNev = document.getElementById("velemeny-autonev").value;
    const szoveg = document.getElementById("velemeny-szoveg").value;

    if (autoNev && szoveg) {
        velemenyek.push({ autoNev, szoveg });
        frissitVelemenyek();
        alert("Köszönjük a véleményed!");
        document.getElementById("velemeny-urlap").reset();
    } else {
        alert("Kérjük, tölts ki minden mezőt!");
    }
}

function frissitVelemenyek() {
    const lista = document.getElementById("velemenyek-lista");
    if (velemenyek.length === 0) {
        lista.innerHTML = "<p>Még nincs vélemény. Légy te az első!</p>";
    } else {
        lista.innerHTML = velemenyek
            .map(velemeny => `<p><strong>${velemeny.autoNev}</strong>: ${velemeny.szoveg}</p>`)
            .join("");
    }
}

// Kosár funkciók
function hozzaadKosarhoz(nev, ar) {
    kosar.push({ nev, ar });
    alert(`${nev} hozzáadva a kosárhoz!`);
    frissitKosar();
}

function frissitKosar() {
    console.log("Kosár tartalma:", kosar);
    const kosarLista = document.getElementById("kosar-lista");
    if (kosar.length === 0) {
        kosarLista.innerHTML = "<li>A kosár üres.</li>";
    } else {
        kosarLista.innerHTML = kosar
            .map(tetel => `<li>${tetel.nev} - ${tetel.ar} Ft/nap</li>`)
            .join("");
    }
}

// Foglalás kezelése
function foglalasKezelese() {
    const datum = document.getElementById("foglalas-datum").value;
    const ido = parseInt(document.getElementById("foglalas-ido").value, 10);
    const nev = document.getElementById("foglalas-nev").value;
    const email = document.getElementById("foglalas-email").value;

    if (!datum || !ido || !nev || !email || kosar.length === 0) {
        alert("Kérjük, tölts ki minden mezőt és adj hozzá autót a kosárhoz!");
        return;
    }

    const foglalas = {
        nev,
        email,
        datum,
        ido,
        autok: [...kosar],
        osszeg: kosar.reduce((sum, auto) => sum + auto.ar * ido, 0) // Teljes költség
    };

    foglalasok.push(foglalas);
    alert("Foglalás sikeresen rögzítve!");
    kosar = []; // Kosár ürítése
    frissitKosar();
    frissitFoglalasok();
    document.getElementById("foglalas-urlap").reset();
}

// Foglalások listájának frissítése
function frissitFoglalasok() {
    const foglalasLista = document.getElementById("foglalasok-lista").querySelector("ul");
    if (foglalasok.length === 0) {
        foglalasLista.innerHTML = "<li>Nincsenek foglalások.</li>";
    } else {
        foglalasLista.innerHTML = foglalasok
            .map(foglalas => `
                <li>
                    <strong>${foglalas.nev}</strong> (${foglalas.email})<br>
                    Időpont: ${foglalas.datum} - ${foglalas.ido} nap<br>
                    Autók: ${foglalas.autok.map(auto => `${auto.nev} (${auto.ar} Ft/nap)`).join(", ")}<br>
                    Összeg: ${foglalas.osszeg} Ft
                </li>
            `)
            .join("");
    }
}

// Oldal betöltésekor a kosár megjelenítése
document.addEventListener("DOMContentLoaded", () => {
    frissitKosar();
    frissitFoglalasok();
});


document.getElementById('regisztracio-gomb').addEventListener('click', function() {
    const regisztracio = document.getElementById('regisztracio');
    const belepes = document.getElementById('belepes');
    regisztracio.style.display = regisztracio.style.display === 'block' ? 'none' : 'block';
    belepes.style.display = 'none';
});

document.getElementById('belepes-gomb').addEventListener('click', function() {
    const regisztracio = document.getElementById('regisztracio');
    const belepes = document.getElementById('belepes');
    belepes.style.display = belepes.style.display === 'block' ? 'none' : 'block';
    regisztracio.style.display = 'none';
});


const regisztracioSzekcio = document.getElementById("regisztracio");
const belepesSzekcio = document.getElementById("belepes");
const overlay = document.getElementById("overlay");
const body = document.body;

// Overlay megjelenítése és görgetés letiltása
function mutatOverlay() {
    overlay.style.display = "block";
    body.style.overflow = "hidden"; // Görgetés letiltása
}

// Overlay elrejtése és görgetés engedélyezése
function elrejtOverlay() {
    overlay.style.display = "none";
    body.style.overflow = ""; // Görgetés visszaállítása
}

// Regisztráció megnyitása
function regisztracioMutatasa() {
    regisztracioSzekcio.style.display = "block";
    belepesSzekcio.style.display = "none";
    mutatOverlay();
}

// Belépés megnyitása
function belepesMutatasa() {
    belepesSzekcio.style.display = "block";
    regisztracioSzekcio.style.display = "none";
    mutatOverlay();
}

// Bezárás funkció
function zarasFelulet() {
    regisztracioSzekcio.style.display = "none";
    belepesSzekcio.style.display = "none";
    elrejtOverlay();
}

// Gombok események
document.getElementById("regisztracio-gomb").addEventListener("click", regisztracioMutatasa);
document.getElementById("belepes-gomb").addEventListener("click", belepesMutatasa);
overlay.addEventListener("click", zarasFelulet); // Ha az overlay-re kattintasz, zárja be az űrlapokat
