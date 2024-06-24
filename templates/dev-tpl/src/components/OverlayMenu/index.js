import "./overlay-menu.scss"

export default (model) => ({
    open: false,
    outsideClick(event) {
        if (event.target.matches(".menu-item, .menu-item *, .menu-burger, .menu-burger *, .overlay-menu .back, .overlay-menu .back *")) {
            return
        }

        this.open = false
    },
    root: {
        ['x-modelable']: "open",
        ['x-model']: model,
        ['@click.outside'](event) {
            this.outsideClick(event)
        },
        ['@click.self'](event) {
            this.open = false
        },
        [':class']: "open && 'active'"
    },
    back: {
        ['@click']() {
            this.open = false
            this.$store.mobileMenu.open = true
        }
    },
    close: {
        ['@click']() {
            this.open = false
            this.$store.mobileMenu.open = false
        }
    }
})