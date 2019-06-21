# Youtube Video Upload 

Arayüz vasıtasıyla cihazdan seçilen video'yu ffmpeg kütüphanesini kullanarak sıkıştıran ve youtube kanalına yükleyen bir uygulamadır.


### Kullanılan Teknolojiler
- php
- javascript
- css (bootstrap)
- mysql 
- ffmpeg


### Yüklemeler !

```sh
$ composer install
```

ve ya

```sh
$ composer require php-ffmpeg/php-ffmpeg
$ composer require google/apiclient:^2.0
```

# Gereksinimler
  - Youtube Data Api kullanabilmek için bir proje ve bir kimlik oluşturunuz ve kimlik bilgilerinin bulunduğu credential.json dosyasını güncelleyiniz (credential.json direkt google console üzerinden indirebilirsiniz)
  - projenizin api kullanımını etkinleştiriniz
  - Dosya sıkıştırma işlemi için FFMPEG çalışır dosyalarının Ortam Değişkenlerinde bulunması gerekmektedir , buradan indirebilirsiniz http://ffmpeg.zeranoe.com/builds/.
  - video.sql dosyasını veritabanınıza dahil ediniz aksi halde video bilgileri kaydedildiği için hata alacaksınız
  - inc/globals.php dosyasından veritabanı bilgilerini düzenleyiniz
  
### Proje İşleyişi

 - Uygulamayı kullanabilmek için mutlaka bir google hesabı ile giriş yapılmalıdır aksi halde google giriş sayfasına yönlendirileceksiniz..
 - Arayüz vasıtası ile cihazdan bir dosya seçilir.
 - Seçilen dosyanın formatı (video olup olmadığı) ve isteğe bağlı olarak belirlenen kriterlere (boyut ve uzunluk) uygunluğu kontrol edilir.
 - Eğer seçilen dosya video ise ve gerekli alanlar doldurulduysa isteğe bağlı olarak kriter kontrolü yapılır
 - Eğer dosya kriterlere uygunsa istek oluşturulur ve işleyiş progress bar ile değil spinner ile izlenilir
  - Dosya yükleme esnasında isteğe bağlı olarak ffmpeg kütüphanesi kullanılarak boyutu sıkıştırılır ve geçici olarak bir dizine kaydedilir
  - Dosya kullanıcı girişi yapmış google hesabının youtube kanalına verilen bilgiler ile yüklenir
  - Dosya bilgileri yüklenen videonun id bilgisi ile birlikte veritabanına kaydedilir
  - Yüklenen videolar ve bilgileri menüdeki liste kısmına gidilerek görülebilir ve izlenebilir.



Projeyi şöyle deneyebilirsiniz:

  - gereksinimleri sağladıktan sonra
  - localhost:8000 portunda uygulamayı ayağa kaldırınız
  - google api yönetiminizde Yetkilendirilmiş JavaScript kaynaklarına  http://localhost:8000 
  -ve Yetkilendirilmiş yönlendirme URI'larına http://localhost:8000 izin veriniz
  - uygulama ilk çalıştığında google hesabınıza giriş ekranına yönlendirecektir ve giriş yaptıktan sonra video yükleme arayüzüne erişebilirsiniz.



### Proje Dizini Hakkında Bilgilendirme


| Dizin / Dosya | Açıklama |
| ------ | ------ |
| classes | veritabanı ve api kullanımı kolaylığı için hazırlanan yardımcı sınıflar bu dizinde bulunmaktadır.|
| inc | global sabitleri , get post gibi işlemlerde yardımcı fonksiyonları ve cihaza video yüklemek için kolaylaştırıcı fonksiyonlar içerir. |
| model | video bilgilerinin kayıt ve tutulmasında yardımcı video model sınıfını içerir. |
| scripts | önyüzdeki dinamiklik için front.js ve video format kontrolü kriter kontrolü ve video yükleme için istek oluşturma gibi işlemleri barındıran upload.js script dosyalarından oluşur.  |
| vendor | api ve ffmpeg kütüphaneleri bu dizindedir. |
| videos | videos dizini altındaki temp klasörü anlık olarak ffmpeg kullanılarak sıkıştırılmış olan dosyanın kaydedildiği dizindir ve eğer kullanıcı, dosyanın sıkıştırılmasını istediyse video youtube'a yüklenirken bu dizinden yüklenilir aksi halde tmp alanından yüklenilir. Bu dizinde yalnız son yüklenen dosya kayıtlıdır.
| view | projenin iki arayüzü olan dosya yükleme formunu içeren upload.view.php ve yüklenen dosyaları listeleyen list.view.php görünüm dosyalarından oluşur.
| composer.json | gerekli kütüphaneleri barındıran vendor dizinini oluşturmak için kullanılır
| credentials.json | api kimlik bilgilerini içerir
| include.php | inc dizinindeki dosyaları projeye dahil eder
| index.php | proje ana dizinidir google login ardından projeye yönlendirme vesair yönlendirmeler buraya yapılır kullanıcı giriş kontrolü ile gerekli dosyaları dahil eder veya yönlendirir
| logout.php | oluşturulan session'ı silerek google hesabından çıkış yapar 
| save.php | include.view.php dosyası ve upload.js scripti kullanılarak oluşturulan istek buraya gelir ve gerekli işlemler yapılarak video gerekse sıkıştırılır ve youtube kanalına kaydedilir.



### Hatalar

 - FFMPEG kullanılan methodu kontrol edilmeli dosya formatlanıyor kaydediliyor fakat sıkıştırma istenilen sonucu vermiyor



projeyi şöyle çalıştırabilirsiniz

```sh
php -S localhost:8000
```

projeyi şu adresten izleyebilirsiniz

```sh
localhost:8000
```
