<?php

namespace EvolutionCMS\EvoCustom;

use EvolutionCMS\EvoCustom\EvoCustomTemplateProcessor;
use EvolutionCMS\ServiceProvider;
use EvolutionCMS\TemplateProcessor;

class EvoCustomTemplateServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
      'EvolutionCMS\EvoCustom\Console\EvoCustomTemplateCommand'
    ];

    public function register()
    {
        //register command for Artisan
        $this->commands($this->commands);

        //change default TemplateProcessor
        $this->app->singleton('TemplateProcessor', function ($app) {
            return new EvoCustomTemplateProcessor($app);
        });
    }

}