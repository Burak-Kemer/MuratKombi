<?php
/**
 * Static catalog data for Merkez Isı Teknik Servis (services/brands/districts/
 * known page slugs/Google rating) — the parts that don't change often and aren't
 * exposed as Customizer fields.
 *
 * Contact/identity fields that DO change (name, phones, address, hours, founded,
 * experience, service_area) moved to inc/customizer.php as of the 2026-08-15 P0
 * reconciliation — see merkez_hidrofor_business() in functions.php, which merges
 * this static array with merkez_hidrofor_customizer_data()'s Customizer-backed one.
 * Update phone numbers/address/hours in wp-admin → Customize, not here.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	// P0-3 (2026-08-15): Otomasyon is a confirmed new service — listed as "Otomasyon
	// Servisi" like the other named services, no fabricated technical detail (PLC
	// brand, control panel model, etc) added anywhere for it.
	// P0-4 (2026-08-15): Beyaz Eşya Servisi removed — not yet confirmed as an active
	// service; do not re-add without explicit confirmation from the business owner.
	'services'     => array(
		'Hidrofor Servisi',
		'Pompa Servisi',
		'Kazan Servisi',
		'Brülör Servisi',
		'Kombi Servisi',
		'Wilo Servisi',
		'Wilo Hidrofor Servisi',
		'Hidrofor Pompa Servisi',
		'Hidrofor Bakım',
		'Hidrofor Arıza',
		'Pompa Bakım ve Onarım',
		'Montaj',
		'Yedek Parça',
		'Basınç Şalteri',
		'Genleşme Tankı',
		'Kontrol Panosu',
		'Otomasyon Servisi',
	),

	'brands'       => array( 'Wilo', 'Alarko', 'Grundfos', 'DAB', 'Pedrollo', 'Ayvaz', 'Ebara' ),

	// Real, client-provided Google Business Profile snapshot (verbally confirmed,
	// matches the live GBP: "Merkez Isı - Hidrofor Pompa Servisi - Wilo Hidrofor
	// Servisi"). A plain UI trust badge only — never written into schema.org
	// Review/AggregateRating markup (that requires machine-verifiable review data,
	// not a hand-typed summary). Update this manually if the GBP score/count changes.
	'google_rating' => array(
		'score' => '4.8',
		'count' => '28',
	),

	// İstanbul Avrupa Yakası only, per the 2026-08-15 P0 source-of-truth's exact
	// 23-district list (MURAT-KOMBI-SITE-AUDIT.md P0.6/P0.7) — this supersedes the
	// prior list, which was drawn from the old site's already-indexed pages as found
	// during the initial (pre-P0) site audit and included Silivri/Çatalca (outside
	// today's confirmed scope) while missing Zeytinburnu and using "Eyüp" instead of
	// the current official "Eyüpsultan". Used for areaServed schema and
	// internal-linking/footer district mentions — NOT for auto-generating new
	// per-district pages (see template-ilce-servisi.php's doorway-content-risk note).
	'service_districts'  => array(
		'Bahçelievler', 'Bakırköy', 'Bağcılar', 'Güngören', 'Esenler', 'Başakşehir',
		'Küçükçekmece', 'Avcılar', 'Beylikdüzü', 'Büyükçekmece', 'Zeytinburnu',
		'Bayrampaşa', 'Fatih', 'Eyüpsultan', 'Kağıthane', 'Şişli', 'Beşiktaş',
		'Sarıyer', 'Beyoğlu', 'Gaziosmanpaşa', 'Sultangazi', 'Arnavutköy', 'Esenyurt',
	),

	// Known-stable core service page slugs (URL protection requirement — these must
	// never change). Used to build safe internal links via get_page_by_path(); if a
	// slug doesn't resolve to a real page, the link helper omits it rather than
	// pointing at a 404.
	'core_service_pages' => array(
		'hidrofor-servisi'       => 'Hidrofor Servisi',
		'wilo-servisi'           => 'Wilo Servisi',
		'hidrofor-pompa-servisi' => 'Hidrofor Pompa Servisi',
		'dalgic-pompa-tamiri'    => 'Dalgıç Pompa Tamiri',
		'otomasyon-servisi'      => 'Otomasyon Servisi',
	),
);
