/* Single source of truth for verified business/contact data.
   Update phone numbers here — contact-bind.js re-syncs every [data-contact] element on load.
   Static HTML already carries these same values as a no-JS/SEO-safe fallback; keep both in sync
   when numbers change. Fields left null are not yet provided by the client — do not invent values. */

export const BUSINESS = {
  name: "Murat Kombi",
  phones: {
    mobile: { number: "0539 881 58 92", href: "tel:+905398815892" },
    landline: { number: "0212 630 62 65", href: "tel:+902126306265" },
  },
  whatsapp: {
    number: "0539 881 58 92",
    href: "https://wa.me/905398815892",
  },
  services: ["Kombi", "Kazan", "Hidrofor", "Dalgıç Motorları"],
  address: null,
  hours: null,
  email: null,
  social: {
    instagram: null,
    facebook: null,
  },
};
