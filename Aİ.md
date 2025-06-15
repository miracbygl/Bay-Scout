
# Soru - Cevaplar

---

### Soru 1:
Veritabanında kullanıcı ve futbolcu tablosunda hangi sütunlar olmalı?

### Cevap 1:
**Kullanıcı Tablosu İçin Örnek Sütunlar:**  
- `user_id` (int, primary key, otomatik artan)  
- `username` (varchar)  
- `email` (varchar)  
- `password_hash` (varchar)  
- `created_at` (datetime)  
- `updated_at` (datetime)  

**Futbolcu Tablosu İçin Örnek Sütunlar:**  
- `player_id` (int, primary key, otomatik artan)  
- `name` (varchar)  
- `position` (varchar)  
- `team` (varchar)  
- `birth_date` (date)  
- `user_id` (int, foreign key, kullanıcı ile ilişki için)  

---

### Soru 2:
Bu tabloların arasında ilişki (1:N, N:N) nasıl olmalı?

### Cevap 2:
- Kullanıcı ile futbolcu tablosu arasında **1:N (birden çoğa) ilişki** uygun olur.  
- Bir kullanıcı birden fazla futbolcu kaydedebilir.  
- Bu yüzden futbolcu tablosunda `user_id` sütunu olur ve kullanıcıya bağlanır.

---

### Soru 3:
Veritabanına Mysqli ile nasıl bağlarım?

### Cevap 3:
```php
$servername = "localhost";
$username = "kullanici_adi";
$password = "sifre";
$dbname = "veritabani_adi";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Bağlantı hatası: " . $mysqli->connect_error);
}



### Soru 4:
Connection hatasında nasıl debug yaparım?

### Cevap 4:
MySQL bağlantısı sırasında hata alırsan aşağıdaki adımları izleyerek debug yapabilirsin:

- Bağlantı hatasını kontrol etmek için `connect_error` özelliğini kullan:
```php
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Bağlantı hatası: " . $mysqli->connect_error);
}



### Soru 5:
password_hash nasıl yapılır nasıl kullanılır?

### Cevap 5:
PHP'de kullanıcı şifresini güvenli bir şekilde saklamak için `password_hash()` fonksiyonu kullanılır. Bu fonksiyon, şifreyi karma (hash) haline getirir ve güvenli bir şekilde veritabanına kaydetmenizi sağlar.

---

#### Şifreyi hashlemek (güvenli hale getirmek) için:

```php
$plainPassword = "kullaniciSifresi123";  // Kullanıcının girdiği düz metin şifre
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);




### Soru 6:
PHP de veri ekleme nasıl yapılır?

### Cevap 6:

PHP’de MySQL veritabanına veri eklemek için `mysqli` veya `PDO` kullanılabilir. Burada `mysqli` ile örnek veriyorum.

---


### Soru 7:
Listeleme nasıl yapılır?

### Cevap 7:

PHP ve MySQL kullanarak veritabanından kayıtları çekip listelemek için aşağıdaki adımları takip edebilirsin.

---

#### 1. Veritabanına bağlan:

```php
$mysqli = new mysqli("localhost", "kullanici_adi", "sifre", "veritabani_adi");

if ($mysqli->connect_error) {
    die("Bağlantı hatası: " . $mysqli->connect_error);
}


#### Adım adım veri ekleme örneği:

1. **Veritabanına bağlantı kur:**

```php
$mysqli = new mysqli("localhost", "kullanici_adi", "sifre", "veritabani_adi");

if ($mysqli->connect_error) {
    die("Bağlantı hatası: " . $mysqli->connect_error);
}


### Soru 7:
Listeleme nasıl yapılır?

### Cevap 7:

PHP ve MySQL kullanarak veritabanından kayıtları çekip listelemek için aşağıdaki adımları takip edebilirsin.

---

#### 1. Veritabanına bağlan:

```php
$mysqli = new mysqli("localhost", "kullanici_adi", "sifre", "veritabani_adi");

if ($mysqli->connect_error) {
    die("Bağlantı hatası: " . $mysqli->connect_error);
}



### Soru 8:
Güncelleme ve silme (fonksiyonları örnekleri verir misin?)

### Cevap 8:

PHP ve MySQLi kullanarak veritabanında **güncelleme** ve **silme** işlemlerini nasıl yapabileceğine dair örnek fonksiyonlar:

---

## 1. Güncelleme Fonksiyonu Örneği

