// todo Alpine JS object

function form() {
    return {
        firstName: null,
        secondName: null,
        markedSecondName: false,
        firstSurname: null,
        secondSurname: null,
        markedSecondSurname: false,
        labelPhoneNumber: null,
        phone: null,
        p00: null,
        personalId: null,
        // * functions
        transformedInput: (input) => {
            input = input.replace(/[^a-zA-Z]/g, "").toUpperCase()
            console.log(input)
            return input
        },
        toggleMark: (marked) => {
            return {
                marked: !marked,
                valueInput: "",
            };
        },
        updateValue: (value) => {
            // * Limitar a 8 dígitos
            if (value.length > 8) return value.slice(0, 8);

            // * Eliminiar las letras y caracteres especiales
            return value.replace(/[^0-9]/g, "");
        },

        updatep00: (p00) => {
            // * Eliminiar las letras y caracteres especiales

            if (p00.length > 6) return p00.slice(0, 6);

            return p00.replace(/[^0-9]/g, "");
        },
        updatephone: (phone) => {
            // * Eliminiar las letras y caracteres especiales

            if (phone.length > 7) return phone.slice(0, 7);

            return phone.replace(/[^0-9]/g, "");
        },
    };
}