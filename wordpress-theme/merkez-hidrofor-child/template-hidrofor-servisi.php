<?php
/**
 * Template Name: Hidrofor Servisi
 *
 * Optional page template — NOT auto-applied to any existing page. The client
 * assigns this later via Page Attributes > Template on the existing
 * /hidrofor-servisi/ page (a metadata choice in wp-admin, not a content edit —
 * the page's URL/slug/DB row are untouched).
 *
 * SEO intent: "Hidrofor Servisi / Hidrofor Tamiri / 7/24" (commercial intent —
 * hidrofor servisi, hidrofor tamiri, hidrofor bakım, hidrofor arıza, 7/24 hidrofor
 * servisi). Content below is general, verifiable hydrophore-system knowledge —
 * no invented warranty/price/technician-count claims.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$mh_business = merkez_hidrofor_business();
$mh_call     = $mh_business['primary_call'];
$mh_whatsapp = $mh_business['whatsapp'];

merkez_hidrofor_breadcrumbs();
?>

<header class="page-header container">
	<p class="eyebrow"><?php echo esc_html( $mh_business['service_area'] ); ?> · <?php echo esc_html( $mh_business['hours'] ); ?></p>
	<h1 class="page-header__title">Hidrofor Servisi — Hidrofor Tamiri, Bakım ve Arıza Onarımı</h1>
	<p class="page-header__lede">
		<?php echo esc_html( $mh_business['service_area'] ); ?>'nda hidrofor sistemlerinde arıza tespiti, bakım ve onarım hizmeti veriyoruz.
		<?php echo esc_html( $mh_business['founded'] ); ?>'den beri sektördeyiz, <?php echo esc_html( $mh_business['experience'] ); ?> tecrübeyle <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Hidrofor Nedir?</h2>
			<p>Hidrofor, şehir şebekesinden gelen suyun basıncının yetersiz kaldığı apartman, site, iş yeri ve müstakil binalarda suyu bir pompa ve tank sistemi yardımıyla basınçlandırarak üst katlara ve uzak noktalara düzenli şekilde ulaştıran sistemdir. Bir veya birden fazla pompa, bir genleşme (hidrofor) tankı ve pompaları otomatik olarak devreye alan bir basınç şalterinden oluşur.</p>
		</div>

		<div>
			<h2>Sık Karşılaşılan Hidrofor Arızaları</h2>
			<ul>
				<li>Su basmıyor veya basınç düşük geliyor</li>
				<li>Pompa sürekli çalışıyor, durmuyor</li>
				<li>Pompa hiç çalışmıyor</li>
				<li>Su geliyor gidiyor, basınç dalgalanıyor</li>
				<li>Pompa aşırı ses veya titreşim yapıyor</li>
				<li>Motor koruma sigortası sık sık atıyor</li>
			</ul>
		</div>

		<div>
			<h2>Hidrofor Neden Basınç Yapmıyor?</h2>
			<p>Basınç düşüklüğünün en sık görülen nedenleri: pompa motorunda güç kaybı veya aşınma, çek valfin tam kapanmaması nedeniyle suyun geri kaçması, boru veya bağlantılardaki gizli bir kaçak, genleşme tankındaki hava/su dengesinin bozulması, basınç şalterinin ayarının kaçması veya arızalanması, ve filtre/süzgeç tıkanıklığıdır. Kesin neden, yerinde yapılan teknik incelemeyle netleşir.</p>
		</div>

		<div>
			<h2>Hidrofor Neden Sürekli Çalışıyor?</h2>
			<p>Pompanın durmadan çalışması genellikle şu nedenlerden kaynaklanır: genleşme tankının içindeki hava yastığının (membran) zayıflaması veya patlaması — bu durumda sistem her su kullanımında hemen basınç kaybeder ve pompa sık sık devreye girer; sistemde gözle görülmeyen bir su kaçağı; basınç şalterinin kontak noktalarının arızalanması; veya çek valfin tam kapanmaması.</p>
		</div>

		<div>
			<h2>Basınç Şalteri Sorunları</h2>
			<p>Basınç şalteri, pompayı önceden belirlenmiş alt ve üst basınç değerlerine göre otomatik olarak açıp kapatan parçadır. Şalter arızalandığında pompa hiç çalışmayabilir, sürekli çalışabilir veya istenmeyen basınç seviyelerinde devreye girebilir. Şalterin doğru ayarlanması ve kontak/yay mekanizmasının düzenli kontrolü, sistemin sağlıklı çalışması için önemlidir.</p>
		</div>

		<div>
			<h2>Genleşme Tankı Sorunları</h2>
			<p>Genleşme (hidrofor) tankı, içindeki hava yastığı sayesinde pompanın her su kullanımında devreye girmesini engeller. Tank içindeki membran zamanla yıpranabilir veya patlayabilir; hava basıncı azaldığında pompa normalden çok daha sık çalışmaya başlar. Tankın hava basıncının periyodik olarak kontrol edilmesi ve gerektiğinde membranın değiştirilmesi önerilir.</p>
		</div>

		<div>
			<h2>Pompa Motoru Sorunları</h2>
			<p>Pompa motorunda görülebilen tipik arızalar: elektrik sargısı yanması, rulman aşınması, mil sıkışması, kaplin veya conta sorunları, aşırı ısınma ve verim düşüklüğüdür. Bu tür arızalar genellikle yerinde teknik inceleme ve ölçüm gerektirir.</p>
		</div>

		<div>
			<h2>Hidrofor Bakımı</h2>
			<p>Düzenli bakım, ani arızaları önlemede önemli rol oynar. Bir hidrofor bakımı genellikle şunları kapsar: basınç şalterinin kontrolü, genleşme tankının hava basıncının kontrolü, pompa ve motorun kontrolü, filtre temizliği, sistemde kaçak kontrolü ve elektriksel bağlantıların gözden geçirilmesi.</p>
		</div>

		<div>
			<h2>Servis Sürecimiz</h2>
			<div class="process">
				<div class="process__step">
					<span class="process__number">01</span>
					<h3 class="process__title">Arayın</h3>
					<p class="process__desc">Telefon veya WhatsApp üzerinden bize ulaşın.</p>
				</div>
				<div class="process__step">
					<span class="process__number">02</span>
					<h3 class="process__title">Sorunu Anlatalım</h3>
					<p class="process__desc">Hidrofor arızasını veya ihtiyacınızı kısaca aktarın.</p>
				</div>
				<div class="process__step">
					<span class="process__number">03</span>
					<h3 class="process__title">Teknik İnceleme</h3>
					<p class="process__desc">Sistem yerinde incelenerek arıza netleştirilir.</p>
				</div>
				<div class="process__step">
					<span class="process__number">04</span>
					<h3 class="process__title">Çözüm</h3>
					<p class="process__desc">Uygun bakım veya onarım çözümü uygulanır.</p>
				</div>
			</div>
		</div>

		<div>
			<h2><?php echo esc_html( $mh_business['hours'] ); ?> Hidrofor Servisi</h2>
			<p><?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['hours'] ); ?> hidrofor arıza ve teknik servis desteği veriyoruz.</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde hizmet veriyoruz.</p>
		</div>

		<div>
			<h2>Sık Sorulan Sorular</h2>

			<h3>7/24 hizmet veriyor musunuz?</h3>
			<p>Evet, <?php echo esc_html( $mh_business['hours'] ); ?> hidrofor arıza ve servis desteği sağlıyoruz.</p>

			<h3>Hangi marka hidrofor pompalarına servis veriyorsunuz?</h3>
			<p><?php echo esc_html( implode( ', ', $mh_business['brands'] ) ); ?> markalarında teknik servis desteği veriyoruz.</p>

			<h3>Arıza ne kadar sürede giderilir?</h3>
			<p>Süre, arızanın türüne ve kapsamına göre değişir; kesin süre yerinde yapılan teknik inceleme sonrası netleşir.</p>

			<h3>Hangi bölgelere hizmet veriyorsunuz?</h3>
			<p><?php echo esc_html( $mh_business['service_area'] ); ?>'nda, aralarında <?php echo esc_html( implode( ', ', array_slice( $mh_business['service_districts'], 0, 6 ) ) ); ?> ve diğer ilçelerin bulunduğu geniş bir bölgeye hizmet veriyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services( 'hidrofor-servisi' ); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Hidrofor Arızanız İçin Hemen Arayın', 'merkez-hidrofor-child' ); ?></h2>
			<div class="cta-band__phones">
				<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="cta-band__phone">
					<?php merkez_hidrofor_the_icon( 'phone' ); ?>
					<?php echo esc_html( $mh_call['label'] ); ?>
				</a>
			</div>
			<div class="cta-band__actions">
				<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="btn btn--danger"><?php esc_html_e( 'Hemen Ara', 'merkez-hidrofor-child' ); ?></a>
				<a href="<?php echo esc_url( $mh_whatsapp['href'] ); ?>" class="btn btn--secondary" target="_blank" rel="noopener"><?php esc_html_e( "WhatsApp'tan Ulaş", 'merkez-hidrofor-child' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
