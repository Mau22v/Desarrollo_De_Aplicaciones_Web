const horoscopos = document.querySelectorAll(".horoscopo");
const modal = document.getElementById("modal");
const modalTitle = document.getElementById("modal-title");
const modalInfo = document.getElementById("modal-info");
const closeBtn = document.querySelector(".close");

const infoHoroscopos = {
    Aries: "Aries es un signo de fuego, valiente y lleno de energía.",
    Tauro: "Tauro es un signo de tierra, paciente y confiable.",
    Géminis: "Géminis es aire, comunicativo y curioso.",
    Cáncer: "Cáncer es agua, sensible y protector.",
    Leo: "Leo es fuego, líder y carismático.",
    Virgo: "Virgo es tierra, analítico y perfeccionista.",
    Libra: "Libra es aire, equilibrado y sociable.",
    Escorpio: "Escorpio es agua, intenso y apasionado.",
    Sagitario: "Sagitario es fuego, aventurero y optimista.",
    Capricorniao: "Capricornio es tierra, disciplinado y responsable.",
    Acuario: "Acuario es aire, innovador y original.",
    Piscis: "Piscis es agua, soñador y empático."
};

horoscopos.forEach(h => {
    h.addEventListener("click", () => {
        const signo = h.querySelector("h3").textContent;

        modalTitle.textContent = signo;
        modalInfo.textContent = infoHoroscopos[signo];

        modal.style.display = "flex";
    });
});

closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});
