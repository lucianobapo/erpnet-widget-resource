<?php

/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 24/08/16
 * Time: 02:23
 */
namespace ErpNET\WidgetResource\Providers;

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
//        $this->app->register(\Laravel\Socialite\SocialiteServiceProvider::class);

        $this->app->bind('trans', function ($app, $params) {
//            dd(func_get_args());
            return trans('general.'.$params[0], isset($params[1])?$params[1]:[]);
        });

        Form::component('widgetText', 'erpnetWidgetResource::components.form.text',
            ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('widgetCheckbox', 'erpnetWidgetResource::components.form.checkbox',
            ['name', 'label' => null, 'value' => null, 'attributes' => [], 'checked' => false]);
        Form::component('widgetFile', 'erpnetWidgetResource::components.form.file',
            ['name', 'label' => null, 'value' => null, 'attributes' => []]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'erpnetWidgetResource');

        $this->publishes([
//            __DIR__.'/../../config/erpnetWidgetResource.php' => config_path('erpnetWidgetResource.php'),
            __DIR__.'/../../resources/views' => base_path('resources/views/vendor/erpnetWidgetResource'),
//            __DIR__.'/Migrations' => base_path('database/migrations'),
        ]);

//        $this->app->config->set('auth.model', $this->app->config->get('easyAuthenticator.model'));

//        include __DIR__.'/routes.php';
    }
}