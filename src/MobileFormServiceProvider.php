<?php

namespace Hanson\MobileForm;

use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class MobileFormServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(MobileForm $extension)
    {
        if (! MobileForm::boot()) {
            return ;
        }

        Form::extend('mobileCode', MobileCode::class);

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'mobile-form');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/hanson/mobile-form')],
                'mobile-form'
            );
        }
    }
}
