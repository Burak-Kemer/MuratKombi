/* Single entry point for every page. Site-wide behavior loads unconditionally;
   page-specific modules load only when their markup is present on the page. */

import { initNav } from "./modules/nav.js";
import { initReveal } from "./modules/reveal.js";
import { initContactBind } from "./modules/contact-bind.js";

document.documentElement.classList.remove("no-js");

initNav();
initReveal();
initContactBind();

if (document.querySelector(".sticky-cta")) {
  import("./modules/sticky-cta.js").then(({ initStickyCta }) => initStickyCta());
}
