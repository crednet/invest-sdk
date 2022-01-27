<?php

namespace Credpal\CPInvest\Providers;

use Credpal\CPInvest\CPInvest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CPInvestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cpinvest', CPInvest::class);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/cpinvest.php',
            'cpinvest'
        );
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerRoutes()
            ->registerConfig()
            ->registerMigrations();
    }

    protected function registerConfig(): CPInvestServiceProvider
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/cpinvest.php' => config_path('cpinvest.php'),
            ], 'cpinvest');
        }

        return $this;
    }

    protected function registerMigrations(): CPInvestServiceProvider
    {
        if ($this->app->runningInConsole() && !class_exists('CreateCpInvestTenuresTable')) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/create_cp_invest_tenures_table.stub' =>
                    database_path('migrations/' . date('Y_m_d_His') . '_create_cp_invest_tenures_table.php'),
            ], 'migrations');
        }

        return $this;
    }

    protected function registerRoutes(): CPInvestServiceProvider
    {
        Route::group($this->routeConfiguration(), fn () => $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php'));

        return $this;
    }

    protected function routeConfiguration(): array
    {
        return [
            'prefix' => config('cpinvest.prefix'),
            'middleware' => config('cpinvest.middleware'),
            'namespace' => config('cpinvest.namespace'),
        ];
    }
}
