# vehicle-tracking-system

1. git clone https://github.com/alionurr/vehicle-tracking-system.git
2. symfony cli kurulu değilse kurulması gerekiyor.
      curl -sS https://get.symfony.com/cli/installer | bash
3. symfony check:requirements komutunu çalıştırıp ortamın hazır olup olmadığını kontrol edelim.
4. composer install
5. env dosyasını düzenledikten sonra, symfony console doctrine:database:create komutunu çalıştırın
6. symfony server:start -d , bu komut ile server'ı başlatın
7. symfony console doctrine:schema:create , veritabanını oluşturun
8. symfony console doctrine:fixtures:load , projede varolan fixturesları yükleyerek örnek datalar oluşturun.
