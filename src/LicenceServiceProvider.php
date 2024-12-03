<?php

namespace Marvelous\Licence;


use Illuminate\Support\ServiceProvider;
use Marvelous\Licence\Commands\LogaLicenceCommand;

class LicenceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LogaLicenceCommand::class
            ]);
        }
//        if ($this->app['request']->is('api/licence')) {
//            $id = $this->app['request']->input('id');
//            Licence::createLicence($id);
//        }

        $this->packagePublishes();

    }

    public function register()
    {

    }

    protected function packagePublishes(){
        $this->publishes([
            __DIR__ . '/config/loga-licence.php' => config_path('loga-licence.php'),
        ]);

        $this->publishes([
            __DIR__ . '/controllers/LicenceController.php' => base_path('app/Http/Controllers/LogaLicence/LicenceController.php'),
        ]);

        $this->publishes([
            __DIR__ . '/database/migrations/2024_07_09_084704_create_licences_table.php' => base_path('database/migrations/2024_07_09_084704_create_licences_table.php'),
        ]);
    }

}
