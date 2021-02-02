<?php

/**
 * Part of the Connectus Laravel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Connectus Laravel
 * @version    1.0.0
 * @author     Jose Lorente
 * @license    BSD License (3-clause)
 * @copyright  (c) 2019, Jose Lorente
 */

namespace Jlorente\Laravel\Connectus;

use Jlorente\Connectus\Connectus;
use Illuminate\Support\ServiceProvider;

/**
 * Class ConnectusServiceProvider.
 * 
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 */
class ConnectusServiceProvider extends ServiceProvider
{

    /**
     * @inheritdoc
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/connectus.php' => config_path('connectus.php'),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->registerConnectus();
    }

    /**
     * {@inheritDoc}
     */
    public function provides()
    {
        return [
            'connectus'
            , Connectus::class
        ];
    }

    /**
     * Register the Connectus API class.
     *
     * @return void
     */
    protected function registerConnectus()
    {
        $this->app->singleton('connectus', function ($app) {
            $config = $app['config']->get('connectus');
            return new Connectus(
                    isset($config['api_key']) ? $config['api_key'] : null
                    , isset($config['account_id']) ? $config['account_id'] : null
                    , isset($config['request_retries']) ? $config['request_retries'] : null
            );
        });

        $this->app->alias('connectus', Connectus::class);
    }

}
