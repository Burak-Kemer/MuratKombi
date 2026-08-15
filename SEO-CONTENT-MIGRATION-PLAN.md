# SEO Content Migration Plan — Merkez Isı Teknik Servis

**Tarih:** 2026-08-15
**Durum:** Planlama + kısmi implementasyon (WordPress child theme içinde). Production'a deploy edilmedi.

Bu dosya, `MURAT-KOMBI-SITE-AUDIT.md`'deki orijinal eski-site crawl'ını temel alır — eski site bu raporda **yeniden crawl edilmedi**, çünkü aynı 39 URL'lik envanter, sayfa içerik derinlikleri, schema/sitemap/robots durumu zaten o raporda ayrıntılı olarak kayıtlı ve bu oturumda hiçbir şey değişmedi (eski site salt-okunur incelendi, hiç dokunulmadı). Aşağıdaki analiz o veriye dayanır.

---

## 1. Content Gap Analysis

| OLD CONTENT | EXISTS IN NEW SITE? | SEO VALUE | USER VALUE | ACTION | TARGET PAGE |
|---|---|---|---|---|---|
| `/hidrofor-servisi/` pillar (~2.800 kelime) | **Evet** — WP temasında `template-hidrofor-servisi.php` özgün yeniden yazılmış içerikle | Yüksek | Yüksek | KEEP (yeni özgün içerikle) | `/hidrofor-servisi/` |
| `/hidrofor-pompa-servisi/` | **Evet** — `template-hidrofor-pompa-servisi.php` | Orta-Yüksek | Yüksek | KEEP | `/hidrofor-pompa-servisi/` |
| `/wilo-servisi/`, `/wilo-hidrofor-servisi/` (duplicate çift) | **Evet** — `template-wilo-servisi.php` (tek sayfa, "yetkili servis" iddiası yok) | Yüksek (marka aramaları) | Yüksek | KEEP (biri) + 301 (diğeri) | `/wilo-servisi/` |
| `/dalgic-pompa-tamiri/` | **Evet** — `template-dalgic-pompa-tamiri.php` + FAQ eklendi | Yüksek | Yüksek | KEEP | `/dalgic-pompa-tamiri/` |
| Kazan (sadece homepage bullet, eski sitede dedicated URL yoktu) | **Evet (yeni)** — `template-kazan-servisi.php` bu turda oluşturuldu | Yok (eski URL yok) → şimdi Orta (yeni sayfa) | Yüksek | YENİ SAYFA | `/kazan-servisi/` |
| Kombi (sadece homepage bullet, eski sitede dedicated URL yoktu) | **Evet (yeni)** — `template-kombi-servisi.php` bu turda oluşturuldu | Yok → şimdi Orta | Yüksek | YENİ SAYFA | `/kombi-servisi/` |
| Brülör (sadece "Kazan - Brülör Servisi" H2/H3 başlığı, eski sitede dedicated URL yoktu) | **Hayır** — bilinçli olarak eklenmedi | Yok (URL hiç var olmadı) | — | VERIFY WITH BUSINESS | Bkz. Bölüm 7 |
| Otomasyon (sadece homepage bullet) | **Evet (yeni)** — `template-otomasyon-servisi.php` + FAQ, jenerik/doğrulanmamış detay yok | Yok → şimdi Orta | Yüksek | YENİ SAYFA | `/otomasyon-servisi/` |
| Beyaz Eşya (sadece homepage bullet) | **Hayır** — bilinçli olarak çıkarıldı (P0-4) | Yok | — | REMOVE (kapsam dışı) | — |
| `/hakkimizda-2/` (gerçek içerik) | **Evet** — `template-hakkimizda.php`, 2001/25+yıl/7-24/Avrupa Yakası doğrulanmış bilgilerle | Orta | Yüksek | MIGRATE + genişletildi | `/hakkimizda/` |
| `/hakkimizda/` (Lorem Ipsum) | Hayır (kasıtlı) | Yok | Yok | REMOVE (301 → gerçek Hakkımızda) | — |
| `/markalar/` (büyük ölçüde Lorem Ipsum) | Kısmen — marka listesi (Wilo, Alarko, Grundfos, DAB, Pedrollo, Ayvaz, Ebara) front-page.php'de "Çalıştığımız Markalar" bölümünde var, ayrı sayfa yok | Düşük-Orta | Orta | CONSOLIDATE (ayrı sayfa yerine ana sayfa bölümü) | `/` (ana sayfa bölümü) |
| ~20 ilçe sayfası (hedef 23 listede) | **Kısmen** — `template-ilce-servisi.php` genel şablonu hazır, ama gerçek eski ilçe metinleri bu şablona **taşınmadı** (WordPress veritabanı erişimi bu implementasyonun kapsamı dışında) | Yüksek (toplu) | Yüksek | MIGRATE (şablon hazır, içerik taşıma production aşamasında) | Bkz. `URL-REDIRECT-MAP.md` |
| Silivri, Çatalca ilçe sayfaları | Hayır (23 hedef listede yok) | Düşük-Orta | Düşük (hedef bölge dışı) | NO CHANGE (GSC verisi bekleniyor) | — |
| `/iletisim-05398815892/` | **Evet** — `template-iletisim.php`, Google Haritalar embed'i (gerçek adresten, API key gerektirmeyen) dahil | Orta | Yüksek | MIGRATE + 301 (temiz slug'a) | `/iletisim/` |
| `/sample-page/` | Hayır | Yok | Yok | REMOVE | — |

