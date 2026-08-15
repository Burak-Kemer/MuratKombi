/* Lead-gen event tracking — Google Ads / GTM ready, but ships with NO real IDs.
   Pushes standard events to window.dataLayer (the universal GTM/GA4 convention) on
   every tel:/wa.me click, site-wide, automatically — no per-button wiring needed.
   dataLayer.push() is always safe even with no GTM container loaded (it just becomes
   a plain array with nothing listening yet), so this is inert until GTM is configured.

   This is the GitHub Pages test-deployment twin of the WordPress child theme's
   assets/js/modules/tracking.js (wordpress-theme/merkez-hidrofor-child/) — kept
   behaviorally identical so conversion tracking works the same way in both places.
   The WordPress version additionally has inc/tracking.php, which conditionally loads
   the actual GTM container script from a Customizer field; this static demo has no
   backend, so GTM loading (if ever needed here) would go directly in index.html's
   <head>, gated the same way: only if a real container ID exists.

   CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS — no GTM Container ID, Google Ads
   Conversion ID, or Conversion Label is hardcoded anywhere in this project yet. */

window.dataLayer = window.dataLayer || [];

function pushEvent(eventName, extra) {
  window.dataLayer.push(
    Object.assign(
      {
        event: eventName,
        page_path: window.location.pathname,
        page_title: document.title,
      },
      extra || {}
    )
  );
}

export function initTracking() {
  document.addEventListener("click", (evt) => {
    const link = evt.target.closest("a[href]");
    if (!link) return;

    const href = link.getAttribute("href");

    if (href.startsWith("tel:")) {
      pushEvent("phone_click", { phone_number: href.replace("tel:", "") });
      pushEvent("service_cta_click", { cta_type: "phone" });
    } else if (href.includes("wa.me")) {
      pushEvent("whatsapp_click", { whatsapp_number: href.split("wa.me/")[1] || "" });
      pushEvent("service_cta_click", { cta_type: "whatsapp" });
    }
  });
}

/* Stub for a future contact form — this design has none by choice (see
   MURAT-KOMBI-SITE-AUDIT.md section 17.1). Kept for a consistent event name if a
   form is ever added. */
export function trackFormSubmit(formName) {
  pushEvent("contact_form_submit", { form_name: formName || "unknown" });
}
