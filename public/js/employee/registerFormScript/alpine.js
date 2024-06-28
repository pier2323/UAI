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
        p00: null,
        personalId: "V-",
        // * functions
        transformedInput: (input) => input.replace(/[^a-zA-Z]/g, '').toUpperCase(),
        toggleMark: (marked) => {
            return {
                marked: !marked,
                valueInput: "",
            };
        },
        updateValue: (value) => {

            // * Agregar "V-" al principio
            if (!value.startsWith("V-") === true)
                return "V-";

            // * Limitar a 8 dígitos
            if (value.length > 8)
                return value.slice(0, 10);

            // * Eliminiar las letras y caracteres especiales 
            return "V-" + value.replace(/[^0-9]/g, '');
        },

        updatep00: (p00) => {
            // * Eliminiar las letras y caracteres especiales 

            if (p00.length > 5)
                return p00.slice(0, 6);

            return p00.replace(/[^0-9]/g, '');
        },
    };
}