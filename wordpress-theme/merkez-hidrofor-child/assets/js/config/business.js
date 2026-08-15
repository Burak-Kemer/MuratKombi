/* Single source of truth for verified business/contact data (P0 finalized 2026-08-15).
   Update phone numbers here — contact-bind.js re-syncs every [data-contact] element on load.
   Static HTML already carries these same values as a no-JS/SEO-safe fallback; keep both in sync
   when numbers change. Fields left null are not yet provided by the client — do not invent values.
   Brand corrected 2026-08-15: real customer-facing name is "Merkez Isı Teknik Servis"
   ("Murat Kombi" was an earlier working name and must not appear in production content). */

export const BUSINESS = {
  name: "Merkez Isı Teknik Servis",
  phones: {
    mobile: { number: "0539 881 58 92", href: "tel:+905398815892" },
    landlines: [
      { number: "0212 630 58 92", href: "tel:+902126305892" },
      { number: "0212 630 29 00", href: "tel:+902126302900" },
      { number: "0212 639 06 43", href: "tel:+902126390643" },
    ],
  },
  whatsapp: {
    number: "0539 881 58 92",
    href: "https://wa.me/905398815892",
  },
  services: ["Kombi", "Kazan", "Hidrofor", "Dalgıç Motorları", "Otomasyon"],
  address: {
    line: "Yenibosna Merkez Mahallesi, Yıldıztepe Sokak No: 8",
    district: "Bahçelievler",
    city: "İstanbul",
  },
  hours: "7/24",
  serviceArea: "İstanbul Avrupa Yakası",
  founded: 2001,
  experience: "25+ yıl",
  email: null,
  social: {
    instagram: null,
    facebook: null,
  },
};
