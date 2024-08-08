// todo Alpine JS object

function incoming() {
    return {
        isOpened: false,
        markedSecondName: false,
        markedSecondSurname: false,
  
        // * functions
        transformedInput: (input) => input.replace(/\s/g, "").toUpperCase(),

        toggleMark: (marked) => {
            return {
                marked: !marked,
                valueInput: "",
            };
        },
        
        updateValue: (value, limit) => {
            // * Limitar a 8 dígitos
            if (value.length > limit) return value.slice(0, limit);
            return value.replace(/[^0-9]/g, '');
        },
    };
}