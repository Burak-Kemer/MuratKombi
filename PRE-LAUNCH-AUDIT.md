# Merkez Isı Teknik Servis — Pre-Launch Audit

**Tarih:** 2026-08-15
**Kapsam:** Implementation sonrası, canlıya almadan önce ikinci doğrulama turu.
**Durum:** Sadece denetim. **Hiçbir production/hosting/DNS/database değişikliği yapılmadı, hiçbir redirect canlıda uygulanmadı.**

---

## 1. PASS

- **Marka/numara temizliği (statik + WordPress tema dosyaları):** Proje genelinde `Murat Kombi`, `444 78 06`, `0212 630 62 65`, `Merkez Hidrofor Isı Teknik Servis` için grep taraması yapıldı. Tek tespit edilen 3 eşleşme, hepsi kod yorumlarında ("bu isim artık kullanılmıyor" notu) — hiçbir üretim/render edilen içerikte yanlış marka veya eski numara yok.
- **Customizer tek-kaynak mimarisi:** `merkez_isi_get_business_data()` fonksiyonu tek veri kaynağı olarak doğrulandı. Bu fonksiyonu çağıran her yer izlendi: `header.php`, `footer.php`, `front-page.php`, `page.php`, `single.php`, `404.php`, `template-hizmetler.php`, `template-iletisim.php`, `template-parts/trust-bar.php`, `template-parts/cta-band.php`, `functions.php` (JS localization), `inc/schema.php`. **13/13 çağrı noktası aynı fonksiyona bağlı** — frontend, footer, header, CTA ve schema'nın farklı veri göstermesi mimarî olarak mümkün değil.
- **Escaping disiplini:** 15 PHP dosyasının tamamı satır satır yeniden incelendi. Kullanıcıya/veritabanına dayalı her dinamik değer `esc_html()`, her URL `esc_url()`, her HTML attribute `esc_attr()` ile çıkışa veriliyor. İstisna: SVG ikon path'leri escape edilmeden echo ediliyor, ama bunlar **sabit PHP string sabitleri** (kullanıcı girdisi değil, kodun kendisinde tanımlı) — her biri `// phpcs:ignore` yorumuyla gerekçelendirilmiş.
- **Nonce ihtiyacı:** Temada hiçbir form, POST handler, AJAX endpoint veya state-değiştiren aksiyon yok — sadece salt-okunur sayfa render'ı. **Nonce gereken hiçbir yer bulunamadı**, bu bir eksiklik değil.
- **Template hierarchy:** `front-page.php` (ana sayfa) → `page.php` (genel sayfa, `the_content()` ile) → `page-templates/*.php` (`Template Name:` header'ı ile WordPress'in otomatik algıladığı özel şablonlar) → `single.php` → `404.php` zinciri, standart WordPress template hierarchy kurallarına uygun. Alt klasördeki (`page-templates/`) şablonlar WordPress 4.7+'ta otomatik taranır, ek kayıt gerekmez.
- **Parent theme = "avril" — DOĞRULANDI (canlı kaynaktan).** Bkz. Bölüm 4.

## 2. FAIL

**Yok.** Bu turda kod içinde kesin bir hata (FAIL) tespit edilmedi. Aşağıdaki "NOT VERIFIED" maddeleri hata değil, **doğrulanamamış** alanlardır — production'a geçmeden önce mutlaka gerçek ortamda test edilmeli.

## 3. NOT VERIFIED

