# siswa-pendaftaran
siswa-pendaftaran


### install via composer
```bash
composer require bantenprov/siswa-pendaftaran:dev-master
```

### edit `config/app.php`

```php
'providers' => [
    Laratrust\LaratrustServiceProvider::class,
    Bantenprov\SiswaPendaftaran\SiswaPendaftaranServiceProvider::class,
```

```php
'aliases' => [
    'Laratrust'   => Laratrust\LaratrustFacade::class,
```

### artisan command

```bash
php artisan vendor:publish --tag=siswa-pendaftaran-assets
```

```bash
php artisan laratrust:role
```

```bash
php artisan laratrust:permission
```

```
php artisan bantenprov:siswa-pendaftaran-install
```

### add to `.env`

```
DEFAULT_USER_ROLE=siswa
CHECK_NOMOR_UN=true
```
