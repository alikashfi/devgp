<?php

namespace App\Providers;

use App;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Request::macro('validatedExcept', function (string|array $excepts = []) {
            return \Arr::except($this->validated(), (array) $excepts);
        });

        JsonResource::withoutWrapping();

        App::macro('isTest', fn() => false);
        $this->handleTestEnvironment();
    }

    /**
     * if url is test.site.com it switches to test database with dummy data.
     * and switches Storage to test_images to also separate images.
     */
    public function handleTestEnvironment()
    {
        $url = 'https://' . request()->getHttpHost();

        if ($url !== env('TEST_URL')) // $url example: https://test.site.com
            return;

        config([
            'database.default' => 'test_mysql',
            'filesystems.default' => 'test_images',
            'app.asset_url' => $url,
            'l5-swagger.defaults.constants.L5_SWAGGER_CONST_HOST' => $url . '/api/v1'
        ]);

        App::macro('isTest', fn() => true);
    }
}