---

## 2. Hidrofor SEO Stratejisi

**Durum: Tamamlandı.** `template-hidrofor-servisi.php` eski sitenin 2.800 kelimelik pillar sayfasının konularını (Hidrofor Nedir, Sık Arızalar, Basınç Şalteri, Genleşme Tankı, Pompa Motoru, Bakım, Servis Süreci, FAQ) **özgün, yeniden yazılmış** metinle kapsıyor — birebir kopya değil. Domain'in kanıtlanmış en güçlü SEO varlığı olduğu için (bkz. `MURAT-KOMBI-SITE-AUDIT.md` P0.4) URL (`/hidrofor-servisi/`) korunacak, içerik derinliği daraltılmadı.

## 3. Pompa Servisi Stratejisi

**Karar: KEEP + CONSOLIDATE (kısmi).** Eski sitede `/hidrofor-pompa-servisi/` ayrı bir sayfaydı; yeni site bunu koruyor (`template-hidrofor-pompa-servisi.php`) çünkü "hidrofor pompa arızası" ve "hidrofor servisi" farklı arama niyetlerine hizmet edebiliyor (biri spesifik parça arızası, diğeri genel sistem arızası). Duplicate içerik riski düşük — iki sayfa farklı odaklanıyor (pillar sayfa genel/kapsamlı, pompa sayfası spesifik). Ayrı bir `/pompa-servisi/` URL'i **oluşturulmadı** — gereksiz üçüncü bir benzer sayfa duplicate content riski yaratırdı.

## 4. Wilo SEO Stratejisi

**Durum: Tamamlandı, dikkatli dille.** `template-wilo-servisi.php` içeriğinde açıkça: *"Wilo markasının resmi yetkili servisi olduğumuza dair bir sertifikasyonumuz yoktur; Wilo marka pompalarda bağımsız teknik servis, bakım ve onarım desteği sunuyoruz."* — "yetkili servis" iddiası **kullanılmıyor**, doğrulanabilir dil kullanılıyor. Eski sitedeki duplicate çift (`/wilo-servisi/` + `/wilo-hidrofor-servisi/`) tek sayfada birleştirilmesi öneriliyor (bkz. `URL-REDIRECT-MAP.md`).

## 5. Dalgıç Motorları SEO Stratejisi

