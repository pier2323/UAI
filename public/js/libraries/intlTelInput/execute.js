// todo execute the library for phones (INTLTELINPUT)
import es from "./es/index.mjs";

const phone = document.querySelector("#phone");
window.intlTelInput(phone, {
    i18n: es,
    utilsScript: "/js/libraries/intlTelInput/utils.js?1716383386062",
    initialCountry: "ve",
});