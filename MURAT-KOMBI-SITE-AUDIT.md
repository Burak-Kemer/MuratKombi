# Murat Kombi / Merkez Hidrofor — Site Audit ve Yenileme Operasyonu Raporu

**Tarih:** 2026-08-15
**Kapsam:** Eski canlı site (merkezhidrofor.com, WordPress), yeni frontend (MuratKombi, GitHub Pages statik site), WordPress child theme (planlanan), SEO/Local SEO/Conversion/Pazarlama denetimi.
**Durum:** Sadece analiz. Hiçbir dosya değiştirilmedi, hiçbir koda dokunulmadı.
**P0 Finalizasyonu:** 2026-08-15 — işletme sahibi (Murat) tarafından telefon, çalışma saatleri ve hizmet kapsamı doğrulandı. Aşağıdaki "P0 SONUÇ RAPORU" bölümü artık **SOURCE OF TRUTH**'tur ve raporun geri kalanındaki eski/çelişkili verilerin (özellikle Bölüm 10) yerini alır. Orijinal bulgular referans/kanıt amacıyla korunmuştur, silinmemiştir.

---

# P0 SONUÇ RAPORU (FINAL)

> Bu bölüm işletme sahibiyle doğrulanan bilgilere dayanır ve raporun geri kalanındaki tüm çelişkili/eski verilerin üzerine yazılır. **Bu bölümde de kod değiştirilmemiştir** — sadece strateji ve karar dokümantasyonudur.

## P0.1 — FINAL P0 DECISIONS

| Madde | Önceki durum (çelişkili) | Final karar | Etki alanı |
|---|---|---|---|
| Sabit hat | 3 farklı kaynak, hiçbiri örtüşmüyordu (Bölüm 10) | 3 hat da **aktif**: `0212 630 58 92`, `0212 630 29 00`, `0212 639 06 43` | Header, Hero, CTA, sticky bar, footer, iletişim, schema |
| Eski/hatalı numaralar | `444 78 06` (eski site), `0212 630 62 65` (yeni site) | **Kullanılmayacak**, hiçbir yerde gösterilmeyecek | Tüm sayfalar |
| WhatsApp | Zaten tutarlıydı | `0539 881 58 92` / `https://wa.me/905398815892` — değişmedi, teyit edildi | Tüm CTA'lar |
| Çalışma saatleri | Eski site "08:00-18:00 Pzt-Cuma" vs GÖREV4 "7/24" | **7/24** doğrulandı, eski saat bilgisi tamamen terk ediliyor | Header, Hero, CTA, hizmet sayfaları, footer, iletişim, schema `openingHours` |
| Hizmet kapsamı | 4 hizmet (Kombi/Kazan/Hidrofor/Dalgıç) | **5 hizmet** — Otomasyon eklendi | Hizmetler sayfası, ana sayfa kartları, nav, schema, SEO |
| Beyaz eşya | Eski sitede bullet-mention vardı, yeni sitede yoktu | **Şimdilik dışarıda kalıyor** — aktif hizmet olduğu doğrulanmadı | Menü/hizmetler/schema'ya eklenmeyecek |
| Adres | Eski site footer (Gaziosmanpaşa) vs iletişim sayfası (Bahçelievler) | **Bahçelievler** doğrulandı (GÖREV4 + eski site iletişim sayfası zaten örtüşüyordu) | Adres, schema, harita |
| Kuruluş/tecrübe | "20+ yıl" (eski site) vs "25+ yıl / 2001" (GÖREV4) | **2001 kuruluş, 25+ yıl** doğrulandı | Trust unsurları, Hakkımızda |

## P0.2 — CURRENT BUSINESS INFORMATION (Source of Truth)

| Alan | Değer |
|---|---|
| Firma | Murat Kombi / Merkez Hidrofor |
| Domain (mevcut, korunacak) | merkezhidrofor.com |
| WhatsApp | 0539 881 58 92 → `https://wa.me/905398815892` |
| Sabit hat 1 | 0212 630 58 92 → `tel:+902126305892` |
| Sabit hat 2 | 0212 630 29 00 → `tel:+902126302900` |
| Sabit hat 3 | 0212 639 06 43 → `tel:+902126390643` |
| Çalışma saatleri | 7/24 |
| Hizmet bölgesi | Sadece İstanbul Avrupa Yakası (Anadolu Yakası hariç) |
| Hizmetler | Kombi, Kazan, Hidrofor, Dalgıç Motorları, **Otomasyon** |
| Kapsam dışı (şimdilik) | Beyaz Eşya |
| Adres | Yenibosna Merkez Mahallesi, Yıldıztepe Sokak No: 8, Bahçelievler / İstanbul |
| Kuruluş | 2001 |
| Tecrübe | 25+ yıl |
| E-posta / Sosyal medya | Yok — uydurulmayacak |

**Not (tel: formatı):** GÖREV 4'te verilen numaralar `0212 630 58 92` gibi ulusal formatta yazılmış; `tel:` bağlantıları için uluslararası format (`+90...`, boşluksuz) kullanılması gerekiyor — yukarıdaki `tel:` değerleri bu dönüşümü örnekliyor, implementasyon aşamasında birebir bu şekilde kodlanmalı.

## P0.3 — SERVICE SCOPE

| # | Hizmet | Durum | İçerik kaynağı |
|---|---|---|---|
| 1 | Kombi Servisi | Aktif | Yeni site zaten kapsıyor |
| 2 | Kazan Servisi | Aktif | Yeni site zaten kapsıyor |
| 3 | Hidrofor Servisi | Aktif | Eski site pillar içerik (2.800 kelime) + 27 ilçe sayfası ile destekli |
| 4 | Dalgıç Motorları | Aktif | Eski site `/dalgic-pompa-tamiri/` (1.800 kelime) ile destekli |
| 5 | **Otomasyon** | **Yeni eklenen** | Eski sitede sadece ana sayfa gövde metninde tek bir madde olarak geçiyordu ("Otomasyon sistemleri kontrolü") — **kendi URL'i, kendi içeriği, kendi H1'i yoktu** |
| — | Beyaz Eşya | **Kapsam dışı (şimdilik)** | Eski sitede sadece ana sayfa gövde metninde bir madde olarak geçiyordu, kendi URL'i yoktu |

### Otomasyon içeriği — eski sitede ne var, ne yok

Eski sitenin 39 URL'lik tam envanterinde (Bölüm 2.3) "otomasyon" kelimesini taşıyan **hiçbir dedicated sayfa/slug bulunmuyor**. Tek referans, ana sayfanın hizmet listesindeki jenerik "Otomasyon sistemleri kontrolü" ifadesi. Bu nedenle:

| OLD URL | ACTION | NEW URL | REASON |
|---|---|---|---|
| Yok (sadece ana sayfa metninde madde) | **YENİ SAYFA** | `/otomasyon-servisi/` (öneri) | Redirect edilecek bir eski URL yok; sıfırdan, sadece doğrulanmış bilgiyle inşa edilecek |

**Uydurulmayacaklar (P0-3 talimatı gereği):** PLC markası, spesifik otomasyon sistemi/marka adı, kontrol paneli modeli, fabrika/proje referansı, başarı oranı, teknik özellik iddiası. Otomasyon sayfası içeriği, işletme sahibinden ek bilgi gelene kadar **jenerik ama doğru** kalmalı: "Isıtma/su sistemlerinde otomasyon kontrolü" gibi kapsayıcı, iddialı olmayan bir çerçevede. İçerik derinliği (H2 alt başlıkları, teknik detaylar) müşteriden ek bilgi geldiğinde genişletilebilir — audit aşamasında bu doğrulanmamış detaylarla doldurulmayacak.

### Beyaz Eşya — SEO değeri analizi (P0-4)

39 URL'lik envanterde beyaz eşyaya ait **hiçbir dedicated URL yok** — aynı otomasyon gibi, sadece ana sayfa gövde metninde bir madde. Sonuç: **korunacak/yönlendirilecek bir URL yok**, bu nedenle 301 stratejisi de gerekmiyor. Tek aksiyon: yeni ana sayfa metninden bu maddenin çıkarılması (bir URL kaybı değil, sadece bir cümle/bullet'ın kaldırılması). İleride işletme sahibi beyaz eşya hizmetini aktif olarak onaylarsa, o zaman sıfırdan yeni bir sayfa açılabilir — bugünkü audit'te bu karar için yeterli veri yok.

## P0.4 — SEO / URL PRESERVATION STRATEGY

**Ana marka/H1 önerisi (nihai):**

> **H1 (ana sayfa):** "Murat Kombi & Hidrofor Teknik Servisi"

**Gerekçe:** Domain'in (merkezhidrofor.com) kanıtlanmış tek büyük SEO varlığı "hidrofor" kelimesi — 2.800 kelimelik pillar sayfa + 27 ilçe sayfası bunun üzerine kurulu. Kazan/Dalgıç Motorları/Otomasyon'un eski sitede sıfır SEO geçmişi var (korunacak bir şey yok), bu yüzden H1'de yer kaplamalarına gerek yok. Marka artık resmi olarak "Murat Kombi" (bu bir iş kararı, SEO kararı değil, değiştirilemez) — ama H1'de "Hidrofor" kelimesini de tutmak, domain'in en güçlü on-page alaka sinyalini kaybetmeden marka geçişini yapmanın en düşük riskli yolu.

- **`<title>` (ana sayfa):** "Murat Kombi | Kombi, Kazan, Hidrofor, Dalgıç Motoru ve Otomasyon Teknik Servisi" — tüm 5 hizmeti sıralar, hidrofor öne yakın konumda kalır. (60 karakter sınırını aşıyor, implementasyonda kısaltma gerekebilir — örn. "Murat Kombi | Kombi, Hidrofor, Kazan, Dalgıç & Otomasyon Servisi"; kesin kopya build aşamasında netleşecek.)
- **Diğer hizmetlerin kendi sayfalarında** kendi H1'leri olacak (örn. Hidrofor sayfası H1: mevcut "Hidrofor Servisi – Kesintisiz Su İçin Profesyonel Destek" korunabilir) — ana sayfa H1'i tek başına tüm SEO yükünü taşımak zorunda değil.
- **Hidrofor içerik derinliğine dokunma** (Bölüm 7, madde 2 — değişmedi, hâlâ geçerli).
- **5 hizmetin dengeli konumlandırılması:** Ana sayfa hizmet kartları sırası mevcut yapıda zaten nötr (Kombi, Kazan, Hidrofor, Dalgıç Motorları sırayla eşit ağırlıkta) — Otomasyon 5. kart olarak aynı görsel ağırlıkla eklenmeli, "sonradan eklenmiş" gibi görünecek bir hiyerarşi farkı olmamalı.

