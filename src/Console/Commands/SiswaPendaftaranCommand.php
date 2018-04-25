<?php namespace Bantenprov\SiswaPendaftaran\Console\Commands;

use Illuminate\Console\Command;

use File;
/**
 * The SiswaPendaftaranCommand class.
 *
 * @package Bantenprov\SiswaPendaftaran
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaPendaftaranCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:siswa-pendaftaran-install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup command for Bantenprov\SiswaPendaftaran package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->files = (Object) [
            'api' => [
                'stub' => 'api.stub',
                'file_put_location' => base_path().'/routes/api.php'
            ],
            'LoginController' => [
                'stub' => 'LoginController.stub',
                'file_put_location' => app_path().'/Http/Controllers/Auth/LoginController.php'
            ],
            'ProfileController' => [
                'stub' => 'ProfileController.stub',
                'file_put_location' => app_path().'/Http/Controllers/Settings/ProfileController.php'
            ],
            'RegisterController' => [
                'stub' => 'RegisterController.stub',
                'file_put_location' => app_path().'/Http/Controllers/Auth/RegisterController.php'
            ],

            'DataAkademik' => [
                'stub' => 'DataAkademik.stub',
                'file_put_location' => app_path().'/DataAkademik.php'
            ],

            'Nilai' => [
                'stub' => 'Nilai.stub',
                'file_put_location' => app_path().'/Nilai.php'
            ],

            'Siswa' => [
                'stub' => 'Siswa.stub',
                'file_put_location' => app_path().'/Siswa.php'
            ],

            'Akademik' => [
                'stub' => 'Akademik.stub',
                'file_put_location' => app_path().'/Akademik.php'
            ],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->putFileContent($this->files->api['file_put_location'], $this->getStubFileContent($this->files->api['stub']));

        $this->info('change file content api.php success');

        $this->putFileContent($this->files->LoginController['file_put_location'], $this->getStubFileContent($this->files->LoginController['stub']));

        $this->info('change file content LoginController.php success');

        $this->putFileContent($this->files->ProfileController['file_put_location'], $this->getStubFileContent($this->files->ProfileController['stub']));

        $this->info('change file content ProfileController.php success');

        $this->putFileContent($this->files->RegisterController['file_put_location'], $this->getStubFileContent($this->files->RegisterController['stub']));

        $this->info('change file content RegisterController.php success');

        $this->putFileContent($this->files->DataAkademik['file_put_location'], $this->getStubFileContent($this->files->DataAkademik['stub']));

        $this->info('change file content DataAkademik.php success');

        $this->putFileContent($this->files->Nilai['file_put_location'], $this->getStubFileContent($this->files->Nilai['stub']));

        $this->info('change file content Nilai.php success');

        $this->putFileContent($this->files->Siswa['file_put_location'], $this->getStubFileContent($this->files->Siswa['stub']));

        $this->info('change file content Siswa.php success');

        $this->putFileContent($this->files->Akademik['file_put_location'], $this->getStubFileContent($this->files->Akademik['stub']));

        $this->info('change file content Akademik.php success');
    }

    public function getStubFileContent($file_name)
    {
        return File::get(__DIR__.'/../../stubs/'.$file_name);
    }

    public function putFileContent($path, $content)
    {
        return File::put($path, $content);
    }
}