```php
function kullaniciGuncelle($mysqli, $id, $yeniUsername, $yeniEmail) {
    $sql = "UPDATE kullanici SET username = ?, email = ? WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    if ($stmt === false) {
        die("Hazırlama hatası: " . $mysqli->error);
    }

    $stmt->bind_param("ssi", $yeniUsername, $yeniEmail, $id);

    if ($stmt->execute()) {
        echo "Kullanıcı başarıyla güncellendi.";
    } else {
        echo "Güncelleme hatası: " . $stmt->error;
    }

    $stmt->close();
}



### Soru 9:
Bunları benim yapabilmem için adım adım öğretici bir şekilde anlatır mısın?

### Cevap 9:

Tabii! PHP ve MySQL ile temel CRUD işlemlerini (Veri Ekleme, Listeleme, Güncelleme, Silme) adım adım nasıl yapacağını öğreteyim.

---

## 1. Adım: Veritabanı Bağlantısı Oluştur

Öncelikle veritabanına bağlanmamız gerekiyor. Bunun için aşağıdaki kodu kullan:

```php
<?php
$mysqli = new mysqli("localhost", "kullanici_adi", "sifre", "veritabani_adi");

if ($mysqli->connect_error) {
    die("Bağlantı hatası: " . $mysqli->connect_error);
}
?>


### Soru 10:
Bootstrap kullanımını öğretir misin?

### Cevap 10:

Bootstrap, HTML, CSS ve JavaScript kullanarak responsive (duyarlı) ve şık web sayfaları oluşturmayı kolaylaştıran popüler bir front-end framework’üdür.

---

## 1. Bootstrap Nasıl Eklenir?

### a) CDN ile hızlı ekleme:

HTML dosyanızın `<head>` kısmına aşağıdaki satırı ekleyerek Bootstrap’i sayfanıza dahil edebilirsiniz.

```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



### Soru 11:
Bootstrap grid ve card nasıl oluşturulur?

### Cevap 11:

Bootstrap, web sayfası düzenini kolayca yapmak için **grid sistemi** ve içerik kutuları için **card bileşeni** sunar.

---

## 1. Bootstrap Grid Sistemi

Bootstrap grid sistemi, sayfayı 12 sütuna böler. Bu sütunları kullanarak responsive (farklı ekran boyutlarına uyumlu) tasarım yaparsın.

### Örnek: 3 eşit sütun

```html
<div class="container">
  <div class="row">
    <div class="col-md-4">Sütun 1</div>
    <div class="col-md-4">Sütun 2</div>
    <div class="col-md-4">Sütun 3</div>
  </div>
</div>


### Soru 12:
Listeyi daha şık ve temiz yapmak için örnek UI öner bana.

### Cevap 12:

Liste görünümünü daha şık ve kullanıcı dostu yapmak için Bootstrap ve bazı UI tasarım yaklaşımlarını kullanabilirsin. İşte birkaç öneri ve örnek:

---

## 1. Bootstrap List Group Kullanımı

Bootstrap’ın **List Group** bileşeni, liste öğelerini güzel ve tutarlı gösterir.

### Örnek:

```html
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Kullanıcı 1
    <span class="badge bg-primary rounded-pill">Aktif</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Kullanıcı 2
    <span class="badge bg-secondary rounded-pill">Pasif</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Kullanıcı 3
    <span class="badge bg-success rounded-pill">Online</span>
  </li>
</ul>


### Soru 13:
Local’de çalışan uygulamayı sunucuya taşıma nasıl yapılır?

### Cevap 13:

Local (yerel) bilgisayarında çalışan PHP-MySQL uygulamanı canlı bir sunucuya taşımak için şu adımları takip edebilirsin:

---

## 1. Dosyaları Hazırla

- Projendeki tüm dosyaları (PHP, HTML, CSS, JS vb.) bir klasöre topla.  
- Localde çalışırken kullandığın `config.php` gibi veritabanı bağlantı ayarlarının sunucuya uygun olduğundan emin ol. (Sunucu adresi, kullanıcı adı, şifre, veritabanı adı)

---

## 2. Veritabanını Dışa Aktar (Export)

- Localde kullandığın MySQL veritabanını dışa aktar.  
- PhpMyAdmin veya MySQL Workbench kullanıyorsan, veritabanını `.sql` dosyası olarak export et.

---

## 3. Canlı Sunucuya Dosyaları Yükle

- FTP programı (FileZilla, WinSCP vb.) veya hosting kontrol paneli üzerinden dosyalarını sunucuya yükle.  
- Genellikle `public_html` veya `www` klasörü ana dizindir.  
- Tüm projenin dosyalarını buraya yükle.

---

## 4. Veritabanını Sunucuya İçe Aktar (Import)

- Hosting kontrol panelindeki phpMyAdmin’e gir.  
- Yeni bir veritabanı oluştur veya hosting tarafından verilen veritabanını kullan.  
- Daha önce export ettiğin `.sql` dosyasını import et.

---

## 5. Veritabanı Bağlantı Ayarlarını Güncelle

- `config.php` gibi dosyalarda sunucu veritabanı bilgilerini güncelle:  
  ```php
  $servername = "sunucu_adresi";  // Genellikle localhost veya hosting tarafından verilen adres  
  $username = "sunucu_kullanici_adi";  
  $password = "sunucu_sifresi";  
  $dbname = "sunucu_veritabani_adi";

