import "./dropdown-list.scss"

export default () => ({
    open: false,
    root: {
        [":class"]: "open && 'open'",
        ["@click.outside"]() {
            this.open = false
        }
    },
    current: {
        ["@click"]() {
            this.open = true
        }
    },
    values: {
        ["@click"]() {
            this.open = false
        }
    }
})