| Alan | Neden doğrulanamadı | Nasıl doğrulanır |
|---|---|---|
| PHP syntax (gerçek yorumlayıcı ile) | Bu ortamda PHP CLI yok (`php -l` çalıştırılamadı) | Staging'e yükleyip `php -l` veya sayfayı açıp WSOD/hata olup olmadığına bakılmalı |
| Elementor/sayfa oluşturucu varlığı | `wp-content/plugins/elementor/readme.txt` doğrudan denendi → **404** (muhtemelen yok, ama host güvenlik ayarı da dosya erişimini engelliyor olabilir, kesin değil) | wp-admin → Eklentiler listesi |
| `clever-fox` pluginin gerçek işlevi | Sadece bir görsel yolunda (`/wp-content/plugins/clever-fox/inc/avril/images/logo-2.png`) referansı bulundu, işlevi (sayfa oluşturucu mu, widget mı, Avril'in resmi eklentisi mi) belirlenemedi | wp-admin → Eklentiler listesi |
| `functions.php`'deki dequeue handle listesi (`avril-style`, `avril-fonts`, `elementor-frontend`, vb.) | Tahmini/yaygın isimlendirme kalıplarına dayanıyor, canlı sayfa kaynağından tek tek doğrulanmadı | Sayfa kaynağını görüntüle → her `<link>`/`<script>` handle'ını not al → dequeue listesini güncelle |
| WordPress çekirdek sürümü | Erişim yok | wp-admin → Panel |
| Mobil cihaz testi (iPhone/Android, Safari/Chrome mobile) | Gerçek cihaz/tarayıcı testi bu turda yapılmadı | Staging üzerinde gerçek cihazlarda test |
| Desktop tarayıcı testi (WordPress ortamında) | Bu tema hiç render edilmedi (canlı/staging yok) | Staging kurulumu sonrası |
| WordPress ortamında performans (Lighthouse/PageSpeed) | **NOT VERIFIED — REQUIRES STAGING.** Statik GitHub Pages skorları (97-100) referans alınamaz | Staging'de gerçek ölçüm |
| Telefon/WhatsApp linklerinin gerçek cihazda tıklanması | Sadece kod/URL formatı doğrulandı (`tel:+90...`, `https://wa.me/90...`), fiili tıklama testi yapılmadı | Gerçek cihazda test |
| Eski site sitemap/robots/canonical'ının yeni yapıyla çakışıp çakışmadığı | Eski sitenin GSC/Search Console verisine erişim yok | Google Search Console |

## 4. BLOCKERS

### 4.1 — Parent Theme: ÇÖZÜLDÜ (artık blocker değil)

Önceki turda "BLOCKER — PARENT THEME NOT VERIFIED" olarak işaretlenmişti. Bu turda **doğrudan kanıt toplandı**:

- `https://www.merkezhidrofor.com/wp-content/themes/avril/style.css` adresine doğrudan istek atıldı.
- Dönen dosya gerçek bir WordPress tema stylesheet header'ı içeriyor: `Theme Name: Avril`, `Version: 15.5`, `Author: Nayra Themes`, `Text Domain: avril`, `Template : avril`.
- Bu, child theme'in `style.css` dosyasındaki `Template: avril` satırının **doğru** olduğunu, tahmine değil gerçek bir dosyaya dayandığını gösteriyor.

**Kalan risk:** Bu doğrulama bir HTTP fetch aracıyla yapıldı (tarayıcı değil) — son derece düşük ihtimalle yanlış yorumlanmış olabilir. Canlıya almadan önce tarayıcıdan aynı URL'yi ziyaret ederek insan gözüyle bir kez daha teyit edilmesi önerilir, ama bu artık "kanıtsız varsayım" değil, "harici kaynaktan doğrulanmış, düşük riskli teyit" seviyesinde.

### 4.2 — Gerçek blocker'lar (canlıya almadan önce çözülmeli)

1. **PHP syntax hiçbir gerçek yorumlayıcıda test edilmedi.** Manuel satır satır inceleme yapıldı (Bölüm 1), ama bu bir garanti değil.
2. **Eski sitenin değerli içeriği (hidrofor pillar, 20 ilçe sayfası, dalgıç/Wilo içerikleri) yeni temaya taşınmadı.** Bkz. Bölüm 5 tablosu.
3. **Dequeue listesi doğrulanmamış** — yanlış handle'lar dequeue edilirse hiçbir şey kırılmaz (var olmayan handle'lar sessizce atlanır — kod bunu `wp_style_is()`/`wp_script_is()` kontrolüyle güvenli hale getirdi), ama **doğru handle'lar bulunamazsa** performans kazanımı elde edilmez.

## 5. Eski WordPress İçerikleri — Migrasyon Durumu

> Bu tabloda hiçbir aksiyon uygulanmadı — sadece mevcut durum ve gereken adımlar listelendi. Tam SEO VALUE / 301 kararları için bkz. `MURAT-KOMBI-SITE-AUDIT.md` Bölüm P0.5.

