import Alpine from "alpinejs";
import mask from '@alpinejs/mask';
Alpine.plugin(mask);

Alpine.magic("sessid", () => {
    return window.sessid
})

Alpine.magic("templatePath", () => {
    return window.templatePath
})

Alpine.magic("spritePath", () => {
    return window.spritePath
})

import ContactsMap from "./ContactsMap";
Alpine.data("ContactsMap", ContactsMap);

import PhoneInputMask from "./PhoneInputMask";
Alpine.data("PhoneInputMask", PhoneInputMask);

import SimpleSlider from "./SimpleSlider";
Alpine.data("SimpleSlider", SimpleSlider);

import FancyboxGallery from "./FancyboxGallery";
Alpine.data("FancyboxGallery", FancyboxGallery);

import Modal from "../components/Modal"
Alpine.data("Modal", Modal)

import OverlayMenu from "../components/OverlayMenu"
Alpine.data("OverlayMenu", OverlayMenu)

import Accordion from "../components/Accordion";
Alpine.data("Accordion", Accordion);

import DropdownList from "../components/DropdownList"
Alpine.data("DropdownList", DropdownList)

Alpine.store("mainMenu", {
    open: false,
});

Alpine.start();
