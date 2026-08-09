/* Header behavior: shrink-on-scroll + accessible mobile drawer toggle. */

export function initNav() {
  const header = document.querySelector(".site-header");
  const toggle = document.querySelector(".nav__toggle");
  const drawer = document.querySelector(".nav__drawer");

  if (!header) return;

  const onScroll = () => {
    header.classList.toggle("is-scrolled", window.scrollY > 24);
  };
  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  if (!toggle || !drawer) return;

  const closeDrawer = () => {
    toggle.setAttribute("aria-expanded", "false");
    drawer.classList.remove("is-open");
    document.body.style.overflow = "";
  };

  const openDrawer = () => {
    toggle.setAttribute("aria-expanded", "true");
    drawer.classList.add("is-open");
    document.body.style.overflow = "hidden";
  };

  toggle.addEventListener("click", () => {
    const isOpen = toggle.getAttribute("aria-expanded") === "true";
    isOpen ? closeDrawer() : openDrawer();
  });

  drawer.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", closeDrawer);
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") closeDrawer();
  });
}
