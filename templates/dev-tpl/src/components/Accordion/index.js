import "./accordion.scss"

export default (isOpen = false) => ({
    open: isOpen,
    init() {
        isOpen && this.show();
        this.$watch("open", (isOpen) => {
            isOpen ? this.show() : this.close();
        });
    },
    onSchedule(fn) {
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                fn();
            });
        });
    },
    show() {
        this.$refs.collapse.style.height = `${this.$refs.collapse.scrollHeight}px`;
        this.onSchedule(() => {
            this.$refs.collapse.classList.remove("is-collapsed");
            this.$refs.collapse.addEventListener(
                "transitionend",
                () => {
                    this.$refs.collapse.style.height = "";
                },
                { once: true }
            );
        });
    },
    close() {
        this.$refs.collapse.style.height = `${this.$refs.collapse.scrollHeight}px`;
        this.onSchedule(() => {
            this.$refs.collapse.classList.add("is-collapsed");
            this.$refs.collapse.style.height = "";
        });
    },
});