**Durum: Tamamlandı, güçlendirildi.** Eski sitenin `/dalgic-pompa-tamiri/` içeriği (Wilo/Grundfos/Ebara/Pedrollo marka isimleri geçen, ~1.800 kelime) referans alınarak `template-dalgic-pompa-tamiri.php` yazılmıştı (13 Ağustos), bu turda FAQ bölümü eklendi. Uydurma marka/model/referans yok.

## 6. Kazan SEO Stratejisi

**Durum: Yeni sayfa oluşturuldu (bu turda).** Eski sitede dedicated URL hiç yoktu — sadece "Kazan - Brülör Servisi" başlığı. Yeni `template-kazan-servisi.php`, marka/model/kapasite/sertifika iddiası olmadan genel kazan bilgisi + FAQ içeriyor. Brülör, sadece "birçok kazan sisteminin bir parçası olabilir" şeklinde teknik bir gerçek olarak geçiyor — ayrı bir hizmet olarak pazarlanmıyor.

## 7. Brülör Kararı

| BRÜLÖR URL | SEO VALUE | CURRENT CONTENT | RECOMMENDATION |
|---|---|---|---|
| Yok — eski sitede sadece homepage'de "Kazan - Brülör Servisi" / "İstanbul Kazan & Brülör Servisi" başlığı (H2/H3) vardı, dedicated bir URL hiç oluşturulmamıştı | Düşük-Orta (URL yok, sadece başlık düzeyinde bir eşleşme sinyali; kaybedilecek bir sayfa yok) | Yok (sayfa hiç var olmadı) | **VERIFY WITH BUSINESS** — işletme sahibi brülör hizmetini aktif olarak onaylarsa, ayrı bir `/brulor-servisi/` sayfası yerine önce Kazan Servisi sayfasının içine entegre edilmesi düşünülebilir (eski sitede de hep "Kazan - Brülör" birlikte anılmış), gerekirse sonra ayrılır |

**Aksiyon alınmadı** — brülör yeni siteye eklenmedi, tek yapılan Kazan sayfasında brülörü bir bileşen olarak (hizmet olarak değil) doğal şekilde anmak oldu.

## 8. Otomasyon Sayfası

**Durum: Tamamlandı.** `template-otomasyon-servisi.php` (13 Ağustos oluşturuldu, bu turda FAQ eklendi) — PLC markası, SCADA markası, fabrika referansı, proje sayısı, marka yetkisi, başarı oranı gibi hiçbir doğrulanmamış detay **yok**. Sadece: "Kombi, kazan, hidrofor ve pompa sistemlerinin otomatik kontrol ve izleme ihtiyaçlarında teknik destek veriyoruz."

## 9. Hakkımızda

**Durum: Tamamlandı.** `template-hakkimizda.php`: 2001'den beri, 25+ yıl tecrübe (Customizer'dan dinamik), 7/24, İstanbul Avrupa Yakası, hizmet listesi, marka listesi — hepsi doğrulanmış. "Binlerce müşteri", "en büyük", "1 numara" gibi hiçbir pazarlama iddiası **yok**.

## 10. İlçe Sayfaları

**Durum: Şablon hazır, içerik taşıma bekliyor.** `template-ilce-servisi.php` (13 Ağustos) kasıtlı olarak eski ilçe metinlerini **yeniden üretmiyor** — `the_content()` ile gerçek, WordPress veritabanındaki mevcut metni render ediyor (doorway-content riskinden kaçınmak için, kod içi yorumda açıkça gerekçelendirilmiş). Tam URL/ilçe tablosu için bkz. `URL-REDIRECT-MAP.md`.

---

*Bu plan, `MURAT-KOMBI-SITE-AUDIT.md` ve `PRE-LAUNCH-AUDIT.md` ile birlikte okunmalıdır — orada zaten belgelenmiş bulgular burada tekrarlanmadı, sadece hizmet bazlı SEO kararları özetlendi.*
