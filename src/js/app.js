const DOM = document;
DOM.addEventListener("DOMContentLoaded", () => {
    eventListeners();
    darkmode();
});
// const Urladm = window.location.pathname;
// const containpropiedades = Urladm.includes('/admin/');

const listaCerrar = DOM.querySelectorAll(".cerrar");
Array.from(listaCerrar).forEach((cerrar) => {
    cerrar.addEventListener("click", () => {
        const alerta = cerrar.parentNode; //o pudo ser cerrar.closest('.alerta');
        alerta.style.display = "none";
    });
});

function eventListeners() {
    const mobileMenu = DOM.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click", navegacionResponsive);

    // Muestra campos condicionales
    const metodoContacto = DOM.querySelectorAll(
        'input[name="contacto[contacto]"]'
    );
    metodoContacto.forEach((input) =>
        input.addEventListener("click", mostrarMetodosContacto)
    );
}

function navegacionResponsive() {
    const nav = DOM.querySelector(".navegacion");

    nav.classList.toggle("mostrar");
}

function darkmode() {
    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

    if (prefiereDarkMode.matches) {
        DOM.body.classList.add("dark-mode");
    } else {
        DOM.body.classList.remove("dark-mode");
    }

    prefiereDarkMode.addEventListener("change", () => {
        if (prefiereDarkMode.matches) {
            DOM.body.classList.add("dark-mode");
        } else {
            DOM.body.classList.remove("dark-mode");
        }
    });

    const btnDarkMode = DOM.querySelector(".dark-mode-boton");

    btnDarkMode.addEventListener("click", () => {
        DOM.body.classList.toggle("dark-mode");
    });
}

function navActive() {
    const enlaces = DOM.querySelectorAll(".navegacion a");
    const URLactual = window.location.href;
    const containAnuncio = URLactual.includes("/anuncio/");
    enlaces.forEach((e) => {
        if (e.href == URLactual) {
            e.classList.add("active");
        }
    });
    if (URLactual == "http://bienes-raices.test/entrada") {
        enlaces[2].classList.add("active");
    }

    if (containAnuncio) {
        enlaces[1].classList.add("active");
    }
}

navActive();

function mostrarMetodosContacto(e) {
    const contactoDiv = DOM.querySelector("#contacto");

    if (e.target.value === "telefono") {
        contactoDiv.innerHTML = `
        <label for="telefono">Telefono:</label>
        <input type="tel" id="telefono" name="contacto[telefono]" placeholder="Ingresa tu telefono" autocomplete="off" required>

        <p>Elija la fecha y la hora para la llamada</p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]" autocomplete="off">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="contacto[hora]" autocomplete="off" min="09:00" max="18:00">
        `;
    } else {
        contactoDiv.innerHTML = '';
    }
    // else {
    //     contactoDiv.innerHTML = `
    //     <label for="email">E-mail:</label>
    //     <input type="email" id="email" name="contacto[email]" placeholder="Ingresa tu email" autocomplete="off" required>
    //     `;
    // }
}