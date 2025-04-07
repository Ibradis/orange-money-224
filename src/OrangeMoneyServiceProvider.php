<?php

namespace Ibradis\OrangeMoney;

use Illuminate\Support\ServiceProvider;

class OrangeMoneyServiceProvider extends ServiceProvider
{
    /**
     * Enregistre les services de l'application.
     *
     * @return void
     */
    public function register()
    {
        // Fusionne la configuration personnalisée avec la configuration par défaut
        $this->mergeConfigFrom(
            __DIR__ . '/../config/orange_money.php', 'orange_money'
        );

        // Enregistre une instance singleton de la classe OrangeMoney
        $this->app->singleton(OrangeMoney::class, function ($app) {
            return new OrangeMoney();
        });

        // Facultatif : Enregistre une façade pour un accès plus simple
        $this->app->alias(OrangeMoney::class, 'OrangeMoney');
    }

    /**
     * Démarre les services de l'application.
     *
     * @return void
     */
    public function boot()
    {
        // Publie le fichier de configuration pour permettre sa personnalisation
        $this->publishes([
            __DIR__ . '/../config/orange_money.php' => config_path('orange_money.php'),
        ], 'config');
    }
}
