<?php

namespace Dotim\CP\Providers;

use Dotim\CP\ViewComponents\Card;
use Dotim\CP\ViewComponents\Form;
use Dotim\CP\ViewComponents\Input;
use Dotim\CP\ViewComponents\Select;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ControlPanelServiceProvider extends ServiceProvider
{
    /**
     * Control panel config.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('control-panel', function () {
            return new \Dotim\CP\ControlPanel($this->config());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // get control panel config form config file.
        $this->config = $this->config();

        // map control panel routes file.
        $this->mapRoutes();

        // map control panel publishes files.
        $this->mapPublishes();

        // Load control panel views.
        $this->loadViewsFrom(__DIR__ . '/../Views', 'control-panel');

        // load control panel blade components.
        $this->loadViewComponentsAs('control-panel', [Card::class, Input::class, Form::class, Select::class]);

        // Get control panel instance
        $controlPanel = $this->app->get('control-panel');

        // add items in information category,
        $controlPanel->addItem(
            __('Information'), __('Server Information'), "/server-information"
        );

        $controlPanel->addItem(
            __('Information'), __('PHP info'), "/php-info"
        );
    }

    /**
     * Define the publishes for application.
     *
     * @return void
     */
    private function mapPublishes()
    {
        // Register config file publishes
        $this->publishes([
            __DIR__ . '/../Config/control-panel.php' => config_path('control-panel.php')
        ], 'control panel config');

        // Register routes file publishes
        $this->publishes([
            __DIR__ . '/../Routes/control-panel.php' => $this->config['routes-file']
        ], 'control panel routes');

        // Register control panel views publishes
        $this->publishes([
            __DIR__ . '/../Views' => resource_path('views/vendor/control-panel'),
        ], 'control panel views');

        // Register control panel Assets publishes
        $this->publishes([
            __DIR__ . '/../Assets' => resource_path('assets/control-panel'),
            __DIR__ . '/../Dist' => public_path('assets/control-panel'),
        ], 'control panel assets');
    }

    /**
     * Define the routes for the control panel form routes file.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    private function mapRoutes()
    {
        $routesPath = __DIR__ . '/../Routes/control-panel.php';

        if (file_exists($this->config['routes-file'])) {
            $routesPath = $this->config['routes-file'];
        }

        Route::middleware($this->config['middleware'])
            ->namespace($this->config['namespace'])
            ->prefix($this->config['url'])
            ->group($routesPath);
    }

    /**
     * Get control panel config.
     *
     * @return array|string|object
     */
    private function config()
    {
        if (!config('control-panel')) {
            config(['control-panel' => (array)require_once __DIR__ . '/../Config/control-panel.php']);
        }

        return config('control-panel');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['control-panel'];
    }
}
