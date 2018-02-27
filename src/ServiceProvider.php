<?php

namespace AbelHalo\Preference;

use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $onPreferenceChanged = function () {
            /** @var Preference $preference */
            $preference = $this->app->make(Preference::class);

            $preference->clearCache();
        };

        Model::created($onPreferenceChanged);
        Model::updated($onPreferenceChanged);
        Model::deleted($onPreferenceChanged);
        Model::saved($onPreferenceChanged);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Preference::class];
    }
}