| OLD URL (kategori) | CURRENT STATUS | NEW TEMPLATE | CONTENT MIGRATION NEEDED | SEO ACTION |
|---|---|---|---|---|
| `/hidrofor-servisi/` (pillar, ~2.800 kelime) | Eski WP'de değişmeden duruyor | `page.php` (genel, `the_content()` render eder) | **Evet** — mevcut 2.800 kelimelik metin, yeni sayfa oluşturulup içine kopyalanmalı (veya mevcut sayfanın kendisi düzenlenip yeni temayı kullanmaya başlamalı) | KEEP |
| `/hidrofor-pompa-servisi/` | Değişmedi | `page.php` | GSC verisiyle duplicate teyidi sonrası karar | 301 (muhtemel, GSC'ye bağlı) |
| `/wilo-servisi/`, `/wilo-hidrofor-servisi/` | Değişmedi | `page.php` | Aynı, duplicate çift | KEEP (biri) + 301 (diğeri) |
| `/dalgic-pompa-tamiri/` (~1.800 kelime, Wilo/Grundfos/Ebara/Pedrollo marka isimleri) | Değişmedi | `page.php` | **Evet** — Dalgıç Motorları hizmetinin tek derin içeriği, taşınmalı | KEEP |
| 20 ilçe sayfası (Bahçelievler, Bağcılar, Başakşehir, vb. — audit P0.5) | Değişmedi | `page.php` | **Evet**, her biri için — ~1.200+ kelimelik mevcut metin korunmalı | KEEP (çoğu), bazıları 301 ile birleştirilecek |
| `/hakkimizda-2/` (gerçek içerik) | Değişmedi | `page.php` + Hakkımızda'ya özel trust-bar bloğu (otomatik, `is_page('hakkimizda')` kontrolü ile) | **Evet** — slug `hakkimizda` olarak ayarlanmalı ki child theme'in özel Hakkımızda mantığı tetiklensin | UPDATE |
| `/hakkimizda/` (Lorem Ipsum) | Değişmedi | — | Hayır (silinecek/yönlendirilecek) | 301 → gerçek Hakkımızda |
| `/markalar/` | Değişmedi | `page.php` | **Evet** — gerçek marka listesiyle (Wilo, Alarko, Grundfos, Dab, Pedrollo, Ayvaz, Ebara) doldurulmalı | UPDATE |
| `/iletisim-05398815892/` | Değişmedi | `page-templates/template-iletisim.php` (özel şablon) | Hayır (şablon zaten hazır, sadece sayfa özniteliklerinden atanmalı) | 301 → `/iletisim/` |
| Hizmetler karşılığı (eski sitede dedicated bir "hizmetler" sayfası yok) | — | `page-templates/template-hizmetler.php` | Hayır (şablon hazır, yeni sayfa oluşturulup atanmalı) | YENİ SAYFA |
| Silivri/Çatalca sayfaları | Değişmedi | `page.php` | Karar bekliyor | NO CHANGE (GSC verisi bekleniyor) |
| `/sample-page/` | Değişmedi | — | Hayır | REMOVE |
| — (Otomasyon, eski sitede karşılığı yok) | Yok | `page.php` veya yeni sayfa | **Evet** — sıfırdan oluşturulacak, yeni temanın Hizmetler şablonundaki jenerik Otomasyon metni referans alınabilir | YENİ SAYFA |

**Önemli:** Tabloda "CONTENT MIGRATION NEEDED: Evet" olan hiçbir satırda içerik bu turda taşınmadı veya silinmedi — sadece taşınması gerektiği tespit edildi.

## 6. URL / 301 Preflight — Gereken WordPress İşlemleri

Audit'teki (`MURAT-KOMBI-SITE-AUDIT.md` P0.5) KEEP/UPDATE/301/REMOVE/NO CHANGE kararlarının **uygulanması** için gereken WordPress-tarafı işlemler (henüz yapılmadı):

- **KEEP** kararlı URL'ler: Sayfa içeriği aynı slug'da kalacak, sadece görsel olarak yeni temaya (page.php) geçecek — WP tarafında ekstra bir "koruma" adımı gerekmez, slug değişmediği sürece URL zaten korunur.
- **UPDATE** kararlı URL'ler (örn. `/markalar/`, `/hakkimizda-2/`): Sayfa düzenlenip içerik güncellenecek, slug korunacak.
- **301** kararlı URL'ler (örn. `/hakkimizda/` → `/hakkimizda-2/`, duplicate çiftler): WordPress'te ya bir yönlendirme eklentisi (örn. Redirection) ya da `.htaccess`/host seviyesinde kural gerekir — **bu implementasyonun kapsamında değildi, hiçbiri kurulmadı/uygulanmadı**.
- **REMOVE** kararlı URL'ler (`/sample-page/`): Silinecek veya `noindex` + 301'e çevrilecek.
- **NO CHANGE** kararlı URL'ler (Silivri/Çatalca): Hiçbir şey yapılmayacak, GSC verisi beklenecek.

**GSC verisi olmadan** hiçbir duplicate çiftin (hidrofor-servisi/hidrofor-pompa-servisi, wilo-servisi/wilo-hidrofor-servisi) hangi tarafının kanonik olacağı hakkında kesin iddia üretilmedi — bu karar, gerçek trafik/index verisi görülmeden verilemez.

## 7. Elementor / Avril / Plugin Bağımlılıkları

| Öğe | Durum |
|---|---|
| Parent tema = Avril 15.5 | **VERIFIED** (doğrudan `style.css` fetch ile, Bölüm 4.1) |
| `avril` tema klasör slug'ı | **VERIFIED** |
| Elementor plugin varlığı | **UNVERIFIED** (readme.txt 404 döndü, ama kesin değil — host koruması olabilir) |
| `clever-fox` plugin varlığı | **VERIFIED var olduğu** (görsel yolunda referans bulundu), **UNVERIFIED işlevi** |
| `functions.php`'deki dequeue handle listesi | **UNVERIFIED** — tahmini isimlendirme, gerçek sayfa kaynağıyla teyit edilmedi |
| Diğer aktif pluginler (SEO, form, cache, vb.) | **UNVERIFIED** — hiçbiri tespit edilmedi/aranmadı |

**Sonuç:** `functions.php`'deki dequeue kodu **production-ready olarak işaretlenmiyor** — sadece "var olursa zararsızca devre dışı bırakır, yoksa hiçbir şey yapmaz" güvenli bir iskelet olarak işaretleniyor. Aktivasyondan önce gerçek handle'larla güncellenmesi gerekiyor.

## 8. Performance

**NOT VERIFIED — REQUIRES STAGING.**

Statik GitHub Pages skorları (Lighthouse 97-100) WordPress ortamı için referans kabul edilmiyor. WordPress'e özgü risk faktörleri:

- Avril parent teması kendi CSS/JS/font dosyalarını yükleyecek (child theme sadece üstüne ekleme yapıyor, parent'ın yükünü sıfırlamıyor).
- `clever-fox` pluginin performans etkisi bilinmiyor (işlevi doğrulanmadı).
- Gerçek WordPress veritabanı sorguları (özellikle `the_content()` ile render edilecek 2.800+ kelimelik sayfalar) statik HTML'den doğal olarak daha yavaş olacaktır — bu WordPress'in doğası, bir hata değil.
- Font/görsel optimizasyonu (statik sitedeki AVIF/WebP hero görseli) child theme'e aynen taşındı, bu kısım korunuyor.
- Gerçek ölçüm ancak staging/canlı ortamda mümkün.

## 9. Mobil / Responsive

**Gerçek cihaz testi yapılmadı.** Test edilmesi gerekenler (hiçbiri bu turda tamamlanmadı):

- [ ] iPhone (Safari mobile)
- [ ] Android (Chrome mobile)
- [ ] Sticky CTA bar (görünürlük, safe-area, buton boyutu)
- [ ] Mobil menü (hamburger, drawer açma/kapama)
- [ ] Hero görsel/metin çakışması (önceki oturumda statik sitede test edilmişti, WordPress ortamında yeniden test edilmedi)
- [ ] Footer okunabilirliği
- [ ] WhatsApp linki (gerçek cihazda WhatsApp uygulamasını açıyor mu)
- [ ] `tel:` linki (gerçek cihazda arama ekranını açıyor mu)
- [ ] `env(safe-area-inset-bottom)` — çentikli/Dynamic Island cihazlarda sticky bar

## 10. Staging Planı

```
BACKUP
  ↓ (WordPress veritabanı + dosya sistemi tam yedeği)
STAGING / TEST ORTAMI
  ↓ (hosting sağlayıcının staging özelliği veya ayrı bir alt domain/klasör)
CHILD THEME INSTALL
  ↓ (wordpress-theme/merkez-hidrofor-child/ klasörünü wp-content/themes/ altına yükle — henüz aktive etme)
PARENT THEME DOĞRULAMA
  ↓ (Bölüm 4.1'de bulunan "avril" slug'ının staging'de de aynı olduğunu teyit et)
THEME TEST
  ↓ (child theme'i staging'de aktive et, WSOD/hata var mı kontrol et, php -l ile syntax doğrula)
CONTENT TEST
  ↓ (Bölüm 5 tablosundaki içerikleri taşı, her sayfanın doğru şablonu kullandığını kontrol et)
SEO TEST
  ↓ (title/meta/schema/canonical/sitemap/robots kontrolü, Search Console'a staging'i göndermeden)
MOBILE TEST
  ↓ (Bölüm 9 checklist'i)
CTA TEST
  ↓ (tüm tel:/wa.me linkleri, sticky bar, tüm sayfalarda)
301 TEST
  ↓ (staging'de redirect'leri kur ve test et, GSC verisiyle son kararları teyit ederek)
FINAL BACKUP
  ↓ (staging onaylandıktan hemen önce son bir yedek)
PRODUCTION
```

**Bu implementasyon şu an "CHILD THEME INSTALL" adımının hemen öncesinde** — dosyalar hazır, henüz hiçbir sunucuya yüklenmedi.

## 11. Canlıya Alma Blockerları — Checklist

- [x] Parent theme doğrulandı — **PASS** (Bölüm 4.1, doğrudan kaynak fetch ile)
- [ ] Child theme PHP syntax doğrulandı — **NOT VERIFIED** (manuel review yapıldı, gerçek yorumlayıcı testi yok)
- [x] WordPress template hierarchy doğrulandı — **PASS** (mimari statik olarak doğru kurulu)
- [x] Customizer doğrulandı — **PASS** (tek kaynak, tüm çağrı noktaları izlendi)
- [x] Schema doğrulandı — **PASS** (kod seviyesinde doğru, ama gerçek bir sayfada render edilip Google Rich Results Test ile denenmedi — bu da ayrıca **NOT VERIFIED**)
- [x] Eski SEO URL'leri planlandı — **PASS** (Bölüm 5 tablosu)
- [x] 301 planı hazır — **PASS** (audit P0.5'te tam tablo, henüz uygulanmadı)
- [x] Eski önemli içerikler planlandı — **PASS** (taşınmadı ama plan net)
- [ ] Elementor/parent theme bağımlılıkları doğrulandı — **NOT VERIFIED** (sadece parent theme doğrulandı, plugin/dequeue listesi değil)
- [ ] Mobil test yapıldı — **NOT VERIFIED**
- [ ] Telefon test edildi — **NOT VERIFIED** (kod doğru, cihazda denenmedi)
- [ ] WhatsApp test edildi — **NOT VERIFIED**
- [ ] Desktop test edildi — **NOT VERIFIED** (WordPress ortamında hiç render edilmedi)
- [ ] Performance test edildi — **NOT VERIFIED — REQUIRES STAGING**
- [ ] Sitemap kontrol edildi — **NOT VERIFIED** (yeni WP sitemap'i henüz yok, eski sitenin sitemap_index.xml'i hâlâ geçerli ama yeni yapıyla güncellenmedi)
- [ ] Robots kontrol edildi — **NOT VERIFIED** (WordPress tarafı, dokunulmadı)
- [ ] Canonical kontrol edildi — **NOT VERIFIED** (WordPress tarafı, child theme'de canonical mantığı hiç eklenmedi — WordPress'in kendi varsayılan `rel_canonical()` fonksiyonu `wp_head()` üzerinden zaten çalışır, ama bu doğrulanmadı)
- [ ] Backup planı hazır — **PASS (plan)** / **NOT VERIFIED (uygulama)** — plan Bölüm 10'da yazılı, henüz gerçek bir yedek alınmadı
- [ ] Staging test tamamlandı — **FAIL (henüz başlamadı)**

## SAFE TO PROCEED CHECKLIST

**Şu an canlıya geçmek için GÜVENLİ DEĞİL.** Sırasıyla önce şunlar tamamlanmalı:

1. WordPress veritabanı + dosya sistemi yedeği al.
2. Staging ortamı kur.
3. Child theme'i staging'e yükle, aktive et, gerçek PHP hata loguna bak.
4. Bölüm 5'teki içerikleri staging'de taşı.
5. Bölüm 9'daki mobil checklist'i staging'de tamamla.
6. Bölüm 7'deki dequeue listesini gerçek handle'larla güncelle.
7. 301'leri staging'de kur ve test et.
8. Son bir yedek al.
9. Ancak bundan sonra, kullanıcının açık onayıyla, production'a geç.

---

*Bu denetimde hiçbir production, hosting, DNS veya database değişikliği yapılmadı. Hiçbir redirect canlıda uygulanmadı.*
