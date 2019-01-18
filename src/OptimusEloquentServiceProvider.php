<?php
/*
 * This file is part of Optimus Eloquent.
 *
 * (c) Nguyen Nhu Huy <huy@ses.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace nhuhuy\OptimusEloquent;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Optimus\Optimus;

class OptimusEloquentServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }


    /**
     * Register the factory class.
     * @return void
     */
    private function registerFactory()
    {
        $this->app->singleton('optimus.factory', function () {
           return new OptimusFactory();
        });
        $this->app->alias('optimus.factory', OptimusFactory::class);
    }

    /**
     * Register the manager class.
     * @return void
     */
    private function registerManager(): void
    {
        $this->app->singleton('optimus', function (Container $container) {
            $config = $container['config'];
            $factory = $container['optimus.factory'];
            return new OptimusManager($config, $factory);
        });
        $this->app->alias('optimus', OptimusManager::class);
    }
    /**
     * Register the bindings.
     * @return void
     */
    private function registerBindings(): void
    {
        $this->app->bind('optimus.connection', function (Container $container) {
            $manager = $container['optimus'];
            return $manager->connection();
        });
        $this->app->alias('optimus.connection', Optimus::class);
    }

    /**
     * Get the services provided.
     * @return array
     */
    public function provides(): array
    {
        return [
            'optimus',
            'optimus.factory',
            'optimus.connection'
        ];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $config = realpath($raw = __DIR__.'/../config/optimus.php') ?: $raw;
        $this->publishes([$config => config_path('optimus.php')]);
        $this->mergeConfigFrom($config, 'optimus');
    }
}
