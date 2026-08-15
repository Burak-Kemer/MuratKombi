# Merkez Isı Teknik Servis — Implementation Log

**Tarih:** 2026-08-15
**Kapsam:** Marka düzeltmesi (Murat Kombi → Merkez Isı Teknik Servis), P0 iletişim bilgisi güncellemesi, Otomasyon hizmeti eklenmesi, WordPress child theme inşası.
**Durum:** Implementation tamamlandı. **Canlıya alınmadı** — WordPress'e bağlanılmadı, hosting'e dosya gönderilmedi, DNS/production database'e dokunulmadı. Sadece local/proje dosyaları oluşturuldu.

---

## 1. Oluşturulan Dosyalar

**`IMPLEMENTATION-LOG.md`** (bu dosya).

**`wordpress-theme/merkez-hidrofor-child/`** — 15 yeni tema dosyası + 28 kopyalanan asset dosyası (toplam 43):
```
style.css
functions.php
header.php
footer.php
front-page.php
page.php
single.php
404.php
inc/customizer.php
inc/schema.php
page-templates/template-hizmetler.php
page-templates/template-iletisim.php
template-parts/page-header.php
template-parts/trust-bar.php
template-parts/cta-band.php
assets/  (css/ 17 dosya, js/ 5 dosya, images/ 5 dosya, ana repodan birebir kopyalandı)
```

## 2. Değiştirilen Dosyalar

| Dosya | Değişiklik |
|---|---|
| `index.html`, `hizmetler.html`, `hakkimizda.html`, `iletisim.html`, `404.html` | Tam yeniden yazıldı — marka, telefonlar, Otomasyon hizmeti, Avrupa Yakası/7-24 mesajları |
| `assets/js/config/business.js` | Marka adı, 3 sabit hat, adres, saat, kuruluş/tecrübe, 5 hizmet |
| `assets/js/modules/contact-bind.js` | 3 sabit hat desteği (`phone-landline-1/2/3`) + WordPress Customizer verisini (`window.MerkezIsiBusiness`) öncelikli okuma |
| `assets/css/layout/container.css` | `.grid--5` eklendi (5 hizmet kartı için) |
| `assets/css/components/trust-bar.css` | 5 öğeye göre breakpoint güncellendi |
| `assets/css/pages/contact.css` | `.contact-panel__lines`/`__line` eklendi (3 sabit hat için) |
| `assets/css/base/global.css` | `.prose` eklendi (WordPress `the_content()` çıktısı için okunabilir boşluklama) |
| `site.webmanifest` | Marka adı |
| `README.md` | Marka, doğrulanmış iletişim bilgileri, Beyaz Eşya notu güncellendi |
| `MURAT-KOMBI-SITE-AUDIT.md` | *(önceki turda)* P0 SONUÇ RAPORU bölümü eklendi — bu turda değiştirilmedi |

## 3. Silinen Dosyalar

**Yok.** Hiçbir dosya silinmedi.

## 4. Child Theme Yapısı

