<?php namespace Bantenprov\SiswaPendaftaran\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The SiswaPendaftaran facade.
 *
 * @package Bantenprov\SiswaPendaftaran
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaPendaftaran extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'siswa-pendaftaran';
    }
}
