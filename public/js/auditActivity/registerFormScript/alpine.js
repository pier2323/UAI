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
        value: "V-",
        // * functions
        transformedInput: (input) => input.replace(/\s/g, "").toUpperCase(),
        toggleMark: (marked) => {
            return {
                marked: !marked,
                valueInput: "",
            };
        },
        updateValue: (value) => {
            // * Agregar "V-" al principio
            if (!value.startsWith("V-") === true || value == "V") return "V-";

            // * Limitar a 8 dígitos
            if (value.length > 8) return value.slice(0, 10);

            return value;
        },
    };
}