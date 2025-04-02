<?php
namespace Ibrahima\OrangeMoney;

use Illuminate\Support\ServiceProvider;

class OrangeMoneyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/orange_money.php', 'orange_money');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/orange_money.php' => config_path('orange_money.php'),
        ]);
    }
}