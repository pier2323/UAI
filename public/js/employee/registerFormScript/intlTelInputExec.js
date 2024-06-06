// todo execute the library for phones (INTLTELINPUT)
import es from "../../intlTelInput/es/index.mjs";
const $phoneNumber = document.querySelector("#recipient-phoneNumber");
window.intlTelInput($phoneNumber, {
    i18n: es,
    utilsScript: "/js/intlTelInput/utils.js",
    initialCountry: "ve",
    nationalMode: false,
});