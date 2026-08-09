/* Mobile sticky call/WhatsApp bar: hidden over the top section (hero on the homepage,
   page-header on every other page), visible while scrolling the page, hidden again
   once the footer (which repeats the same actions) is in view. */

export function initStickyCta() {
  const bar = document.querySelector(".sticky-cta");
  const topSection = document.querySelector(".hero") || document.querySelector(".page-header");
  const footer = document.querySelector(".site-footer");
  if (!bar || !topSection) return;

  let topPassed = false;
  let footerVisible = false;

  const update = () => {
    bar.classList.toggle("is-visible", topPassed && !footerVisible);
  };

  const topObserver = new IntersectionObserver(
    ([entry]) => {
      topPassed = !entry.isIntersecting;
      update();
    },
    { threshold: 0, rootMargin: "-80% 0px 0px 0px" }
  );
  topObserver.observe(topSection);

  if (footer) {
    const footerObserver = new IntersectionObserver(
      ([entry]) => {
        footerVisible = entry.isIntersecting;
        update();
      },
      { threshold: 0 }
    );
    footerObserver.observe(footer);
  }
}
