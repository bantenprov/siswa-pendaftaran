<?php namespace Bantenprov\SiswaPendaftaran;

use Illuminate\Support\ServiceProvider;
use Bantenprov\SiswaPendaftaran\Console\Commands\SiswaPendaftaranCommand;

/**
 * The SiswaPendaftaranServiceProvider class
 *
 * @package Bantenprov\SiswaPendaftaran
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaPendaftaranServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Bootstrap handles
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
        $this->migrationHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('siswa-pendaftaran', function ($app) {
            return new SiswaPendaftaran;
        });

        $this->app->singleton('command.siswa-pendaftaran', function ($app) {
            return new SiswaPendaftaranCommand;
        });

        $this->commands('command.siswa-pendaftaran');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'siswa-pendaftaran',
            'command.siswa-pendaftaran',
        ];
    }

    /**
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle()
    {
        $packageConfigPath = __DIR__.'/config/config.php';
        $appConfigPath     = config_path('siswa-pendaftaran.php');

        $this->mergeConfigFrom($packageConfigPath, 'siswa-pendaftaran');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle()
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'siswa-pendaftaran');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/siswa-pendaftaran'),
        ], 'lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle()
    {
        $packageViewsPath = __DIR__.'/resources/views';

        $this->loadViewsFrom($packageViewsPath, 'siswa-pendaftaran');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/siswa-pendaftaran'),
        ], 'views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle()
    {
        $packageAssetsPath = __DIR__.'/resources/assets';

        $this->publishes([
            $packageAssetsPath => resource_path('assets'),
        ], 'siswa-pendaftaran-assets');
    }

    /**
     * Publishing package's migrations
     *
     * @return void
     */
    protected function migrationHandle()
    {
        $packageMigrationsPath = __DIR__.'/database/migrations';

        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], 'migrations');
    }
}
