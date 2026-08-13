/* Single entry point for every page. Site-wide behavior loads unconditionally;
   page-specific modules load only when their markup is present on the page.

   Ported from the MuratKombi static site's main.js with one change: the
   contact-bind module is dropped. That module existed to re-sync [data-contact]
   elements from a client-side JS config because the static site had no backend —
   in WordPress, inc/business-data.php renders the correct phone/WhatsApp values
   server-side already, so there is nothing left for it to sync. */

import { initNav } from "./modules/nav.js";
import { initReveal } from "./modules/reveal.js";

document.documentElement.classList.remove("no-js");

initNav();
initReveal();

if (document.querySelector(".sticky-cta")) {
  import("./modules/sticky-cta.js").then(({ initStickyCta }) => initStickyCta());
}
