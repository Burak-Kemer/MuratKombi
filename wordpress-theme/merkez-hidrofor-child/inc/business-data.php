<?php
/**
 * Single source of truth for Merkez Hidrofor / Merkez Isı business data.
 *
 * Update phone numbers, address, hours, etc. ONLY here. header.php, footer.php,
 * front-page.php and page.php all read from this file via merkez_hidrofor_business()
 * (see functions.php) — nothing else in the theme hardcodes contact details.
 *
 * 'email' stays null until the client provides a real address — never invent one.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'name'         => 'Merkez Hidrofor',
	'legal_name'   => 'Merkez Hidrofor / Merkez Isı',
	'founded'      => '2001',
	'experience'   => '25 yılı aşkın',
	'service_area' => 'İstanbul Avrupa Yakası',
	'hours'        => '7/24',

	'address'      => array(
		'line1' => 'Yenibosna Merkez Mahallesi',
		'line2' => 'Yıldıztepe Sokak No: 8',
		'line3' => 'Bahçelievler / İstanbul',
	),

	'email'        => null,

	'whatsapp'     => array(
		'label' => '0539 881 58 92',
		'href'  => 'https://wa.me/905398815892',
	),

	// Same number as WhatsApp (it's a real mobile line) — used for the primary
	// "Hemen Ara" call CTA in nav/hero/sticky-cta, mirroring how the original
	// static design used one mobile number for both call and WhatsApp actions.
	'primary_call' => array(
		'label' => '0539 881 58 92',
		'href'  => 'tel:+905398815892',
	),

	'phones'       => array(
		array( 'label' => '0212 630 58 92', 'href' => 'tel:+902126305892' ),
		array( 'label' => '0212 630 29 00', 'href' => 'tel:+902126302900' ),
		array( 'label' => '0212 639 06 43', 'href' => 'tel:+902126390643' ),
	),

	'services'     => array(
		'Hidrofor Servisi',
		'Pompa Servisi',
		'Kazan Servisi',
		'Brülör Servisi',
		'Kombi Servisi',
		'Beyaz Eşya Servisi',
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
		'Otomasyon',
	),

	'brands'       => array( 'Wilo', 'Alarko', 'Grundfos', 'DAB', 'Pedrollo', 'Ayvaz', 'Ebara' ),
);