## P0.5 — 301 REDIRECT TABLE (SEO Değeri ile Genişletilmiş)

> Bu tablo Bölüm 8'deki taslağı SEO VALUE kolonu ile genişletir ve P0 kararlarıyla uyumlu hale getirir. Bölüm 8'deki orijinal tablo kanıt/referans olarak korunmuştur.

| OLD URL | SEO VALUE | ACTION | NEW URL | REASON |
|---|---|---|---|---|
| `/` | Yüksek | KEEP | `/` | Ana sayfa, marka çapası |
| `/hakkimizda-2/` | Orta | UPDATE | `/hakkimizda/` | Gerçek içerik var, slug sadeleştirilebilir |
| `/hakkimizda/` (Lorem Ipsum) | Yok | 301 | `/hakkimizda/` (yeni) | Placeholder; URL indekste, 404 bırakılmamalı |
| `/sample-page/` | Yok | REMOVE | — | WP varsayılanı, değersiz |
| `/markalar/` | Düşük (kavramsal değeri Orta) | UPDATE | `/markalar/` | Slug değerli, içerik (Wilo, Alarko, Grundfos, Dab, Pedrollo, Ayvaz, Ebara) ile doldurulmalı |
| `/iletisim-05398815892/` | Orta | 301 | `/iletisim/` | Numaralı slug kırılgan (numara değişince slug'ı da bozar — nitekim numaralar şimdi değişti) |
| `/hidrofor-servisi/` | **Yüksek** | KEEP | `/hidrofor-servisi/` | Ana pillar sayfa, dokunma |
| `/hidrofor-pompa-servisi/` | Orta | 301 (GSC teyidiyle) | `/hidrofor-servisi/` | Duplicate riski |
| `/wilo-servisi/` | Orta | KEEP (biri) | `/wilo-servisi/` | Marka pillar |
| `/wilo-hidrofor-servisi/` | Orta | 301 (GSC teyidiyle) | `/wilo-servisi/` | Duplicate riski |
| `/dalgic-pompa-tamiri/` | **Yüksek** | KEEP | `/dalgic-pompa-tamiri/` | Tek derin Dalgıç Motorları içeriği |
| 20 hedef-ilçe sayfası (Bahçelievler, Bağcılar, Başakşehir, Bayrampaşa, Beşiktaş, Beylikdüzü, Beyoğlu, Esenyurt, Fatih, Gaziosmanpaşa, Kağıthane, Küçükçekmece, Sarıyer, Sultangazi, Şişli, Esenler, Arnavutköy, Büyükçekmece, Bakırköy, Eyüp, Güngören) | Orta | KEEP | aynı slug | Hedef ilçe, gerçek 1.200+ kelime içerik |
| `/avcilar-hidrofor-servisi/` + `/avcilar-wilo-hidrofor-servisi/` (çift) | Orta | 301 (birleştir) | `/avcilar-wilo-hidrofor-servisi/` | Aynı ilçe için iki sayfa |
| `/bagcilar-wilo-hidrofor-servisi/` + `/bagcilar-hidrofor-servisi/` (çift) | Orta | 301 (birleştir) | `/bagcilar-wilo-hidrofor-servisi/` | Aynı ilçe için iki sayfa |
| `/avcilar-wilo-hidrofor-servisi/bahcelievler-wilo-hidrofor-servisi/` | Orta | UPDATE + 301 | `/bahcelievler-wilo-hidrofor-servisi/` | Hatalı iç içe permalink |
| `/silivri-wilo-hidrofor-servisi/`, `/silivri-baymak-hidrofor-servisi/`, `/catalca-wilo-hidrofor-servisi/` | Düşük-Orta | **NO CHANGE** (öncelik dışı) | — | Hedef 23 ilçe listesinde yok; Avrupa Yakası sınırları içinde olsa da GSC trafiği görülmeden silinmemeli veya yeniden inşa edilmemeli |
| `/avcilar-hidrofor-servis/` (blog) | Düşük | 301 | `/avcilar-wilo-hidrofor-servisi/` | Tekil blog yazısı, ilçe sayfasıyla örtüşüyor |
| — (yok) | — | **NEW** | `/zeytinburnu-wilo-hidrofor-servisi/` | Hedef listede var, eski sitede hiç karşılığı yok |
| — (yok) | — | **NEW** | `/otomasyon-servisi/` | P0-3 ile onaylanan yeni hizmet |
| — (yok, sadece homepage metninde madde) | Yok | N/A | — | Beyaz eşya — 301/koruma gerektiren bir URL hiç var olmadı (P0-4) |

## P0.6 — LOCAL SEO STRATEGY

- **areaServed (schema ve içerik hedefi):** Sadece aşağıdaki 23 İstanbul Avrupa Yakası ilçesi: Bahçelievler, Bakırköy, Bağcılar, Güngören, Esenler, Başakşehir, Küçükçekmece, Avcılar, Beylikdüzü, Büyükçekmece, Zeytinburnu, Bayrampaşa, Fatih, Eyüpsultan, Kağıthane, Şişli, Beşiktaş, Sarıyer, Beyoğlu, Gaziosmanpaşa, Sultangazi, Arnavutköy, Esenyurt.
- **Anadolu Yakası referansları tamamen kaldırılacak** — eski sitenin homepage metnindeki "Asya-Avrupa bölgeleri" ifadesi yeni içeriğe taşınmayacak.
- **Otomatik/boş ilçe sayfası üretimi yasak** (P0-7 talimatı) — sadece eski sitede zaten gerçek içeriği olan 20 ilçe sayfası + yeni yazılacak Zeytinburnu sayfası. Silivri/Çatalca gibi liste dışı sayfalar için de otomatik silme/kopyalama yapılmayacak, ayrı değerlendirilecek (P0.5).
- **Schema önerisi:** `areaServed` alanı tek bir `"TR"` string'i yerine, her ilçe için `{"@type":"City","name":"Bahçelievler"}` gibi ayrı Place/City nesnelerinden oluşan bir dizi olmalı; ayrıca `"addressRegion":"İstanbul"` ve mümkünse `"containedInPlace"` ile Avrupa Yakası kapsamı netleştirilmeli.

## P0.7 — CONVERSION / LEAD GEN STRATEGY

- Mevcut conversion mimarisi (sticky bar, hero CTA, hizmet kartı CTA'ları, footer CTA — Bölüm 17.1) **korunacak**, sadece numaralar güncellenecek.
- **3 sabit hat gösterim önerisi:** Tüm 3 numarayı aynı görsel ağırlıkta buton yapmak CTA kalabalığı yaratır. Önerilen hiyerarşi: birincil CTA her yerde **WhatsApp/mobil** (`0539 881 58 92`) kalsın (en hızlı dönüşüm kanalı); 3 sabit hat, iletişim sayfası ve footer'da ikincil, sade bir liste olarak (üç ayrı `tel:` linki, aynı stilde, büyük buton değil) sunulsun. Hero/sticky bar gibi en kısıtlı alanlarda sadece mobil numara + WhatsApp kalmalı, 3 sabit hat oraya sıkıştırılmamalı.
- **"NEREDE HİZMET VERİYOR?" eksikliği (Bölüm 17.12) hâlâ açık** — bu P0 güncellemesiyle giderilmedi, implementasyon aşamasında hero ve footer'a "İstanbul Avrupa Yakası" ibaresi eklenmesi gerekiyor.
- **Otomasyon için CTA tekrarı:** 5. hizmet olarak eklenince, diğer 4 hizmetle birebir aynı CTA pattern'ini (Hemen Ara + WhatsApp'tan Ulaş) taşımalı — farklı/eksik bir CTA otomasyonun "ikinci sınıf" hizmet gibi görünmesine yol açar.
- **7/24 mesajının conversion değeri:** Hero'da veya trust-bar'da açıkça "7/24 Hizmet" rozeti göstermek, acil durum aramalarında dönüşümü artıran doğrudan bir sinyal — implementasyon önceliği yüksek.

## P0.8 — STRUCTURED DATA STRATEGY

| Şema alanı | Planlanan değer |
|---|---|
| `@type` | `HVACBusiness` (mevcut) korunabilir; hidrofor/dalgıç motoru kapsamı için `additionalType` olarak `PlumbingService` eklenmesi değerlendirilebilir |
| `name` | "Murat Kombi" |
| `telephone` | `["+905398815892", "+902126305892", "+902126302900", "+902126390643"]` |
| `address` | `{"@type":"PostalAddress","streetAddress":"Yıldıztepe Sokak No: 8","addressLocality":"Bahçelievler","addressRegion":"İstanbul","addressCountry":"TR"}` |
| `areaServed` | 23 ilçelik City listesi (P0.6) |
| `openingHoursSpecification` | `{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"00:00","closes":"23:59"}` — schema.org'da 7/24'ün standart ifade biçimi budur |
| `makesOffer` / `Service` | 5 hizmet (Kombi, Kazan, Hidrofor, Dalgıç Motorları, Otomasyon) |
| `sameAs` | Boş bırakılacak — sosyal medya hesabı doğrulanmadı |
| `logo` | Henüz yok — Bölüm 11'deki eksiklik hâlâ geçerli, müşteriden logo istenmeli |

*(Yukarıdaki alan/değer eşleştirmesi bir planlama tablosudur, henüz `index.html` veya WordPress'e yazılmamıştır.)*

**Kritik kural korunuyor:** Eski sitenin "08:00-18:00 Pazartesi-Cuma" bilgisi hiçbir schema veya içerikte kullanılmayacak; 7/24 tek doğru kaynak.

## P0.9 — CHILD THEME IMPLEMENTATION PLAN (henüz uygulanmadı)

**Kapsam:** `wordpress-theme/merkez-hidrofor-child`, ebeveyn tema **Avril**.

Önerilen dosya/klasör planı (planlama amaçlı, henüz oluşturulmadı):

```
wordpress-theme/merkez-hidrofor-child/
  style.css                 → child theme header (Template: avril), marka renkleri/tipografi tokenleri
  functions.php             → parent+child enqueue, gereksiz Avril/Elementor script-style dequeue, nav menu register, schema hook
  front-page.php            → yeni tasarımın ana sayfası
  page-hizmetler.php        → hizmetler sayfası şablonu (5 hizmet)
  page-hakkimizda.php
  page-iletisim.php
  single-hizmet.php (opsiyonel CPT) veya page-* şablonları → her hizmet/ilçe sayfası için
  template-parts/
    header.php, footer.php, hero.php, trust-bar.php,
    service-card.php, cta-band.php, sticky-cta.php
  inc/
    schema.php             → LocalBusiness/Service/BreadcrumbList JSON-LD çıktısı
    contact-data.php       → telefon/whatsapp/adres/saat WP Customizer alanları olarak (bkz. aşağıda)
  assets/
    css/, js/              → mevcut statik dosyaların birebir taşınması, wp_enqueue ile yüklenmesi
```

**Kilit tasarım kararı — iletişim verisi CMS'e taşınmalı:** Statik sitedeki `business.js` mimarisi (tek doğruluk kaynağı) iyi bir pratikti, ama numaraların bugün ikinci kez değişmiş olması (444 78 06 → 0212 630 62 65 → 3 yeni hat) gösteriyor ki bu bilgi bir kod dosyasında sabit kalmamalı. Child theme'de telefon/WhatsApp/adres/çalışma saati alanları **WordPress Customizer veya ACF gibi bir alan yapısı** üzerinden düzenlenebilir olmalı — böylece bir sonraki numara değişikliğinde kod/deploy gerekmez.

**Karşılanması gereken gereksinimler (kullanıcı listesi, checklist olarak):**
- [ ] Yeni frontend tasarımının WordPress'e aktarılması
- [ ] Mevcut WordPress içeriklerinin korunması
- [ ] Mevcut URL yapısının korunması (P0.5 tablosuna göre)
- [ ] SEO uyumluluğu (canonical, schema, meta)
- [ ] Responsive tasarım
- [ ] Mobil sticky CTA
- [ ] Telefon / WhatsApp CTA (3 sabit hat + WhatsApp)
- [ ] LocalBusiness Schema
- [ ] Service Schema (5 hizmet)
- [ ] WordPress menü desteği (`register_nav_menus`)
- [ ] WordPress güncellemelerine dayanıklılık (child theme parent'ı asla doğrudan değiştirmez)
- [ ] Parent tema (Avril) dosyalarının doğrudan değiştirilmemesi

## P0.10 — PRE-LAUNCH SEO CHECKLIST

- [ ] `<title>` ve H1'ler P0.4'teki nihai yapıya göre güncellendi
- [ ] Tüm canonical'lar gerçek domain (merkezhidrofor.com) ile güncellendi
- [ ] P0.5 tablosundaki tüm 301'ler uygulandı ve test edildi
- [ ] Duplicate çiftler (hidrofor-servisi/hidrofor-pompa-servisi, wilo-servisi/wilo-hidrofor-servisi, ilçe çiftleri) GSC verisiyle teyit edilip birleştirildi
- [ ] Lorem Ipsum sayfalar (`/hakkimizda/`, `/markalar/`) gerçek içerikle dolduruldu veya yönlendirildi
- [ ] Zeytinburnu sayfası oluşturuldu
- [ ] Otomasyon sayfası oluşturuldu (uydurma teknik detay yok)
- [ ] Beyaz eşya hiçbir SEO yüzeyinde (menü, sitemap, schema) görünmüyor
- [ ] areaServed 23 ilçe ile güncellendi, "TR"/"Asya-Avrupa" ifadeleri kaldırıldı
- [ ] Yeni sitemap.xml gerçek domain ile oluşturuldu, GSC'ye gönderildi
- [ ] robots.txt gerçek domain sitemap'ine işaret ediyor

## P0.11 — PRE-LAUNCH CONVERSION CHECKLIST

- [ ] Header, hero, sticky bar, footer, iletişim sayfasında tüm telefon/WhatsApp linkleri P0.2'deki güncel numaralarla test edildi
- [ ] 3 sabit hat + WhatsApp doğru `tel:`/`wa.me` formatında, P0.7'deki hiyerarşiye uygun yerleştirildi
- [ ] "7/24 Hizmet" mesajı hero/trust-bar'da görünür
- [ ] "İstanbul Avrupa Yakası" ibaresi hero veya footer'da görünür (Bölüm 17.12 açığı kapatıldı)
- [ ] Otomasyon hizmeti diğer 4 hizmetle aynı CTA pattern'ine sahip
- [ ] Mobilde tüm CTA butonları parmak dostu boyutta
- [ ] Hiçbir sayfada iletişim için form doldurma zorunluluğu yok

## P0.12 — PRE-LAUNCH TECHNICAL CHECKLIST

- [ ] `wordpress-theme/merkez-hidrofor-child` P0.9 planına göre inşa edildi ve staging'de test edildi
- [ ] WordPress veritabanı + dosya sistemi tam yedeği alındı (yayına almadan önce)
- [ ] Parent tema (Avril) dosyaları doğrudan değiştirilmedi
- [ ] Telefon/adres/saat bilgisi CMS alanı üzerinden düzenlenebilir (hardcoded değil)
- [ ] Schema (LocalBusiness, Service, BreadcrumbList) P0.8 tablosuna göre doğru veriyle kuruldu, 7/24 `openingHoursSpecification` doğru formatta
- [ ] Mobil performans (Lighthouse) yeni WP entegrasyonunda yeniden ölçüldü (Avril/Elementor yükü nedeniyle önceki statik site skorları geçerliliğini kaybetmiş olabilir)
- [ ] 404 taraması yapıldı, hiçbir değerli eski URL boşta bırakılmadı
- [ ] Staging ortamında tam QA sonrası canlıya alındı, 48-72 saat izlendi

---

## 1. Executive Summary

**En kritik 5 bulgu:**

1. **`wordpress-theme/merkez-hidrofor-child` klasörü mevcut değil.** GÖREV 3'ün denetlemesi istenen child theme henüz hiç oluşturulmamış — proje kökünde böyle bir klasör yok, `Projects/` altında da bulunamadı. Bu, "WordPress silinmeyecek, child theme üzerinden giydirilecek" planının şu an **sıfır ilerleme** durumunda olduğu anlamına geliyor. Bugün yayına almak hedefleniyorsa, bu en büyük darboğaz.

2. **Yeni frontend (MuratKombi/GitHub Pages) yapısal olarak eski sitenin URL/SEO mimarisiyle uyumsuz.** Eski site 39 ayrı, indekslenmiş URL barındırıyor (4 kurumsal sayfa + ~30 ilçe bazlı "Wilo Hidrofor Servisi" sayfası + marka/hizmet sayfaları); yeni statik site sadece **4 düz HTML dosyası** ve hizmetler.html içinde `#kombi`, `#hidrofor` gibi anchor'lardan ibaret. Mevcut haliyle yeni tasarım, eski sitenin URL bazlı SEO değerini birebir taşıyamaz — bu, statik siteyi olduğu gibi canlıya almak yerine, **WordPress içinde sayfa/şablon bazlı bir yeniden üretim** gerektirir (bkz. Bölüm 7-9, Implementation Plan).

3. **İletişim bilgilerinde üç farklı kaynak birbiriyle çelişiyor** — eski site, yeni site ve GÖREV 4'te verilen "doğrulanmış" bilgiler. Özellikle sabit hat numaraları hiçbir kaynakta örtüşmüyor (bkz. Bölüm 10). Bu, kodla çözülecek bir sorun değil; yayına almadan önce müşteriden (Murat) netleştirme gerektiriyor.

4. **Eski sitede iki adet Lorem Ipsum placeholder sayfa hâlâ indeksleniyor** (`/hakkimizda/` ve büyük ölçüde `/markalar/`) — gerçek "Hakkımızda" içeriği aslında `/hakkimizda-2/` adresinde. Bu, düşük kaliteli/tamamlanmamış sayfaların Google'da göründüğü anlamına geliyor; temizlenmesi gerekiyor ama URL'ler tamamen silinmemeli (301 ile gerçek sayfalara yönlendirilmeli).

5. **"Wilo" markası eski sitenin en güçlü SEO çapası** (15+ ilçe sayfası özellikle "Wilo Hidrofor Servisi" hedefliyor) ama yeni sitede hiçbir marka adı (Wilo, Grundfos, Alarko, vb.) geçmiyor. Bu, sessizce kaybedilirse marka-adı aramalarında ciddi trafik kaybına yol açabilecek bir içerik boşluğu.

**Genel değerlendirme:** Yeni tasarımın görsel/UX kalitesi (Lighthouse 97-100, mobil sticky CTA, temiz kod) çok iyi durumda ve conversion açısından güçlü bir temel sunuyor. Ancak bu proje şu an **"tasarım hazır, taşıma stratejisi yok"** aşamasında. Asıl iş — WordPress child theme'in inşası ve eski sitenin SEO değerinin yeni yapıya taşınması — henüz başlamadı.

---

## 2. Eski Site Analizi (merkezhidrofor.com)

### 2.1 Genel bilgiler
- **Platform:** WordPress, **Avril** teması (ücretsiz, Nayra Themes) — "Powered by Avril WordPress Teması" footer kredisi bunu doğruluyor.
- **SEO eklentisi:** Yoast SEO (sitemap_index.xml formatından anlaşılıyor).
- **robots.txt:** `User-agent: *` / `Disallow:` (boş — hiçbir şey engellenmiyor) / `Sitemap: https://www.merkezhidrofor.com/sitemap_index.xml`. Temiz, sorunsuz.
- **Sitemap yapısı:** `sitemap_index.xml` → `post-sitemap.xml` (1 blog yazısı), `page-sitemap.xml` (39 sayfa), `category-sitemap.xml`, `author-sitemap.xml`.
- **JSON-LD / Schema:** **Hiç yok.** Ana sayfada `<script type="application/ld+json">` bulunamadı. Yani eski sitenin kaybedilecek bir schema mirası yok — yeni sitede temiz ve doğru schema kurmak risksiz.

### 2.2 Marka kullanımı (eski sitede)
Sayfa başlığı ve header'da **"Merkez Hidrofor Pompa"**; Hakkımızda içeriğinde **"Merkez Isı"** adı da geçiyor ("Merkez Isı, pompa ve hidrofor sistemleri alanında 20 yılı aşkın tecrübesiyle..."). Yani eski sitede bile marka adı tutarsız kullanılmış (iki farklı isim). "Murat Kombi" adı eski sitede hiç geçmiyor — bu tamamen yeni bir marka konumlandırması.

### 2.3 Sayfa envanteri (page-sitemap.xml, 39 URL)

| Kategori | Sayı | Örnekler |
|---|---|---|
| Kurumsal | 4 | `/`, `/hakkimizda-2/`, `/markalar/`, `/iletisim-05398815892/` |
| Düşük kaliteli/duplicate kurumsal | 2 | `/hakkimizda/` (Lorem Ipsum), `/sample-page/` (WP varsayılan) |
| Pillar hizmet sayfaları | 4 | `/hidrofor-servisi/`, `/hidrofor-pompa-servisi/`, `/wilo-servisi/`, `/wilo-hidrofor-servisi/` (ikişerli çiftler birbirine çok benziyor) |
| Yeni hizmet (dalgıç) | 1 | `/dalgic-pompa-tamiri/` |
| İlçe bazlı "Wilo Hidrofor Servisi" doorway sayfaları | ~27 | Bahçelievler, Avcılar (x2), Bağcılar (x2), Başakşehir, Bayrampaşa, Beşiktaş, Beylikdüzü, Silivri (x2), Çatalca, Beyoğlu, Esenyurt, Fatih, Gaziosmanpaşa, Kağıthane, Küçükçekmece, Sarıyer, Sultangazi, Şişli, Esenler, Arnavutköy, Büyükçekmece, Bakırköy, Eyüp, Güngören |
| Blog | 1 | `/avcilar-hidrofor-servis/` (post-sitemap, 2025-07-09) |

**Önemli teknik anomali:** `/avcilar-wilo-hidrofor-servisi/bahcelievler-wilo-hidrofor-servisi/` — Bahçelievler sayfası, WordPress'te yanlışlıkla Avcılar sayfasının **alt sayfası (child page)** olarak kurulmuş. Sayfa çalışıyor ve gerçek içerik barındırıyor, ama URL'i gereksiz yere iç içe/uzun. Bu, redirect planında dikkat edilmesi gereken bir detay — "temiz" bir `/bahcelievler-wilo-hidrofor-servisi/` URL'i şu an mevcut değil, sadece bu iç içe versiyon var.

**Hedef ilçe listesi karşılaştırması:** Kullanıcının verdiği 23 ilçelik hedef listenin neredeyse tamamı eski sitede zaten sayfa olarak var (eksik: **Zeytinburnu**). Ayrıca eski sitede olup kullanıcının listesinde **olmayan** iki ilçe var: **Silivri** ve **Çatalca** — bunlar coğrafi olarak Avrupa Yakası'nda olsa da şehir merkezine çok uzak, aynı gün hizmet mantığıyla gerçekçiliği tartışmalı; silme kararı SEO değeri değerlendirilmeden verilmemeli (Bölüm 7).

### 2.4 İçerik derinliği
- `/hidrofor-servisi/`: ~2.800-3.000 kelime, H2 yapısı zengin ("Hidrofor Nedir?", "Hidrofor Çeşitleri Nelerdir?" vb.) — bu sitenin **en değerli tek sayfası**, muhtemelen "hidrofor" ana kelimesinde asıl sıralanan sayfa.
- İlçe sayfaları (örnek: Gaziosmanpaşa): ~1.200-1.400 kelime, kalıp/template bazlı ama gerçek içerik (paper-thin değil). "Orta düzeyde jenerik" — klasik local-SEO doorway page yapısı, teknik olarak "ince içerik" (thin content) sınırının üzerinde ama Google'ın yakın zamanda cezalandırdığı "aşırı kalıplaşmış çoklu şehir sayfası" pattern'ine yakın.
- `/dalgic-pompa-tamiri/`: ~1.800 kelime, Wilo/Grundfos/Ebara/Pedrollo marka isimleri geçiyor — yeni sitedeki "Dalgıç Motorları" kartının karşılığı, önemli.
- `/hakkimizda/`: **Sadece Lorem Ipsum** dummy metni — boş/tamamlanmamış, ama indekste.
- `/markalar/`: Büyük ölçüde Lorem Ipsum, gerçek marka bilgisi neredeyse yok — düşük değerli.
- `/sample-page/`: WordPress varsayılan örnek sayfası, hiç düzenlenmemiş, temizlenmesi gereken tipik "unutulmuş" sayfa.

### 2.5 İletişim ve marka bilgisi (eski site)
- **Telefon:** Ana CTA olarak `+90 539 881 58 92` her yerde. İletişim sayfasında ayrıca bir çağrı merkezi numarası **"444 78 06"** ve `+90 509 881 58 92` (539 değil 509 — muhtemelen yazım/tarama hatası, doğrulanmalı) geçiyor.
- **Adres (iletişim sayfası, gerçek):** "Yenibosna Merkez, Yıldıztepe Sk. No:8/A, 34197 Bahçelievler/İstanbul" — **GÖREV 4'te verilen adresle neredeyse birebir örtüşüyor**, bu adres güvenilir.
- **Adres (footer widget, farklı metin):** "Küçükköy, Yıldıztabya, Sümeyye Hatun Sk No:10, 34255 Gaziosmanpaşa/İstanbul" — Bahçelievler adresinden tamamen farklı bir ilçe. Bu muhtemelen gerçek bir şube değil, **yerel SEO amaçlı eklenmiş, tutarsız bir NAP (isim-adres-telefon) metni** — bkz. Bölüm 11.
- **Çalışma saatleri:** "8:00-18:00 Pazartesi-Cuma" olarak açıkça yazılı. **GÖREV 4'teki "7/24 hizmet" iddiasıyla çelişiyor** — bkz. Bölüm 10.
- **Kuruluş/tecrübe:** "20 yılı aşkın tecrübe" (Hakkımızda). GÖREV 4'teki "2001 kuruluş / 25+ yıl" ile **çelişmiyor**, sadece daha eski/az güncellenmiş bir ifade (25 yıl, 20+ yıl iddiasını kapsıyor).
- **Sosyal medya:** Hiçbiri bulunamadı (Instagram/Facebook linki yok).
- **Google Haritalar embed:** Yok.
- **Güven mesajları:** "Müşteri Memnuniyeti" ve "Garantili Hizmet" ifadeleri geçiyor ama bunlar somut/doğrulanabilir veri değil, jenerik pazarlama dili.
- **Yorum/testimonial sistemi:** Yok.

---

## 3. Yeni Site Analizi (MuratKombi — GitHub Pages statik frontend)

**Konum:** `C:\Users\BURAK KEMER\Projects\MuratKombi` — HTML5/CSS3/Vanilla JS, framework yok, build tool yok.

### 3.1 Dosya yapısı
```
index.html, hizmetler.html, hakkimizda.html, iletisim.html, 404.html
sitemap.xml, robots.txt, site.webmanifest
assets/css/{base,layout,components,pages}/
assets/js/main.js, assets/js/config/business.js, assets/js/modules/
assets/images/{hero,icons,placeholder}/
```
**wordpress-theme/ klasörü yok.**

### 3.2 Sayfa envanteri — sadece 4 sayfa
| Sayfa | H1 | Not |
|---|---|---|
| `index.html` | "Isınma ve Su Sistemlerinde Güvenilir Teknik Çözüm." | Hero + 4 hizmet kartı + süreç + CTA band |
| `hizmetler.html` | "Kombi, Kazan, Hidrofor ve Dalgıç Motoru Teknik Servisi" | 4 hizmet, hepsi tek sayfada `#kombi` `#kazan` `#hidrofor` `#dalgic-motorlari` anchor'ları ile |
| `hakkimizda.html` | "Isınma ve Su Sistemlerinde Teknik Servis" | Çok kısa — sadece hizmet ikonları + CTA, gerçek "hakkımızda" metni yok |
| `iletisim.html` | "Bize Ulaşın" | Telefon/WhatsApp panelleri, adres/harita yok (null olduğu için) |

### 3.3 SEO durumu
- **Canonical:** Tüm sayfalarda `https://example.com/...` — placeholder, gerçek domain henüz atanmamış.
- **Title/description:** Her sayfada mevcut ve makul, ama "hidrofor" kelimesi sadece açıklama metinlerinde geçiyor, **H1'lerde marka odağı "Isınma ve Su Sistemleri" / genel** — kombi-ağırlıklı değil, bu iyi bir başlangıç (Bölüm 4'teki risk zaten kısmen önlenmiş).
- **Schema:** `index.html`'de `HVACBusiness` tipi JSON-LD var — sadece doğrulanmış alanlar (name, telephone, areaServed: "TR", 4 hizmet) kullanılmış, adres/saat uydurulmamış. **Diğer 3 sayfada schema yok.**
- **Open Graph:** Sadece `index.html`'de var; iç sayfalarda yok.
- **Twitter card:** Sadece `index.html`'de, `summary` tipi.
- **areaServed:** Şu an sadece `"TR"` (tüm Türkiye) — İstanbul Avrupa Yakası'na özel hiçbir hedefleme yok.
- **Internal linking:** Nav + footer + hizmet kartları üzerinden standart, sorunsuz.
- **Image alt text:** Hero görselinde `alt=""` (dekoratif olarak işaretlenmiş, `aria-hidden="true"` olan bir kapsayıcı içinde — teknik olarak doğru ama görsel gerçekten dekoratifse sorun yok, gerçek bir bilgi taşıyorsa alt boş bırakılmamalı).
- **sitemap.xml:** Sadece 4 URL, hepsi `example.com` altında.
- **robots.txt:** Temiz, `Allow: /`, sitemap linki doğru referanslanmış (ama example.com'a işaret ediyor).

### 3.4 İletişim mimarisi
`assets/js/config/business.js` tek doğruluk kaynağı; statik HTML aynı değerleri `data-contact` özniteliğiyle fallback olarak taşıyor, `contact-bind.js` runtime'da senkronize ediyor (önceki oturumdan hatırlanan mimari, hâlâ doğru). **address, hours, email, social alanları hâlâ `null`** — hiçbir yerde uydurulmamış, bu doğru bir pratik.

### 3.5 Mevcut telefon/WhatsApp verisi (yeni site)
- Mobil/WhatsApp: `0539 881 58 92` — GÖREV 4 ile **birebir uyumlu**.
- Sabit hat: `0212 630 62 65` — **hem eski sitedeki hiçbir numarayla hem de GÖREV 4'teki üç sabit hatla uyuşmuyor** (bkz. Bölüm 10, kritik).

---

## 4. WordPress Child Theme Analizi

**Sonuç: Klasör mevcut değil.** `wordpress-theme/merkez-hidrofor-child` ne bu projede ne de `Projects/` altındaki başka bir klasörde bulunamadı; `C:\Users\BURAK KEMER\` genelinde yapılan geniş arama da zaman aşımına uğradı (çok fazla dosya, spesifik olmayan arama) ama proje kökünde ve olağan konumlarda yok.

**Bunun anlamı:**
- PHP, `functions.php`, `enqueue`, header/footer template, WordPress hooks, menü/widget desteği — **hiçbiri henüz yazılmamış.**
- Şu anki statik MuratKombi tasarımı **WordPress'e giydirilmeye hazır değil** çünkü hiç WordPress template yapısına dönüştürülmedi. Statik `index.html`, `hizmetler.html` gibi dosyalar doğrudan bir WP temasına kopyalanamaz; PHP template'lere (`front-page.php`, `page-*.php` veya sayfa şablonları), `wp_head()`/`wp_footer()` hook'larına, `wp_enqueue_style/script` ile CSS/JS yükleme mantığına dönüştürülmesi gerekiyor.
- Ebeveyn tema **Avril** (ücretsiz, Nayra Themes) olarak teyit edildi — child theme `style.css` header'ında `Template: avril` (veya kurulu slug neyse) belirtilmesi gerekecek.

**Bu, projenin bugün tamamlanabilecek bir adımı değil** — GÖREV 3 kapsamında "denetlenecek" olarak tanımlanmış ama denetlenecek bir şey yok; bu madde otomatik olarak **"inşa edilmesi gereken"** bir Implementation Plan kalemine dönüşüyor.

---

## 5. Korunacak İçerikler

| İçerik | Kaynak | Neden korunmalı |
|---|---|---|
| `/hidrofor-servisi/` pillar içeriği (~2.800 kelime) | Eski site | Muhtemelen en yüksek organik trafik getiren sayfa; "hidrofor" ana kelimesinin çapası |
| ~27 ilçe bazlı Wilo/Hidrofor sayfası | Eski site | Local SEO'nun omurgası; kullanıcının istediği 23 ilçenin fiilen SEO karşılığı zaten var |
| `/dalgic-pompa-tamiri/` içeriği | Eski site | "Dalgıç Motorları" hizmetinin tek derinlemesine içeriği, marka isimleriyle (Wilo, Grundfos, Ebara, Pedrollo) birlikte |
| Marka adı referansları (Wilo başta) | Eski site | Marka-adı aramalarının SEO çapası; yeni sitede tamamen kayıp |
| Doğrulanmış telefon/WhatsApp (`0539 881 58 92`) | Her iki site + GÖREV 4 | Üç kaynakta da tutarlı, tek net sinyal |
| Bahçelievler adresi (iletişim sayfası versiyonu) | Eski site + GÖREV 4 | İki bağımsız kaynakta örtüşüyor, güvenilir |
| Yeni sitenin mobil-first conversion mimarisi (sticky CTA, tel:/wa.me linkleri, business.js tek kaynak mimarisi) | Yeni site | Zaten iyi kurulmuş, WordPress'e taşınırken bozulmamalı |
| Yeni sitenin doğru pratiği: uydurma veri yok (address/hours/email `null`) | Yeni site | Devam ettirilmeli, WP tarafında da aynı disiplin korunmalı |

---

## 6. Silinecek / Yenilenecek İçerikler

| İçerik | Aksiyon | Gerekçe |
|---|---|---|
| `/hakkimizda/` (Lorem Ipsum) | 301 → `/hakkimizda-2/` (veya yeni birleşik About sayfası) | Boş/placeholder, ama URL'in kendisi silinmemeli — 404 bırakılırsa değersiz de olsa indeks sinyali kaybı |
| `/markalar/` (büyük ölçüde Lorem Ipsum) | Yenile — gerçek marka listesiyle (Wilo, Alarko, Grundfos, Dab, Pedrollo, Ayvaz, Ebara) doldur, silme | URL zaten "Markalar" gibi değerli bir kavramsal anahtar kelimeyi taşıyor, içerik eksik ama kavram değerli |
| `/sample-page/` | 301 → ana sayfa veya `noindex` + kaldır | WordPress varsayılanı, hiçbir SEO/kullanıcı değeri yok |
| `/hidrofor-servisi/` vs `/hidrofor-pompa-servisi/` çifti | İçerik karşılaştırması sonrası **birini** kanonik yap, diğerini 301 ile ona yönlendir | Muhtemel duplicate content; hangisinin daha çok backlink/trafik aldığı Search Console ile doğrulanmadan silinmemeli |
| `/wilo-servisi/` vs `/wilo-hidrofor-servisi/` çifti | Aynı mantık — karşılaştır, birleştir | Aynı risk |
| Silivri, Çatalca ilçe sayfaları | **Karar bekliyor** — silme değil, değerlendirme | Kullanıcının hedef 23 ilçe listesinde yok, ama halihazırda indekslenmiş trafik getiriyor olabilir; Search Console verisi görülmeden silinmemeli |
| Footer'daki Gaziosmanpaşa adres metni | Kaldır/düzelt | Gerçek adresle (Bahçelievler) çelişen, tutarsız NAP — bkz. Bölüm 11 |

---

## 7. SEO Koruma Planı

1. **URL bazlı yapıyı koru.** Yeni tasarım WordPress'e page-template olarak uygulanmalı; mevcut 39 URL'in her biri (silinmesi kararlaştırılanlar hariç) aynı slug ile yaşamaya devam etmeli. Statik `hizmetler.html`'deki tek-sayfa-anchor yaklaşımı **sadece görsel/UX referansı** olarak kullanılmalı, gerçek WP yapısında her hizmetin ve her ilçenin kendi URL'i olmaya devam etmeli.
2. **`/hidrofor-servisi/` pillar sayfasını hiçbir şekilde küçültme.** Yeni tasarımın "Hidrofor Sistemleri" kartı sadece 1-2 cümlelik özet içeriyor; bu, WP'deki gerçek sayfa için sadece bir "üst özet" olmalı, mevcut 2.800 kelimelik derinlik korunmalı veya geliştirilmeli.
3. **Marka isimlerini (Wilo başta) yeni içeriğe geri ekle.** Şu an hiçbir yerde geçmiyor; en azından Hidrofor ve Dalgıç Motorları hizmet açıklamalarında ve yeni/güncellenmiş Markalar sayfasında yer almalı.
4. **"Murat Kombi & Hidrofor Teknik Servisi" yaklaşımı SEO açısından uygundur** — H1'de tek kelimeye ("Kombi") indirgemeden, marka + kapsayıcı hizmet ifadesi (mevcut yeni sitedeki "Isınma ve Su Sistemlerinde Güvenilir Teknik Çözüm" H1'i zaten bu ilkeye uygun, iyi bir başlangıç). Ana sayfa `<title>` etiketi de zaten "Kombi, Kazan, Hidrofor ve Dalgıç Motoru" sırasıyla dört hizmeti eşit ağırlıkta listeliyor — bu korunmalı.
5. **Duplicate çiftleri (hakkimizda, hidrofor-servisi/hidrofor-pompa-servisi, wilo-servisi/wilo-hidrofor-servisi) canlıya geçmeden önce Google Search Console'da hangisinin index/trafik aldığı kontrol edilmeli**, kanonik olmayan otomatik/tahminî seçim yapılmamalı.
6. **schema.org verisi WordPress tarafında da sadece doğrulanmış alanlarla kurulmalı** — yeni statik sitedeki disiplin (adres/saat uydurmama) WP'ye taşınmalı.

---

## 8. URL / Slug Koruma Planı

> **Not:** Aşağıdaki tablo mevcut envanterden derlenmiştir; "NEW URL" kolonu önerilen hedef yapıyı gösterir — bunlar WordPress içinde inşa edilecek gerçek sayfalardır, GitHub Pages'teki statik dosyalarla karıştırılmamalıdır.

| OLD URL | NEW URL | ACTION | REASON |
|---|---|---|---|
| `/` | `/` | KEEP | Ana sayfa, aynı URL korunuyor |
| `/hakkimizda-2/` | `/hakkimizda/` | UPDATE | Gerçek içerik, slug sadeleştirilebilir ama eski slug da 301 ile buraya bağlanmalı |
| `/hakkimizda/` (Lorem Ipsum) | `/hakkimizda/` (yeni) | 301 | Boş placeholder, gerçek About sayfasına yönlendir |
| `/sample-page/` | — | REMOVE (410/301→`/`) | WP varsayılanı, değersiz |
| `/markalar/` | `/markalar/` | UPDATE | Slug korunuyor, içerik gerçek marka listesiyle dolduruluyor |
| `/iletisim-05398815892/` | `/iletisim/` | 301 | Telefon numarası URL'de olması SEO açısından gereksiz/kırılgan (numara değişirse slug da bozulur); temiz slug'a yönlendir |
| `/hidrofor-servisi/` | `/hidrofor-servisi/` | KEEP | Pillar sayfa, en yüksek değer — dokunma |
| `/hidrofor-pompa-servisi/` | `/hidrofor-servisi/` (muhtemel) | 301 (GSC verisiyle teyit sonrası) | Duplicate riski — hangisi kanonik olacak GSC trafiği ile karar verilmeli |
| `/wilo-servisi/` | `/wilo-servisi/` veya `/wilo-hidrofor-servisi/` | KEEP (biri) + 301 (diğeri) | Aynı duplicate riski |
| `/wilo-hidrofor-servisi/` | (yukarıdakiyle birleşir) | 301 | — |
| `/dalgic-pompa-tamiri/` | `/dalgic-pompa-tamiri/` | KEEP | Dalgıç Motorları hizmetinin tek derin içeriği |
| `/bahcelievler-hidrofor-servisi/` | `/bahcelievler-hidrofor-servisi/` | KEEP | Hedef ilçe |
| `/avcilar-hidrofor-servisi/`, `/avcilar-wilo-hidrofor-servisi/` | Tek sayfada birleştir | 301 (biri diğerine) | Aynı ilçe için iki ayrı sayfa — duplicate |
| `/avcilar-wilo-hidrofor-servisi/bahcelievler-wilo-hidrofor-servisi/` | `/bahcelievler-wilo-hidrofor-servisi/` (düz URL) | UPDATE + 301 | İç içe/hatalı permalink düzeltilmeli, eski iç içe URL yeni düz URL'e yönlendirilmeli |
| `/bagcilar-wilo-hidrofor-servisi/`, `/bagcilar-hidrofor-servisi/` | Tek sayfada birleştir | 301 | Aynı ilçe, iki sayfa |
| `/basaksehir-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/bayrampasa-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/besiktas-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/beylikduzu-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/silivri-wilo-hidrofor-servisi/`, `/silivri-baymak-hidrofor-servisi/` | — | **KARAR BEKLİYOR** | Kullanıcının 23 ilçe listesinde yok; silmeden önce GSC trafiği görülmeli |
| `/catalca-wilo-hidrofor-servisi/` | — | **KARAR BEKLİYOR** | Aynı, listede yok |
| `/beyoglu-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/esenyurt-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/fatih-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/gaziosmanpasa-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/kagithane-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/kucukcekmece-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/sariyer-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/sultangazi-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/sisli-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/esenler-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/arnavutkoy-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/buyukcekmece-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/bakirkoy-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| `/eyup-wilo-hidrofor-servisi/` | `/eyupsultan-wilo-hidrofor-servisi/` (opsiyonel) | UPDATE (opsiyonel) veya KEEP | Kullanıcı listesinde "Eyüpsultan" yazıyor (resmi 2019 sonrası isim), eski slug "eyup" — ikisi de aranıyor olabilir, slug değiştirmek yerine içerikte her iki adı da kullanmak daha güvenli |
| `/gungoren-wilo-hidrofor-servisi/` | aynı | KEEP | Hedef ilçe |
| — (yok) | `/zeytinburnu-wilo-hidrofor-servisi/` | YENİ SAYFA | Kullanıcının listesinde var, eski sitede hiç yok — sıfırdan oluşturulmalı |
| `/avcilar-hidrofor-servis/` (blog) | `/dalgic-pompa-tamiri/` veya `/avcilar-hidrofor-servisi/` içine entegre | 301 | Tekil blog yazısı, muhtemelen ilçe sayfasıyla örtüşüyor |

**Kritik kural (kullanıcı talimatına uygun):** Yukarıdaki hiçbir 301 önerisi kesin değildir — her biri Google Search Console'daki gerçek trafik/index verisiyle doğrulanmadan uygulanmamalı. Bu tablo bir **başlangıç taslağı**dır, kod/yayın aşamasında son karar verilecektir.

---

## 9. Yeni Siteye Taşınacak İçerikler

- Eski sitenin `/hidrofor-servisi/` pillar içeriği → WP'de yeni tasarımın "Hidrofor Sistemleri" bölümüne bağlı, kendi URL'inde tam metin olarak.
- `/dalgic-pompa-tamiri/` içeriği → "Dalgıç Motorları" bölümüne bağlı kendi sayfası.
- Marka listesi (Wilo, Alarko, Grundfos, Dab, Pedrollo, Ayvaz, Ebara) → yenilenmiş `/markalar/` sayfasına ve ilgili hizmet sayfalarına.
- ~27 mevcut ilçe sayfası + Zeytinburnu için yeni sayfa → yeni tasarımın bileşen kütüphanesiyle (trust-bar, cta-band, sticky-cta) yeniden giydirilmiş halde, WP page template olarak.
- GÖREV 4'teki doğrulanmış işletme bilgileri (adres, telefon, 2001 kuruluş, 25+ yıl, 7/24) → yeni schema ve tüm sayfa içeriklerine.

---

## 10. İşletme Bilgileri — Doğrulama ve Çelişki Tablosu

| Alan | GÖREV 4 (verilen, öncelikli) | Eski site | Yeni site (MuratKombi) | Durum |
|---|---|---|---|---|
| Marka adı | Murat Kombi / Merkez Hidrofor | Merkez Hidrofor Pompa / Merkez Isı (tutarsız) | Murat Kombi | Çelişki yok, GÖREV 4 esas alınacak |
| Mobil/WhatsApp | 0539 881 58 92 | 0539 881 58 92 ✅ | 0539 881 58 92 ✅ | **Tutarlı, sorun yok** |
| Sabit hat | 0212 630 58 92, 0212 630 29 00, 0212 639 06 43 (3 adet) | 444 78 06 (çağrı merkezi), +90 509 881 58 92 (muhtemel yazım farkı) | 0212 630 62 65 (tek) | **⚠️ ÜÇ KAYNAK DA FARKLI — hiçbiri örtüşmüyor.** Aşağıda detay. |
| Adres | Yenibosna Merkez Mah., Yıldıztepe Sk. No:8, Bahçelievler/İstanbul | Yenibosna Merkez, Yıldıztepe Sk. No:8/A, 34197 Bahçelievler/İstanbul (iletişim sayfası) ✅ | Yok (null) | **GÖREV 4 ile eski sitenin iletişim sayfası örtüşüyor** — güvenilir. Eski sitenin footer'ındaki Gaziosmanpaşa adresi bununla çelişiyor, muhtemelen yanlış/eski/SEO amaçlı — kullanılmamalı. |
| Çalışma saatleri | 7/24 | "8:00-18:00 Pazartesi-Cuma" (açıkça yazılı) | Yok (null) | **⚠️ Çelişki.** GÖREV 4 esas alınacak ama gerçekten 7/24 mü (acil hat), yoksa normal saatler 8-18 mi, acil durumlarda mı 7/24 — müşteriye sorulmalı, "yanlış vaat" riski taşıyor. |
| Kuruluş yılı | 2001 | Belirtilmemiş, "20 yılı aşkın" (~2005-2006 civarı ima ediyor) | Yok | Hafif tutarsız ama çelişmiyor (25 yıl > 20 yıl), eski içerik güncellenmemiş olabilir |
| Tecrübe | 25+ yıl | 20+ yıl | Yok | Aynı, GÖREV 4 esas alınacak |
| Hizmet bölgesi | Sadece Avrupa Yakası | "Asya-Avrupa bölgeleri" (homepage metni) + tüm sayfalar fiilen Avrupa Yakası ilçelerini hedefliyor | Yok (areaServed: "TR") | **⚠️ Eski sitenin homepage metni "Asya-Avrupa" diyor ama tüm sayfa envanteri sadece Avrupa Yakası ilçelerini hedefliyor** — muhtemelen pazarlama metni abartılı, gerçek kapsam zaten Avrupa Yakası. GÖREV 4'e göre Anadolu Yakası hiç hedeflenmeyecek. |
| Ek hizmetler | Sadece Kombi/Kazan/Hidrofor/Dalgıç Motorları | + Beyaz eşya servisi, + Otomasyon sistemleri kontrolü | Sadece 4 hizmet | **Bilinçli kapsam daraltması gibi görünüyor** — müşteriyle teyit edilmeli, sessizce mi bırakıldı yoksa gerçekten artık verilmeyen hizmetler mi? |
| Markalar | Belirtilmemiş | Wilo, Alarko, Grundfos, Dab, Pedrollo, Ayvaz, Ebara | Hiç yok | Boşluk — Bölüm 7'de önerildi |
| E-posta | Yok | Mailto linki var ama adres görünmüyor | Yok (null) | Bilgi eksik, uydurulmamalı |
| Sosyal medya | Yok | Yok | Yok (null) | Tutarlı — yok |

**Sabit hat numarası çelişkisi (kritik, kod dışı karar):** Üç kaynak da farklı sabit hat numaraları gösteriyor:
- GÖREV 4: `0212 630 58 92`, `0212 630 29 00`, `0212 639 06 43`
- Eski site: `444 78 06` (çağrı merkezi tarzı numara)
- Yeni site: `0212 630 62 65`

Bunlardan hangisinin/hangilerinin güncel ve aktif olduğu, hangisinin birincil CTA numarası olacağı, GÖREV 4'teki üç numaranın nasıl gösterileceği (üçü de mi, sadece biri mi?) **kod değişikliğinden önce müşteriden netleştirilmesi gereken açık bir sorudur.**

---

## 11. Görsel / Logo Analizi

- **Eski site:** Özel logo tespit edilemedi (WebFetch metin tabanlı analiz yaptığı için görsel/logo dosyası doğrudan incelenemedi); marka adı metinsel olarak header'da yer alıyor.
- **Yeni site:** Özel logo yok, yerine `nav__logo-mark` adında basit bir SVG ikon (çember + nokta + çizgi, "hedef/nokta" temalı) ve "Murat **Kombi**" metni kullanılıyor. Favicon `assets/images/icons/favicon.svg`.
- **Hero görseli:** Önceki oturumdan hatırlandığı üzere müşteri onaylı, Gemini üretimi bir teknisyen fotoğrafı; AVIF/WebP/JPEG üçlü format ile optimize edilmiş.
- **Eksik:** Gerçek bir işletme logosu yok — hem eski hem yeni sitede. WordPress'e geçişte bu, Organization/LocalBusiness schema'sının `logo` alanı için de gerekli olacak; müşteriden logo istenmeli veya SVG ikon logo olarak resmileştirilmeli.

---

## 12. Mobil / Responsive Analizi

Önceki oturumdan doğrulanmış veriler (2026-08-09 QA turu):
- 4 sayfada da Lighthouse Performance 97-100, Accessibility 100, Best Practices 100, SEO 100.
- Mobil sticky call/WhatsApp barı 4 sayfada da çalışıyor (bir z-index ve bir `.hero`/`.page-header` bağımlılığı bug'ı o oturumda bulunup düzeltilmişti).
- Hero görseli tablet/mobilde `object-fit: cover` + metin-konumuna göre ayarlı vignette ile yüz/metin çakışması önlenmiş.

**Bu denetim kapsamında yeniden test edilmedi** (kod değişikliği yapılmadığı için); WordPress'e taşındığında bu davranışların birebir korunması gerekiyor, özellikle child theme enqueue sırası CSS/JS'in orijinal sırasını bozmamalı.

---

## 13. Teknik Eksikler

**Yeni site (statik):**
- Canonical URL'ler `example.com` placeholder — gerçek domain atanana kadar yayına alınamaz.
- 3 iç sayfada (hizmetler, hakkımızda, iletişim) Open Graph / Twitter Card etiketleri yok.
- `hakkimizda.html` içerik olarak çok zayıf — gerçek "kim olduğumuz/neden biz" anlatısı yok, sadece hizmet ikonları tekrar ediliyor.
- Schema sadece ana sayfada; iç sayfalarda `Service` / `BreadcrumbList` şeması yok.
- `sitemap.xml`'de `<lastmod>` alanı hiç yok.

**Eski site:**
- Hiç JSON-LD/schema yok (LocalBusiness dahil).
- İki adet Lorem Ipsum sayfası indekste.
- Duplicate içerik çiftleri (hakkimizda, hidrofor-servisi/hidrofor-pompa-servisi, wilo-servisi/wilo-hidrofor-servisi).
- Google Haritalar embed yok.
- Bir sayfa hatalı iç içe permalink yapısında (Bölüm 2.3).

**WordPress child theme:**
- Tamamen eksik — sıfırdan inşa edilmeli (Bölüm 4).

---

## 14. Güvenlik Riskleri

- Bu denetim kapsamında WordPress çekirdek/eklenti sürüm bilgisi, giriş sayfası korunması, veya bilinen güvenlik açığı taraması **yapılmadı** — bunlar için WP-admin erişimi veya sunucu tarafı bilgi gerekiyor, bu denetim sadece halka açık sayfa içeriği üzerinden yapıldı.
- Görülebilen tek risk: iletişim sayfasında `mailto:` linki boş/tanımsız görünüyor — kırık link, kullanıcı deneyimi sorunu (güvenlik değil).
- **Öneri:** Kod değişikliklerine geçmeden önce, GÖREV 4'te de belirtildiği gibi, **WordPress veritabanı ve dosya sisteminin tam yedeği alınmalı** (bkz. Bölüm 16 checklist son maddesi) — bu denetimin kapsamı dışında, aksiyon gerektiren ayrı bir adım.

---

## 15. Yayına Alma Planı (taslak, öncelik sırasıyla)

1. Müşteriden (Murat) Bölüm 10'daki çelişkileri netleştir (özellikle sabit hat numaraları ve 7/24 iddiası).
2. WordPress veritabanı + dosya sistemi tam yedeğini al.
3. `wordpress-theme/merkez-hidrofor-child` klasörünü Avril parent temasına bağlı olarak sıfırdan oluştur.
4. Yeni tasarımın bileşenlerini (hero, trust-bar, service-card, cta-band, sticky-cta, footer) WP template parçalarına (template-parts) dönüştür.
5. Mevcut 39 URL'i (silme/birleştirme kararı verilenler hariç) aynı slug'larla WP sayfa/şablon yapısında yeniden oluştur, her biri yeni tasarımı kullanacak şekilde.
6. Duplicate çiftler için Search Console verisiyle kanonik seçimi yap, 301'leri uygula.
7. Zeytinburnu için yeni ilçe sayfası oluştur.
8. Doğru, doğrulanmış schema (LocalBusiness/Organization/WebSite/Service/BreadcrumbList, areaServed: Avrupa Yakası ilçeleri) tüm sayfalara ekle.
9. Staging ortamında (canlı domain değil) tam QA — telefon/WhatsApp linkleri, mobil sticky bar, tüm redirect'ler.
10. Google Search Console'da yeni sitemap gönder, eski URL'lerin 301 durumunu izle.
11. Canlıya al, 48-72 saat yakından izle (404 hatası, Search Console coverage raporu).

---

## 16. Son Kontrol Listesi

*(GÖREV 5 ve GÖREV 6'nın checklist'leri birleştirilmiştir, tekrarlar kaldırılmıştır.)*

- [ ] Telefon linkleri test edildi
- [ ] WhatsApp linkleri test edildi
- [ ] Mobil sticky bar test edildi
- [ ] Desktop CTA test edildi
- [ ] Google Maps / adres kontrol edildi
- [ ] LocalBusiness Schema kontrol edildi
- [ ] areaServed kontrol edildi (Avrupa Yakası ilçeleri)
- [ ] Title'lar kontrol edildi
- [ ] Meta description'lar kontrol edildi
- [ ] H1'ler kontrol edildi
- [ ] Canonical'lar kontrol edildi (gerçek domain ile)
- [ ] Sitemap kontrol edildi
- [ ] robots.txt kontrol edildi
- [ ] Eski URL'ler listelendi (bkz. Bölüm 8)
- [ ] 301 redirect planı hazırlandı (GSC verisiyle teyit edilerek)
- [ ] 404 kontrolü yapıldı
- [ ] Görseller optimize edildi
- [ ] Mobil performans kontrol edildi
- [ ] Hidrofor SEO içeriği korunuyor
- [ ] Kombi SEO içeriği yeterli
- [ ] Avrupa Yakası hedeflemesi doğru
- [ ] Anadolu Yakası hedeflemesi kaldırıldı ("Asya-Avrupa" ifadesi eski sitede vardı, kaldırılmalı)
- [ ] Gerçek olmayan müşteri yorumu kullanılmadı
- [ ] Gerçek olmayan istatistik kullanılmadı
- [ ] Yayına almadan önce WordPress backup alındı
- [ ] Sabit hat numarası çelişkisi müşteriyle netleştirildi
- [ ] 7/24 hizmet iddiası müşteriyle teyit edildi
- [ ] Beyaz eşya / otomasyon hizmetlerinin kapsam dışı bırakılması müşteriyle teyit edildi
- [ ] `wordpress-theme/merkez-hidrofor-child` inşa edildi ve staging'de test edildi

---

## 17. SEO, Local SEO, Conversion / Lead Gen ve Pazarlama Audit (GÖREV 6)

### 17.1 Conversion / Lead Generation

| Kontrol | Yeni site durumu |
|---|---|
| Mobilde sabit (sticky) iletişim barı | ✅ Var, tüm 4 sayfada (`nav.sticky-cta`), "Ara" + "WhatsApp" |
| Sticky bar'da "Şimdi Ara" / "WhatsApp" | ⚠️ Kısmen — buton metni "Ara" ve "WhatsApp" (talep edilen tam ifade "Şimdi Ara" değil, ama işlevsel olarak aynı amaca hizmet ediyor) |
| Doğru `tel:` linkleri | ✅ `tel:+905398815892`, `tel:+902126306265` formatında doğru |
| Doğru `wa.me` formatı | ✅ `https://wa.me/905398815892` — doğru format |
| Desktop'ta güçlü/görünür CTA | ✅ Header'da "HEMEN ARA" butonu her sayfada sabit |
| Hero'da net CTA | ✅ index.html hero'sunda "Hemen Ara" + "WhatsApp'tan Ulaş" ikili buton |
| Hizmet sayfalarında CTA tekrarı | ✅ hizmetler.html'de her 4 hizmet kartının kendi Ara/WhatsApp butonu var |
| Footer'da tıklanabilir iletişim | ✅ Footer'da tel: ve wa.me linkleri var |
| Gereksiz adım yok | ✅ Hiçbir sayfada form doldurma zorunluluğu yok, her CTA tek tıkla arama/WhatsApp'a gidiyor |

**Sonuç:** Conversion mimarisi zaten güçlü kurulmuş. WordPress'e taşınırken bu davranışın **birebir korunması** kritik öncelik.

### 17.2 Trust / Güven Unsurları

Yeni sitede şu an **hiçbir** öne çıkan güven metni yok — ne "25+ yıl", ne "7/24", ne "aynı gün servis" gibi ifadeler mevcut sayfalarda geçmiyor. Trust-bar bileşeni sadece 4 hizmet ikonunu gösteriyor (Kombi/Kazan/Hidrofor/Dalgıç Motorları), güven mesajı taşımıyor.

**Kullanılabilir (doğrulanmış) güven unsurları:**
- 25+ yıllık tecrübe / 2001 kuruluş (GÖREV 4)
- 7/24 hizmet (GÖREV 4 — ama Bölüm 10'daki çalışma saati çelişkisi netleşmeden yayınlanmamalı)
- İstanbul Avrupa Yakası'nda hizmet (GÖREV 4)

**Kullanılamayacak/doğrulanmamış:** "Aynı gün servis", "orijinal yedek parça" gibi ifadeler ne eski sitede ne GÖREV 4'te açıkça belirtilmiş — bu denetim raporunda **eklenmesi önerilmiyor**, müşteriden doğrudan teyit alınmadan implementasyon aşamasında da eklenmemeli.

### 17.3 Social Proof

- Eski sitede "Müşteri Memnuniyeti" ve "Garantili Hizmet" gibi jenerik güven ifadeleri var ama bunlar somut veri değil (sayı, tarih, isim yok) — doğrudan taşınabilir ama "kanıt" değil, "iddia" niteliğinde.
- Google Business Profile / Google Maps yorumları bu denetim kapsamında **araştırılamadı** (bu, işletmenin Google Business Profile hesabına erişim veya en azından profil linkini gerektirir — halka açık web sayfası taramasıyla tespit edilemedi, sitede de Google Maps embed'i yok).
- **Yorum sistemi mevcut değil** → rapora "eklenebilir" olarak not düşülüyor: Google Business Profile bağlantısı/embed'i, müşteri onayı ile eklenecek gerçek yorumlar için ileride bir bölüm ayrılabilir. Şu an sahte yorum oluşturulmadı, oluşturulmayacak.

### 17.4 Marka + SEO Geçiş Riski

Bölüm 1, 2.2 ve 7'de detaylandırıldı. Özet: **"Murat Kombi & Hidrofor Teknik Servisi" yaklaşımı SEO açısından uygun** — yeni sitenin mevcut H1/title yapısı zaten dört hizmeti eşit ağırlıkta sunuyor, kombi-tekelci bir başlığa kaymamış. Asıl risk H1/title'da değil, **URL/sayfa mimarisinde**: hidrofor'un 27+ sayfalık derin SEO ayak izi, yeni sitenin 4 sayfalık düz yapısına indirgenirse kaybolur (Bölüm 2, 7, 8).

### 17.5 Local SEO

- Hedef 23 ilçenin **20'si** eski sitede zaten sayfa olarak mevcut (Zeytinburnu eksik, Eyüp/Eyüpsultan isim farkı var).
- Eski sitede 2 ilçe (Silivri, Çatalca) hedef listede yok — silme kararı GSC verisi görülmeden verilmemeli (Bölüm 6, 8).
- **Thin content / doorway page riski gerçek ama orta düzeyde:** ilçe sayfaları paper-thin değil (1.200+ kelime), ama "kalıp bazlı, düşük özgünlük" olarak tanımlanabilir. Yeni sitede bu sayfalar yeniden üretilirken **her ilçe için otomatik/templated aynı metni kopyalamak yerine**, en azından hero/intro paragrafında ilçeye özgü gerçek bir detay (varsa) kullanmak önerilir — ama bu bir "nice to have", mevcut sayfaların tamamen silinip yeniden yazılması gerekmiyor.
- **areaServed önerisi:** Yeni site şu an `"areaServed": "TR"` (tüm Türkiye) kullanıyor — bu hem yanlış (Anadolu Yakası hizmet dışı) hem de fırsat kaybı (İstanbul'a özel local pack sıralamasında dezavantaj). `areaServed` alanı İstanbul'un Avrupa Yakası ilçeleriyle (kullanıcının verdiği 23 ilçe listesi) güncellenmeli.

### 17.6 Structured Data / Schema

| Şema tipi | Eski site | Yeni site | Öneri |
|---|---|---|---|
| LocalBusiness/HVACBusiness | Yok | Var (sadece ana sayfa, ad+telefon+hizmetler) | Tüm sayfalara yay, adres eklenince `address` alanı da eklensin |
| Organization | Yok | Yok | Eklenmeli |
| WebSite | Yok | Yok | Eklenmeli (arama kutusu şeması için gerekli değilse basit tutulabilir) |
| WebPage | Yok | Yok | Her sayfaya eklenmeli |
| Service | Yok | Yok | Her hizmet/ilçe sayfasına eklenmeli |
| BreadcrumbList | Yok | Yok | Özellikle ilçe sayfalarında (Ana Sayfa > Hizmetler > Hidrofor > Bahçelievler gibi) faydalı |
| areaServed | Yok | Var ama `"TR"` (yanlış kapsam) | Avrupa Yakası ilçe listesiyle değiştirilmeli |
| telephone | Yok | Var, doğru | Sabit hat netleşince (Bölüm 10) güncellenmeli |
| address | Yok | Yok | Bahçelievler adresi (GÖREV 4 + eski site iletişim sayfası uyumu) eklenebilir |
| openingHours | Yok | Yok | 7/24 mi 8-18 mi netleşmeden **eklenmemeli** — yanlış schema, yanlış Google gösterimi riski taşır |
| sameAs | Yok | Yok | Sosyal medya yok, boş bırakılmalı — uydurulmamalı |

### 17.7 301 Redirect ve URL Koruma

Bkz. Bölüm 8 — tam tablo orada.

### 17.8 SEO Meta / Heading Audit

Bkz. Bölüm 3.3 (yeni site) ve Bölüm 2.4 (eski site). Özet: yeni sitenin meta/heading disiplini eski siteden **daha iyi durumda** (tutarlı title/description formatı, tek H1 kuralı, semantik H2/H3), ama iç sayfalarda OG/Twitter/schema eksik ve tüm canonical'lar placeholder domain'e işaret ediyor.

### 17.9 Core Web Vitals / Performance

Önceki oturumdan doğrulanmış (Bölüm 12): Lighthouse Performance 97-100, AVIF/WebP hero görseli, GSAP kullanılmıyor (bilinçli olarak — sade IntersectionObserver reveal), lazy-load gerektirecek kadar çok görsel yok (sadece 1 hero görseli + ikonlar SVG inline). **Bu denetim kapsamında yeniden ölçülmedi**, kod değişmediği için önceki sonuçların hâlâ geçerli olduğu varsayılıyor.

**Risk noktası:** WordPress'e taşınırken Avril teması ve olası eklentiler (Elementor vb. kullanılıyorsa) genellikle jQuery, ek CSS/JS framework'leri yükler — bu, statik sitenin şu anki "framework yok" performans avantajını **ciddi şekilde aşındırabilir**. Child theme inşa edilirken gereksiz parent tema script/style'larının `wp_dequeue_script/style` ile kaldırılması performans için kritik olacak.

### 17.10 Mobile UX

Bkz. Bölüm 12 — önceki QA turunda tüm maddeler (sticky bar, CTA, menü, hero, kartlar, footer, buton boyutları) doğrulanmış ve parmak dostu boyutlandırma teyit edilmişti. Formlar yeni sitede hiç yok (tasarım bilinçli olarak form yerine doğrudan tel/WhatsApp yönlendirmesi kullanıyor) — bu, "gereksiz adım yok" ilkesiyle (17.1) tutarlı, bir eksiklik değil.

### 17.11 Negative SEO / Spam Riski

- **Lorem Ipsum indeksli sayfalar** (`/hakkimizda/`, kısmen `/markalar/`) — düşük kalite sinyali, temizlenmeli (Bölüm 6).
- **Keyword stuffing:** Belirgin bir stuffing paterni gözlenmedi; ilçe sayfaları kalıp bazlı ama doğal dil kullanıyor, anahtar kelime tekrarı aşırı değil.
- **Kopya içerik:** İki duplicate çift (hidrofor-servisi/hidrofor-pompa-servisi, wilo-servisi/wilo-hidrofor-servisi) — Bölüm 6/8'de ele alındı.
- **Şüpheli backlink/SEO yapısı:** Bu denetim kapsamında backlink profili incelenemedi (Ahrefs/Search Console gibi araçlara erişim gerekiyor, halka açık sayfa taramasıyla görülemez).
- **Tutarsız NAP (footer'daki Gaziosmanpaşa adresi):** Bu, teknik olarak "spam" değil ama Google'ın güven sinyali olarak kullandığı NAP tutarlılığını zedeliyor — düzeltilmesi öneriliyor (Bölüm 2.5, 6).
- **Eski/alakasız hizmetler:** Beyaz eşya servisi ve otomasyon sistemleri eski sitede var, yeni kapsamda yok — "alakasız" değil, muhtemelen bilinçli kapsam daraltması; otomatik silinmemeli, müşteriyle teyit edilmeli (Bölüm 10).

### 17.12 Final Conversion Audit

Sorunun cevabı, mevcut yeni site (index.html) için:

- **NE YAPIYOR?** ✅ Hero H1 + lede net: "Isınma ve Su Sistemlerinde Güvenilir Teknik Çözüm" + "Kombi, kazan, hidrofor ve dalgıç motorlarında teknik servis" — 5 saniyede anlaşılıyor.
- **NEREDE HİZMET VERİYOR?** ❌ **Şu an hiçbir yerde açıkça yazmıyor.** Ne hero'da ne footer'da "İstanbul" veya bir bölge adı geçmiyor. Bu, GÖREV 6'nın 3 zorunlu bilgisinden biri **eksik** — implementasyon aşamasında mutlaka eklenmeli (örn. hero altında "İstanbul Avrupa Yakası" rozeti/trust-bar öğesi).
- **NASIL ULAŞABİLİRİM?** ✅ Hero'da iki büyük buton (Hemen Ara / WhatsApp'tan Ulaş) + sticky bar + header CTA — çok net.

**Sonuç: 3 zorunlu bilgiden 2'si karşılanıyor, "nerede hizmet veriyor" bilgisi eksik.** Bu, implementasyon aşamasının en yüksek öncelikli, en düşük maliyetli düzeltmesi (tek satır metin eklemek kadar basit, ama etkisi yüksek).

### 17.13 Yayına Alma Öncesi SEO / Conversion Checklist

Bölüm 16'ya entegre edildi (tekrar önlemek için tek liste halinde birleştirildi).

---

## IMPLEMENTATION PLAN (öncelik sırasıyla)

> Bu bölüm, kod değişikliklerine başlandığında izlenecek sırayı gösterir. **Şu an hiçbiri uygulanmadı.**

**P0 — Karar/netleştirme (kod değil, müşteri onayı gerektirir):**
1. Sabit hat numarası çelişkisini çöz (Bölüm 10) — hangi numara(lar) kullanılacak.
2. "7/24" iddiasını teyit et — gerçekten 7/24 mü, yoksa 8-18 + acil hat mı.
3. Beyaz eşya / otomasyon hizmetlerinin kapsam dışı bırakılmasını teyit et.
4. WordPress veritabanı + dosya sistemi yedeği al.

**P1 — Temel altyapı:**
5. `wordpress-theme/merkez-hidrofor-child` klasörünü Avril parent temasına bağlı sıfırdan oluştur (style.css header, functions.php, enqueue).
6. Yeni tasarımın CSS/JS modüllerini (assets/css, assets/js) child theme'e taşı, WP enqueue sistemine bağla.
7. "NEREDE HİZMET VERİYOR?" eksikliğini gider — hero ve footer'a İstanbul Avrupa Yakası ibaresi ekle (Bölüm 17.12).

**P2 — İçerik/sayfa mimarisi:**
8. Mevcut 4 statik sayfayı (index, hizmetler, hakkımızda, iletişim) WP page template'lerine dönüştür, mevcut slug'larla eşleştir.
9. Hizmet sayfalarını (hidrofor-servisi, dalgic-pompa-tamiri, vb.) ayrı WP sayfaları olarak, yeni tasarımla, eski içerik derinliğini koruyarak yeniden oluştur.
10. İlçe sayfalarını (27 mevcut + Zeytinburnu yeni) yeni tasarım bileşenleriyle yeniden oluştur.
11. Duplicate çiftler için GSC verisiyle kanonik seç, 301 kur.
12. Markalar sayfasını gerçek içerikle doldur.

**P3 — SEO/Schema:**
13. LocalBusiness/Organization/WebSite/Service/BreadcrumbList schema'larını doğrulanmış verilerle kur.
14. areaServed'ı Avrupa Yakası ilçe listesiyle güncelle (openingHours P0-2 netleşmeden eklenmez).
15. Tüm sayfalara OG/Twitter card ekle, canonical'ları gerçek domaine çevir.
16. Yeni sitemap.xml oluştur, Search Console'a gönder.

**P4 — Test ve yayın:**
17. Staging'de tam QA (Bölüm 15, madde 9).
18. Canlıya al, 301'leri doğrula, 404 taraması yap.
19. 48-72 saat yakın izleme.

---

*Rapor sonu. Kod değişikliğine, bu raporun P0 maddeleri müşteriyle netleştirilmeden başlanmamalıdır.*
