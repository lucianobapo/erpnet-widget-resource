<?php

/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 24/08/16
 * Time: 02:23
 */
namespace ErpNET\WidgetResource\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Collective\Html\FormFacade as Form;

class ErpnetWidgetResourceServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        AliasLoader::getInstance()->alias("Form", \Collective\Html\FormFacade::class);

        $this->app->bind('trans', function ($app, $params) {
            return trans('general.'.$params[0], isset($params[1])?$params[1]:[]);
        });

        Form::component('widgetText', 'erpnetWidgetResource::components.form.text',
            ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('widgetSelect', 'erpnetWidgetResource::components.form.select',
            ['name', 'label' => null, 'value' => null, 'attributes' => [], 'data' => [] ]);
        Form::component('widgetCheckbox', 'erpnetWidgetResource::components.form.checkbox',
            ['name', 'label' => null, 'value' => null, 'attributes' => [], 'checked' => false]);
        Form::component('widgetFile', 'erpnetWidgetResource::components.form.file',
            ['name', 'label' => null, 'value' => null, 'attributes' => []]);

        $projectRootDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
        $configPath = $projectRootDir . 'config/erpnetWidgetResource.php';
        $this->mergeConfigFrom($configPath, 'erpnetWidgetResource');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $projectRootDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;

        $this->loadViewsFrom($projectRootDir.'resources/views', 'erpnetWidgetResource');

        $this->publishes([
            $projectRootDir.'config/erpnetWidgetResource.php' => config_path('erpnetWidgetResource.php'),
        ], 'config');
        $this->publishes([
            $projectRootDir.'node_modules/font-awesome/fonts' => public_path('fonts'),
        ], 'fonts');
        $this->publishes([
            $projectRootDir.'resources/views' => base_path('resources/views/vendor/erpnetWidgetResource'),
        ], 'views');

    }
}