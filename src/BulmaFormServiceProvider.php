<?php

namespace Isaac\BulmaForm;

use AdamWathan\Form\OldInput\IlluminateOldInputProvider;
use AdamWathan\Form\ErrorStore\IlluminateErrorStore;
use Illuminate\Support\ServiceProvider;
use AdamWathan\Form\FormBuilder;

class BulmaFormServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerErrorStore();
        $this->registerOldInput();
        $this->registerFormBuilder();
        $this->registerBasicFormBuilder();
        $this->registerBootForm();
    }

    protected function registerErrorStore()
    {
        $this->app['adamwathan.form.errorstore'] = $this->app->share(function ($app) {
            return new IlluminateErrorStore($app['session.store']);
        });
    }

    protected function registerOldInput()
    {
        $this->app['adamwathan.form.oldinput'] = $this->app->share(function ($app) {
            return new IlluminateOldInputProvider($app['session.store']);
        });
    }

    protected function registerFormBuilder()
    {
        $this->app['adamwathan.form'] = $this->app->share(function ($app) {
            $formBuilder = new FormBuilder;
            $formBuilder->setErrorStore($app['adamwathan.form.errorstore']);
            $formBuilder->setOldInputProvider($app['adamwathan.form.oldinput']);
            $formBuilder->setToken($app['session.store']->getToken());

            return $formBuilder;
        });
    }

    protected function registerBasicFormBuilder()
    {
        $this->app['bulmaform.basic'] = $this->app->share(function ($app) {
            return new BasicFormBuilder($app['adamwathan.form']);
        });
    }

    protected function registerBootForm()
    {
        $this->app['bulmaform'] = $this->app->share(function ($app) {
            return new BulmaForm($app['bulmaform.basic']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bulmaform'];
    }
}
