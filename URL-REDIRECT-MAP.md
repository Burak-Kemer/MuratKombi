# URL Migration Master Table — Merkez Isı Teknik Servis

**Tarih:** 2026-08-15
**Durum:** Planlama. **Hiçbir redirect canlıda uygulanmadı.** Production WordPress'e dokunulmadı.

Google'ın site migration rehberindeki ilkeler esas alındı: doğrudan A→C yönlendirme (zincir yok), server-side 301 (kalıcı), alakasız sayfaları toplu şekilde ana sayfaya yönlendirmeme. Kaynak: eski site crawl'ı (`MURAT-KOMBI-SITE-AUDIT.md` Bölüm 2.3, P0.5).

---

## Master Table

| OLD URL | NEW URL | ACTION | SEO VALUE | REASON | REDIRECT TYPE |
|---|---|---|---|---|---|
| `/` | `/` | KEEP | Yüksek | Ana sayfa, marka çapası | NONE |
| `/hidrofor-servisi/` | `/hidrofor-servisi/` | KEEP | Yüksek | Pillar sayfa, en yüksek SEO değeri | NONE |
| `/hidrofor-pompa-servisi/` | `/hidrofor-pompa-servisi/` | KEEP | Orta-Yüksek | Farklı arama niyeti (spesifik pompa arızası) | NONE |
| `/wilo-servisi/` | `/wilo-servisi/` | KEEP | Yüksek | Marka aramaları, kanonik seçildi | NONE |
| `/wilo-hidrofor-servisi/` | `/wilo-servisi/` | 301 | Orta | Duplicate — aynı arama niyeti | 301 |
| `/dalgic-pompa-tamiri/` | `/dalgic-pompa-tamiri/` | KEEP | Yüksek | Dalgıç Motorları'nın tek derin içeriği | NONE |
| `/hakkimizda-2/` | `/hakkimizda/` | UPDATE | Orta | Gerçek içerik, slug sadeleştirildi | 301 (eski slug → yeni) |
| `/hakkimizda/` (Lorem Ipsum) | `/hakkimizda/` (yeni, gerçek içerik) | 301 | Yok | Placeholder, URL indekste — 404 bırakılmaz | 301 |
| `/markalar/` | `/` (#markalar bölümü) | CONSOLIDATE + 301 | Düşük-Orta | Ayrı sayfa yerine ana sayfa bölümüne taşındı | 301 |
| `/iletisim-05398815892/` | `/iletisim/` | UPDATE | Orta | Numaralı slug kırılgan (numara zaten bir kez değişti) | 301 |
| `/sample-page/` | — | REMOVE | Yok | WordPress varsayılanı, değersiz | 301 → `/` (veya 410) |
| **20 hedef-ilçe sayfası** (Bahçelievler, Bağcılar, Başakşehir, Bayrampaşa, Beşiktaş, Beylikdüzü, Beyoğlu, Esenyurt, Fatih, Gaziosmanpaşa, Kağıthane, Küçükçekmece, Sarıyer, Sultangazi, Şişli, Esenler, Arnavutköy, Büyükçekmece, Bakırköy, Güngören) | Aynı slug, `template-ilce-servisi.php` | KEEP | Orta (her biri) | Gerçek, 1.200+ kelime içerik | NONE |
| `/avcilar-hidrofor-servisi/` + `/avcilar-wilo-hidrofor-servisi/` | `/avcilar-wilo-hidrofor-servisi/` | 301 (birleştir) | Orta | Aynı ilçe için iki sayfa | 301 |
| `/bagcilar-wilo-hidrofor-servisi/` + `/bagcilar-hidrofor-servisi/` | `/bagcilar-wilo-hidrofor-servisi/` | 301 (birleştir) | Orta | Aynı ilçe için iki sayfa | 301 |
| `/avcilar-wilo-hidrofor-servisi/bahcelievler-wilo-hidrofor-servisi/` (hatalı iç içe URL) | `/bahcelievler-wilo-hidrofor-servisi/` | UPDATE | Orta | Yanlışlıkla Avcılar'ın alt sayfası olarak kurulmuş | 301 (doğrudan, zincirsiz) |
| `/eyup-wilo-hidrofor-servisi/` | `/eyup-wilo-hidrofor-servisi/` (slug aynı kalır) | KEEP | Orta | İçerikte hem "Eyüp" hem "Eyüpsultan" adı kullanılabilir; slug değiştirmek gereksiz risk | NONE |
| — (yok) | `/zeytinburnu-wilo-hidrofor-servisi/` | YENİ SAYFA | — | Hedef 23 ilçe listesinde var, eski sitede hiç karşılığı yok | — |
| `/silivri-wilo-hidrofor-servisi/`, `/silivri-baymak-hidrofor-servisi/`, `/catalca-wilo-hidrofor-servisi/` | — | NO CHANGE | Düşük-Orta | Hedef 23 ilçe listesinde yok (Anadolu değil ama şehir merkezine uzak); GSC verisi görülmeden silinmez/taşınmaz | — |
| `/avcilar-hidrofor-servis/` (blog yazısı) | `/avcilar-wilo-hidrofor-servisi/` | 301 | Düşük | Tekil blog yazısı, ilçe sayfasıyla örtüşüyor | 301 |
| — (yok) | `/kazan-servisi/` | YENİ SAYFA | — | P0-3: eski sitede dedicated URL yoktu, yeni sayfa oluşturuldu | — |
| — (yok) | `/kombi-servisi/` | YENİ SAYFA | — | Aynı, eski sitede dedicated URL yoktu | — |
| — (yok) | `/otomasyon-servisi/` | YENİ SAYFA | — | P0-3: yeni onaylanmış hizmet | — |
| — (yok, sadece homepage başlığı) | — | N/A | — | Brülör: dedicated URL hiç yoktu, yönlendirilecek bir şey yok | — |
| — (yok, homepage bullet) | — | N/A | — | Beyaz Eşya: dedicated URL hiç yoktu, kapsam dışı | — |

**Not — Anadolu Yakası:** Eski sitede Anadolu Yakası'na özel bir sayfa **bulunmadı** (39 URL'lik envanterde hiçbiri Anadolu ilçesi hedeflemiyordu) — bu nedenle "Anadolu Yakası sayfalarını taşımayın" maddesi için ayrıca bir aksiyon gerekmiyor, zaten hiç yoktu.

---

## Redirect Kuralları (uygulama aşaması için)

1. **Zincir yok:** Her redirect doğrudan A→C, asla A→B→C.
2. **Alakasız toplu yönlendirme yok:** Hiçbir eski URL, sırf kolay diye ana sayfaya atılmadı — her biri ya KEEP ya en yakın konu eşleşmesine 301.
3. **Tip:** Tüm yönlendirmeler **301 (kalıcı)** — 302 (geçici) kullanılmaz, arama motoru sinyal aktarımı için 301 gerekir.
4. **Uygulama yeri:** WordPress'te bir yönlendirme eklentisi (örn. Redirection) veya `.htaccess`/host seviyesi kural — bu implementasyonun kapsamında **kurulmadı**.
5. **GSC teyidi olmadan kesin karar yok:** "301 (birleştir)" olarak işaretli duplicate çiftler, gerçek Search Console trafik/index verisi görülmeden **kesinleştirilmemiştir** — bu tablo başlangıç önerisidir.

---

*Hiçbir redirect bu rapor sırasında canlıda uygulanmadı.*
