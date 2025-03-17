document.addEventListener("DOMContentLoaded", function() {
    /* KATEGÓRIA MEGJELENÍTÉSE */
    window.kategoriaMegjelenites = function(kategoriaId) {
        let kategoriak = document.getElementsByClassName("kategoria");
        for (let i = 0; i < kategoriak.length; i++) {
            kategoriak[i].style.display = "none";
        }
        let kivalasztott = document.getElementById(kategoriaId);
        if (kivalasztott) {
            kivalasztott.style.display = "block";
        }
    };

// Kosár inicializálása sessionStorage-ból
let kosar = JSON.parse(sessionStorage.getItem("kosar")) || [];
let felhasznaloNev = sessionStorage.getItem("felhasznaloNev") || "";
let felhasznaloEmail = sessionStorage.getItem("felhasznaloEmail") || "";

// Kosár mentése
function mentKosar() {
    sessionStorage.setItem("kosar", JSON.stringify(kosar));
}

// Kosár frissítése és megjelenítése
function frissitKosar() {
    const kosarLista = document.getElementById("kosar-lista");
    if (!kosarLista) return;

    kosarLista.innerHTML = "";

    if (kosar.length === 0) {
        kosarLista.innerHTML = "<li>A kosár üres.</li>";
    } else {
        kosar.forEach((item, index) => {
            let li = document.createElement("li");
            li.innerHTML = `${item.nev} - ${item.ar} Ft/nap - ${item.napok} nap 
            <button class="torles-gomb" data-index="${index}" style="border:none; background:none; cursor:pointer; font-size:16px; color:red;">❌</button>`;
            kosarLista.appendChild(li);
        });
    }

    // Frissítjük a foglalás rejtett mezőjét
    document.getElementById("foglalas-autonev-hidden").value = JSON.stringify(kosar);

    // Törlés gomb működés
    document.querySelectorAll(".torles-gomb").forEach(button => {
        button.addEventListener("click", function() {
            let index = this.getAttribute("data-index");
            kosar.splice(index, 1);
            mentKosar();
            frissitKosar();
        });
    });
}

// Autó hozzáadása a kosárhoz
window.hozzaadKosarhoz = function(autoNev, ar) {
    let foglalasiNapok = parseInt(document.getElementById("foglalas-ido").value) || 1;
    kosar.push({ nev: autoNev, ar: ar, napok: foglalasiNapok });
    mentKosar();
    frissitKosar();
    alert(`${autoNev} hozzáadva a kosárhoz ${foglalasiNapok} napra!`);
};

document.getElementById("foglalas-urlap").addEventListener("submit", function(event) {
    event.preventDefault(); // Megakadályozza az alapértelmezett küldést

    let foglalasiNapok = document.getElementById("foglalas-ido").value;
    sessionStorage.setItem("foglalasiNapok", foglalasiNapok); // Napok mentése

    alert("Foglalás rögzítve, számla generálása...");

    // Továbbirányítás a számla oldalra
    window.location.href = "szamla.html";
});



// Az oldal betöltésekor frissítjük a kosarat
document.addEventListener("DOMContentLoaded", frissitKosar);


    // Frissítjük a foglalás űrlapon lévő rejtett input mezőt
    let hiddenField = document.getElementById("foglalas-autonev-hidden");
    if (hiddenField) {
        hiddenField.value = JSON.stringify(kosar);
    }

    // Törlés gombokhoz event listener
    document.querySelectorAll(".torles-gomb").forEach(button => {
        button.addEventListener("click", function() {
            let index = this.getAttribute("data-index");
            kosar.splice(index, 1);
            mentKosar();
            frissitKosar();
        });
    });

    /* MODÁLIS ABLAKOK KEZELÉSE */
    let overlay = document.getElementById("overlay");
    let regisztracioElem = document.getElementById("regisztracio");
    let belepesElem = document.getElementById("belepes");

    let regisztracioGomb = document.getElementById("regisztracio-gomb");
    if (regisztracioGomb) {
        regisztracioGomb.addEventListener("click", function() {
            regisztracioElem.style.display = "block";
            belepesElem.style.display = "none";
            overlay.style.display = "block";
        });
    }

    let belepesGomb = document.getElementById("belepes-gomb");
    if (belepesGomb) {
        belepesGomb.addEventListener("click", function() {
            belepesElem.style.display = "block";
            regisztracioElem.style.display = "none";
            overlay.style.display = "block";
        });
    }

    function zarasFelulet() {
        if (regisztracioElem) regisztracioElem.style.display = "none";
        if (belepesElem) belepesElem.style.display = "none";
        if (overlay) overlay.style.display = "none";
    }

    if (overlay) {
        overlay.addEventListener("click", zarasFelulet);
    }

    /* VÉLEMÉNY HOZZÁADÁSA */
    window.velemenyHozzaadasa = function() {
        let autoNev = document.getElementById("velemeny-autonev").value;
        let szoveg = document.getElementById("velemeny-szoveg").value;
        if (autoNev && szoveg) {
            let lista = document.getElementById("velemenyek-lista");
            lista.innerHTML += `<p><strong>${autoNev}</strong>: ${szoveg}</p>`;
            alert("Köszönjük a véleményed!");
            document.getElementById("velemeny-urlap").reset();
        } else {
            alert("Kérjük, tölts ki minden mezőt!");
        }
    };

    /* KAPCSOLAT HOZZÁADÁSA */
    window.kapcsolatHozzaadasa = function() {
        let nev = document.getElementById("kapcsolat-nev").value;
        let email = document.getElementById("kapcsolat-email").value;
        let uzenet = document.getElementById("kapcsolat-uzenet").value;
        if (nev && email && uzenet) {
            alert(`Köszönjük, ${nev}! Válaszunkat hamarosan elküldjük.`);
            document.getElementById("kapcsolat-urlap").reset();
        } else {
            alert("Kérjük, tölts ki minden mezőt!");
        }
    };

});