Bkz. Bölüm 1. Parent tema `avril` olarak varsayıldı (`style.css` header'ında `Template: avril`) — **bu, canlı sunucunun dosya sistemi görülmeden doğrulanamadı**, aktivasyondan önce `wp-content/themes/` içindeki gerçek klasör adıyla teyit edilmeli (style.css içinde büyük uyarı olarak not düşüldü).

Mimari kararlar:
- Tüm CSS/JS, statik tasarım referansından birebir kopyalandı, `functions.php` üzerinden `wp_enqueue_style/script` ile yüklendi.
- `main.js` bir ES module (`type="module"`) — `script_loader_tag` filtresiyle doğru tag üretiliyor (WordPress 6.5 öncesi uyumluluk için).
- Sayfa mimarisi: `front-page.php` (ana sayfa, sabit layout) + `page.php` (genel şablon, `the_content()` ile gerçek taşınmış içerik — örn. hidrofor-servisi pillar içeriği — buraya girecek) + `template-hizmetler.php`/`template-iletisim.php` (sabit layout şablonları, sayfa özniteliklerinden atanır).
- **Bilinçli sınır:** Bu tema, eski sitedeki 2.800 kelimelik hidrofor içeriğini veya 20 ilçe sayfasının metnini **içermiyor** — bu içerik WordPress veritabanında yaşıyor (bu implementasyonun erişimi yok), `page.php` sadece bunu yeni tasarımla render etmeye hazır. İçerik taşıma, ayrı bir adım (audit P0.5 tablosuna göre).

## 5. Customizer / CMS Alanları

`Görünüm → Özelleştir → İşletme Bilgileri` altında 13 alan: Firma Adı, Mobil/WhatsApp, Sabit Hat 1/2/3, WhatsApp Numarası, Adres (3 alan), Çalışma Saatleri, Hizmet Bölgesi, Kuruluş Yılı, Tecrübe. Hepsi `sanitize_text_field` ile temizleniyor, P0 verileriyle varsayılan değerlere sahip. Bu alanlar hem ön yüz JS'ine (`window.MerkezIsiBusiness`) hem JSON-LD schema'ya aynı kaynaktan (`merkez_isi_get_business_data()`) besleniyor — ikisi asla birbirinden farklı veri gösteremez.

## 6. Yeni Marka Uygulaması

"Merkez Isı Teknik Servis" — logo, header, hero H1, footer, tüm title/meta/OG/schema alanlarında kullanıldı. "Murat Kombi" ifadesi production içeriğinden temizlendi, sadece açıklayıcı yorumlarda ("bu isim artık kullanılmıyor" notu olarak) geçiyor — grep ile doğrulandı (Bölüm 9).

## 7. Hizmet Sayfaları

5 hizmet: Kombi, Kazan, Hidrofor, Dalgıç Motorları, **Otomasyon** (yeni). Otomasyon içeriği kasıtlı olarak jenerik — marka/model/başarı oranı gibi doğrulanmamış hiçbir detay eklenmedi (P0-3 talimatına uygun). Beyaz Eşya hiçbir yerde (menü, kart, schema) eklenmedi.

## 8. SEO Değişiklikleri

- Title/meta/OG tüm sayfalarda güncellendi, 5 hizmeti kapsıyor.
- `<title>`: "Merkez Isı Teknik Servis | Kombi, Kazan, Hidrofor, Dalgıç Motoru, Otomasyon"
- H1 (ana sayfa): "Merkez Isı Teknik Servis" (audit P0.4'teki nihai öneri, "Murat Kombi & Hidrofor..." kullanılmadı)
- `areaServed`: 23 Avrupa Yakası ilçesi (hem statik site hem WP schema'da)
- Statik sitenin `canonical`/OG URL'leri hâlâ `example.com` placeholder — bu bir statik demo/referans reposu, gerçek domain (`merkezhidrofor.com`) sadece WordPress'e taşınınca devreye girecek.

## 9. 301 Stratejisi

Bu implementasyon turunda **hiçbir 301 uygulanmadı** — WordPress'e bağlanılmadığı için uygulanacak bir yer yok. Strateji `MURAT-KOMBI-SITE-AUDIT.md` P0.5'te tam tablo olarak hazır, WordPress canlıya alma aşamasında GSC verisiyle teyit edilip uygulanacak.

## 10. Schema

`HVACBusiness` + `PostalAddress` + 23 `City` (`areaServed`) + 5 `Service` (`makesOffer`) + koşullu `OpeningHoursSpecification` (sadece kayıtlı saat "7/24" içeriyorsa) + `BreadcrumbList`. Hem statik `index.html`'de hem WP `inc/schema.php`'de birebir aynı yapı, gerçek P0 verisiyle.

## 11. Conversion Özellikleri

Sticky bar, hero CTA, hizmet kartı CTA'ları, footer CTA — hepsi güncel numaralara bağlandı. Buton metinleri "Şimdi Ara"/"WhatsApp'tan Yaz" (masaüstü/hero), "ŞİMDİ ARA"/"WHATSAPP" (mobil sticky bar, madde 12'deki talimata uygun). 3 sabit hat, tek büyük buton yerine ikincil/sade liste olarak sunuldu (audit P0.7 önerisi) — birincil CTA her yerde mobil/WhatsApp.

## 12. Mobil Sticky CTA

Değişmedi (zaten mevcuttu, doğru çalışıyordu) — sadece buton metinleri ve telefon numarası güncellendi. Responsive/erişilebilir/safe-area davranışı korundu.

## 13. Performans

Bu turda yeniden ölçülmedi (statik sitede görsel/font/JS mimarisine dokunulmadı, sadece 1 CSS dosyasına küçük `.prose` bloğu eklendi). WordPress tarafında performans riski hâlâ açık: Avril/Elementor'un gerçek enqueue edilen dosyaları bilinmediği için `functions.php`'deki dequeue listesi **doğrulanmamış tahminlerle** yazıldı — canlıya almadan önce gerçek handle'larla değiştirilmeli (dosya içinde büyük harflerle uyarılmış).

## 14. Test Sonuçları

**Otomatik test yapılamadı** — bu ortamda PHP CLI yok (`php -l` çalıştırılamadı), canlı/staging WordPress erişimi yok. Yapılan doğrulamalar:
- Statik sitede: proje geneli grep taraması ile eski marka/numara temizliği doğrulandı.
- WordPress tema dosyalarında: 15 PHP dosyasında basit brace-denge kontrolü (`{`/`}` sayımı) yapıldı, hepsi eşleşti — bu bir syntax garantisi değil, kaba bir sağlık kontrolü.
- `functions.php`, `inc/customizer.php`, `inc/schema.php` (en kritik 3 dosya — hata olursa tüm site çöker) satır satır manuel olarak yeniden okunup doğrulandı.
- Tarayıcıda gerçek render testi **yapılmadı** (statik site için bile bu turda Playwright/tarayıcı testi çalıştırılmadı — önceki oturumdaki Lighthouse sonuçları bu turda yeniden doğrulanmadı).

## 15. Kalan Sorunlar

- Parent tema adı (`avril`) doğrulanmadı — canlı sunucu dosya sistemi görülmeli.
- Dequeue edilecek Avril/Elementor script/style handle'ları tahmini — gerçek sayfa kaynağından teyit edilmeli.
- Eski sitenin gerçek içeriği (hidrofor-servisi 2.800 kelime, 20 ilçe sayfası) bu temaya **taşınmadı** — WordPress veritabanı erişimi bu implementasyonun kapsamı dışındaydı, ayrı bir migrasyon adımı gerekiyor.
- PHP syntax hiçbir yerde gerçek bir PHP yorumlayıcısıyla test edilmedi.
- Statik sitede gerçek tarayıcı/mobil testi bu turda yapılmadı.
- `wa.me`/`tel:` linkleri gerçek bir cihazda tıklanarak test edilmedi.

## 16. Canlıya Alma Öncesi Yapılması Gerekenler

1. Parent tema adını (`avril` mi değil mi) canlı sunucuda doğrula, gerekirse `style.css`'teki `Template:` satırını düzelt.
2. WordPress veritabanı + dosya sistemi tam yedeği al.
3. `functions.php`'deki dequeue listesini gerçek Avril/Elementor handle'larıyla güncelle.
4. Child theme'i staging ortamına yükle, PHP syntax hatası olup olmadığını gerçek bir WP kurulumunda doğrula.
5. Eski sitenin değerli içeriğini (audit P0.5 tablosundaki KEEP/UPDATE kararlı sayfalar) yeni sayfalara taşı.
6. Hizmetler ve İletişim sayfalarına ilgili custom page template'leri ata (Sayfa Özellikleri panelinden).
7. Tüm `tel:`/`wa.me` linklerini gerçek bir mobil cihazda test et.
8. 301 redirect'leri audit P0.5 tablosuna göre, GSC verisiyle teyit ederek uygula.
9. Lighthouse/mobil performans testini WordPress ortamında yeniden çalıştır.
10. Canlıya almadan önce kullanıcıdan açık onay al (bu implementasyon zaten "canlıya alma" adımını içermiyor, ayrı onay bekleniyor).

---

*Bu implementasyon, kullanıcının açık talimatı doğrultusunda canlı WordPress'e bağlanmadan, sadece proje dosyaları üzerinde yapılmıştır. Deploy/DNS/hosting işlemleri için ayrı onay gereklidir.*
