/* Re-syncs every [data-contact] element from the central business config.
   Static markup already shows correct values; this keeps future edits to a single file. */

import { BUSINESS } from "../config/business.js";

export function initContactBind() {
  document.querySelectorAll("[data-contact]").forEach((el) => {
    const key = el.getAttribute("data-contact");
    const value = resolve(key);
    if (value == null) return;

    if (el.hasAttribute("href")) {
      el.setAttribute("href", value.href);
      if (value.text && el.hasAttribute("data-contact-text")) {
        el.textContent = value.text;
      }
    } else {
      el.textContent = value.text ?? value;
    }
  });
}

function resolve(key) {
  switch (key) {
    case "phone-mobile":
      return { href: BUSINESS.phones.mobile.href, text: BUSINESS.phones.mobile.number };
    case "phone-landline":
      return { href: BUSINESS.phones.landline.href, text: BUSINESS.phones.landline.number };
    case "whatsapp":
      return { href: BUSINESS.whatsapp.href, text: BUSINESS.whatsapp.number };
    case "business-name":
      return { text: BUSINESS.name };
    default:
      return null;
  }
}
