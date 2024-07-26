function card() {
    return {
        cards: [],
                    
        add() {
            this.cards.push({
                id: this.cards.length
            })
        },

        remove(start, end) {
            this.cards.splice(start, end)
        }
    }
}