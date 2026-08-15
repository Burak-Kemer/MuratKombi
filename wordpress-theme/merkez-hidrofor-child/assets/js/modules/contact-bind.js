/* Re-syncs every [data-contact] element from the central business config.
   Static markup already shows correct values; this keeps future edits to a single file.
   On the static/demo site DATA is just the imported BUSINESS object. On the WordPress child
   theme, functions.php injects window.MerkezIsiBusiness (built from Customizer settings) before
   this module runs, so edits to phone/address/hours in wp-admin take effect with no code deploy. */

import { BUSINESS } from "../config/business.js";

const DATA = (typeof window !== "undefined" && window.MerkezIsiBusiness) || BUSINESS;

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
  const landlineMatch = /^phone-landline-(\d)$/.exec(key);
  if (landlineMatch) {
    const landline = DATA.phones.landlines[Number(landlineMatch[1]) - 1];
    return landline ? { href: landline.href, text: landline.number } : null;
  }

  switch (key) {
    case "phone-mobile":
      return { href: DATA.phones.mobile.href, text: DATA.phones.mobile.number };
    case "whatsapp":
      return { href: DATA.whatsapp.href, text: DATA.whatsapp.number };
    case "business-name":
      return { text: DATA.name };
    case "hours":
      return { text: DATA.hours };
    case "service-area":
      return { text: DATA.serviceArea };
    default:
      return null;
  }
}
