<?php

namespace Stephynoe\ContactForm;

use Illuminate\Support\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //Publish the configuration file
        $this->publishes([
            __DIR__ . '/../config/config.php'=>config_path('contactform.php')
        ], 'contactform-config');


        // Check if tailwind exists and only check in local environment
        if ($this->app->environment('local')) {

            $packageJsonPath = base_path('package.json');

            if (file_exists($packageJsonPath)) {
                
                $packageJson = json_decode(file_get_contents($packageJsonPath), true);
                //$hasTailwind = isset($packageJson['dependencies']['tailwindcss']);
                $hasTailwind =
                    isset($packageJson['dependencies']['tailwindcss']) ||
                    isset($packageJson['devDependencies']['tailwindcss']);

                if (! $hasTailwind) {
                    echo '<div style="background-color:red;color:white;padding:5px"> Tailwind is not installed. <a href="https://tailwindcss.com/docs/installation/using-vite"><u>Install using vite</u></a> and import/configure it inside app.css</div>';
                }
            } 
        }


        //Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        //Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'contactform');

        //Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
