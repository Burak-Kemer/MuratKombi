# Murat Kombi — Website

Premium industrial-technical service website for Murat Kombi, built by Atlas Game Studio.

## Stack

- HTML5 / CSS3 / Vanilla JavaScript — no framework, no build tool, no external libraries.
- IntersectionObserver-based scroll reveal (no animation library).
- Mobile-first, SEO-oriented semantic markup.

## Structure

```
index.html          Homepage
hizmetler.html       Service detail page
hakkimizda.html      About (kept intentionally short — no invented history)
iletisim.html        Contact
assets/css/          base/ (reset, tokens, typography, global) → layout/ → components/ → pages/
assets/js/           config/business.js (single source of truth for contact data) → modules/ → main.js
assets/images/       hero/ (swap point for the real/AI-generated hero photo), icons/
```

## Local development

No build step required — serve the folder statically, e.g.:

```
npx serve .
```

or use VS Code's Live Server extension, then open `index.html`.

## Content status — verified vs. placeholder

**Verified (from the client's WhatsApp business profile):**
- Business name: Murat Kombi
- Services: Kombi, Kazan, Hidrofor, Dalgıç Motorları
- Phones: 0539 881 58 92 (mobile / WhatsApp), 0212 630 62 65 (landline)

**Not yet provided — intentionally omitted from the UI (no invented facts):**
- Address, opening hours, email, social links, certifications, years in business, customer/employee counts, pricing, testimonials.
- These sections do not render at all rather than showing visible placeholder text to the client. Add them once the client provides real data.

**Known follow-ups before launch:**
- `assets/js/config/business.js` is the single source of truth for phone/WhatsApp links — if a number changes, update it there (and the matching static text in each HTML file, which serves as the no-JS/SEO fallback).
- The hero now uses the client-approved production photo (`assets/images/hero/hero-photo.{avif,webp,jpg}`, sourced from `hero-source.png`). If real client photography arrives later, re-export all three formats at the same 1376×768 dimensions and re-check the mobile/tablet `object-position` and vignette in `assets/css/pages/home.css` against the new composition — they're tuned to the current photo's subject placement.
- `https://example.com` is used as a placeholder canonical/OG domain (marked with `TODO:` comments) until a real domain is registered.
- `assets/images/icons/favicon.svg` is the only favicon asset — no image-rasterization tool was available to produce `apple-touch-icon.png`/`favicon.ico`. Add PNG variants before launch for iOS "Add to Home Screen" support.
- `assets/fonts/` is currently unused (system font stack). Add a licensed webfont here if the brand direction calls for one later.
