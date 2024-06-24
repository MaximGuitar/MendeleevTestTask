import MicroModal from "micromodal";
import "./modal.scss"

const applyOffset = (offset) => {
    document.body.style.paddingRight = `${offset}px`;
};

function modalShow() {
    applyOffset(window.innerWidth - document.documentElement.clientWidth);
}
function modalClose(modal) {
    modal.addEventListener("animationend", () => applyOffset(0), { once: true });
}

const modalConfig = {
    onShow: modalShow,
    onClose: modalClose,
    awaitOpenAnimation: true,
    awaitCloseAnimation: true,
    disableFocus: true,
    disableScroll: true,
};

const showModal = (modalID) => MicroModal.show(modalID, modalConfig)
const closeModal = (modalID) => MicroModal.close(modalID, modalConfig)

export default () => ({
    close(modalID) {
        if (modalID == "self") {
            const modal = this.$root.closest(".modal")
            if (!modal)
                return

            modalID = modal.id
        }

        closeModal(modalID)
    },
    open(modalID) {
        if (modalID == "self") {
            const modal = this.$root.closest(".modal")
            if (!modal)
                return

            modalID = modal.id
        }

        showModal(modalID)
    }
})
