# siswa-pendaftaran
siswa-pendaftaran


### install via composer
```bash
composer require bantenprov/siswa-pendaftaran:dev-master
```

### edit `config/app.php`

```php
'providers' => [
    Bantenprov\SiswaPendaftaran\SiswaPendaftaranServiceProvider::class,
```

### artisan command

```bash
php artisan vendor:publish --tag=siswa-pendaftaran-assets
```
