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

	/* Contact Form 7's real, documented success event (fires on `document`,
	   bubbled from the `.wpcf7` form wrapper — see inc/contact-form.php for
	   where the shortcode itself is rendered). Inert until the plugin is
	   actually installed and a real form exists: no listener ever fires, no
	   error either way, since this only *listens* for an event no code here
	   needs to trigger.

	   Deliberately does NOT read `event.detail.inputs` (CF7 puts the
	   submitted field values there, e.g. name/phone/message) — only the fact
	   that a submission succeeded is reported, never its content. If a
	   different form plugin is chosen instead of Contact Form 7, swap the
	   event name below for that plugin's own success event. */
	document.addEventListener("wpcf7mailsent", () => {
		trackFormSubmit("iletisim");
	});
}

/* Fires contact_form_submit with no personal data in the payload — just the
   form's identifying name, same shape as every other event in this file. */
export function trackFormSubmit(formName) {
	pushEvent("contact_form_submit", { form_name: formName || "unknown" });
}
