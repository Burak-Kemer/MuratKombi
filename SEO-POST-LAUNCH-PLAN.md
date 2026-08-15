# SEO Post-Launch Plan — Merkez Isı Teknik Servis

**Durum:** Planlama. Bu dosyadaki hiçbir adım henüz uygulanmadı — production'a geçiş sonrası içindir.

Site migration sonrası Google'ın yeniden tarama/indeksleme sürecinde **geçici sıralama dalgalanmaları olması normaldir** — bu, hatanın değil, migration sürecinin doğal bir parçasıdır. Aşağıdaki adımlar bu dalgalanmayı izlemek ve gerçek bir soruna işaret edip etmediğini ayırt etmek içindir.

## 1. Sitemap Gönder
Yeni sitemap'i (Yoast SEO'nun ürettiği, `URL-REDIRECT-MAP.md`'deki final URL setiyle uyumlu) Google Search Console → Sitemaps'e gönder. 301 verilen eski URL'ler sitemap'te **olmamalı**.

## 2. Ana Sayfa URL Inspection
`https://www.merkezhidrofor.com/` için URL Inspection çalıştır, "Request Indexing" ile yeniden taramayı hızlandır.

## 3. Kritik Hizmet URL Inspection
Öncelik sırasıyla: `/hidrofor-servisi/`, `/wilo-servisi/`, `/hidrofor-pompa-servisi/`, `/dalgic-pompa-tamiri/`, `/kazan-servisi/`, `/kombi-servisi/`, `/otomasyon-servisi/`, `/iletisim/`, `/hakkimizda/`.

## 4. Eski URL'lerin Redirect Testleri
`URL-REDIRECT-MAP.md`'deki her 301 satırını gerçek tarayıcıda test et — hedef URL doğru mu, zincir var mı (olmamalı), status code gerçekten 301 mi (302 değil).

## 5. 404 Takibi
Search Console → Coverage → "Not found (404)" raporunu ilk 2 hafta günlük, sonra haftalık kontrol et. Beklenmeyen bir 404 çıkarsa `URL-REDIRECT-MAP.md`'ye eklenmemiş bir eski URL olabilir.

## 6. Indexing Takibi
Coverage raporunda "Valid" sayfa sayısının eski sitenin indeksli sayfa sayısına (39 URL'lik envanterin index'lenmiş kısmı) yakınsamasını izle. Ani bir düşüş varsa (özellikle Hidrofor pillar sayfası) acil müdahale gerekir.

## 7. Performance Takibi
Search Console → Performance: toplam tıklama/gösterim trendini migration öncesi son 3 aya göre karşılaştır. İlk 2-4 hafta düşüş beklenir (normal); 6-8 haftadan sonra hâlâ toparlanmıyorsa redirect haritası gözden geçirilmeli.

## 8. Query Değişimleri
"hidrofor servisi", "wilo hidrofor", "merkez ısı" gibi marka+hizmet sorgularının hangi URL'de rank ettiğini izle — yanlış sayfa rank etmeye başlarsa (örn. ana sayfa yerine bir ilçe sayfası) canonical/iç link kontrolü gerekir.

## 9. CTR Takibi
Yeni title/meta description'ların (bkz. `MURAT-KOMBI-SITE-AUDIT.md` P0.4) CTR'ı eski sitenin CTR'ına göre nasıl değiştiğini izle.

## 10. Coverage / Indexing Sorunları
"Excluded" sekmesinde "Duplicate without user-selected canonical" veya "Crawled - currently not indexed" gibi durumları izle — özellikle duplicate çiftlerin (Wilo, ilçe) 301 sonrası temiz görünüp görünmediğini doğrula.

---

*Bu plan sadece production'a geçiş SONRASI uygulanacaktır. Şu an Search Console'da hiçbir değişiklik yapılmadı.*
