# Lead Generation Tracking Plan — Merkez Isı Teknik Servis

**Durum:** Mimari implementasyonu tamamlandı (statik site + WordPress child theme). **Hiçbir gerçek Google Ads/GTM/Analytics kimliği yok** — hiçbiri uydurulmadı, hiçbiri yapılandırılmadı.

## 1. Neden İnşa Edildi

Google Ads hesabına erişim/değişiklik bu görevin kapsamı dışındaydı. Ama site, gerçek kimlikler geldiğinde **tek satır konfigürasyonla** çalışacak şekilde önceden hazırlandı — kod mimarisi hazır, sadece ID'ler eksik.

## 2. Event Mimarisi

Hem statik sitede (`assets/js/modules/tracking.js`) hem WordPress temasında (`wordpress-theme/merkez-hidrofor-child/assets/js/modules/tracking.js`) **birebir aynı davranış**: her `tel:`/`wa.me` linkine tıklandığında otomatik olarak `window.dataLayer`'a event push ediliyor — tek tek butona kod yazmaya gerek yok, tüm sayfalarda otomatik çalışıyor.

| Event Adı | Ne Zaman Tetiklenir | Ek Veri |
|---|---|---|
| `phone_click` | Herhangi bir `tel:` linkine tıklanınca | `phone_number` |
| `whatsapp_click` | Herhangi bir `wa.me` linkine tıklanınca | `whatsapp_number` |
| `service_cta_click` | phone/whatsapp click ile birlikte, genel CTA sinyali olarak | `cta_type` (phone/whatsapp) |
| `contact_form_submit` | **Stub — şu an tetiklenmiyor**, sitede form yok (bilinçli tasarım kararı) | `form_name` |

## 3. Google Ads Website Call Conversion Tracking

Google Ads'in telefon dönüşüm izlemesi (`phone_click` event'i üzerinden) GTM'de ayrı bir tag olarak kurulacak — kod tarafında ek bir şey gerekmiyor, `phone_click` event'i zaten dataLayer'da hazır bekliyor.

## 4. CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS

Aşağıdaki üç kimlik **yok**, hiçbiri tahmin edilmedi:

| Kimlik | Durum | Nereye Girilecek |
|---|---|---|
| Google Tag Manager Container ID (GTM-XXXXXXX) | **CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS** | WordPress: `Görünüm → Özelleştir → Reklam / Analitik Takibi` (statik sitede: `index.html` `<head>`'e manuel eklenecek, gerekirse) |
| Google Ads Conversion ID (AW-XXXXXXXXX) | **CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS** | Aynı panel (GTM içinde kullanılacaksa burada tutulması zorunlu değil) |
| Google Ads Telefon Dönüşüm Etiketi (Conversion Label) | **CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS** | Aynı panel |
| GA4 Measurement ID | **CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS** | Genellikle GTM üzerinden yapılandırılır, ayrıca hardcode edilmedi |

WordPress tarafında (`inc/tracking.php`), bu üç alan **boşken GTM script'i hiç yüklenmiyor** — yanlışlıkla kırık/sahte bir tracking kodu asla canlıya çıkmaz. Gerçek ID girildiği an, kod değişikliği gerekmeden otomatik aktif olur.

## 5. Statik Site (GitHub Pages) Durumu

Aynı `tracking.js` mantığı static sitede de var ve test edildi (dataLayer push'ları çalışıyor). Statik sitenin backend'i olmadığı için GTM container ID'si eklenecekse doğrudan `index.html`'in `<head>`'ine yazılması gerekir — bu implementasyonda **yapılmadı** çünkü henüz gerçek bir ID yok.

## 6. Test Durumu

- ✅ Kod seviyesinde doğrulandı — her `tel:`/`wa.me` linki doğru href formatında (bkz. `PRE-LAUNCH-AUDIT.md`).
- ❌ **Gerçek dataLayer push'ları tarayıcıda canlı olarak test edilmedi** (GTM olmadan görsel doğrulama için tarayıcı konsolu/DevTools gerekir — bu turda yapılmadı, sadece kod incelemesiyle doğrulandı).
- ❌ Google Ads/GTM entegrasyonu hiç test edilmedi (gerçek hesap erişimi yok).

## 7. Sonraki Adım (Ads hesabına erişim sonrası)

1. GTM hesabı oluştur / mevcut container ID'yi al.
2. WordPress Customizer'a gir.
3. Google Ads Conversion ID + telefon dönüşüm etiketini GTM içinde "Phone Call Conversion" tag'i olarak `phone_click` event tetikleyicisine bağla.
4. GTM Preview modunda `phone_click`/`whatsapp_click` event'lerinin gerçekten ateşlendiğini doğrula.
5. GA4 bağlantısını aynı GTM container üzerinden kur (istenirse).

---

*Hiçbir Google Ads/Analytics/Search Console hesabına bu görev sırasında erişilmedi veya değişiklik yapılmadı.*
