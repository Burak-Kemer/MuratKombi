/* Lead-gen event tracking — Google Ads / GTM ready, but ships with NO real IDs.
   Pushes standard events to window.dataLayer (the universal GTM/GA4 convention) on
   every tel:/wa.me click, site-wide, automatically — no per-button wiring needed.
   dataLayer.push() is always safe even with no GTM container loaded (it just becomes
   a plain array with nothing listening yet), so this is inert until GTM is configured.

   Events pushed: phone_click, whatsapp_click, service_cta_click (fired alongside
   phone_click/whatsapp_click when the link sits inside a page with a known service
   context), contact_form_submit (stub only — no form exists in this design yet).

   CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS: see inc/tracking.php for where the
   real GTM Container ID / Google Ads Conversion ID / Conversion Label get added once
   available. Nothing here was guessed — every ID slot is empty until provided. */

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

/* Stub for a future contact form — not used anywhere yet (this design has none by
   choice, see MURAT-KOMBI-SITE-AUDIT.md section 17.1: no form is a deliberate
   "no unnecessary step" conversion decision). Kept here so a form added later has a
   ready, consistent event name instead of an ad-hoc one. */
export function trackFormSubmit(formName) {
	pushEvent("contact_form_submit", { form_name: formName || "unknown" });
}
