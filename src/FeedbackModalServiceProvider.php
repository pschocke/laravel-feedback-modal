<?php

namespace pschocke\FeedbackModal;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FeedbackModalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/feedback-modal'),
            ], 'views');
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('views/vendor/feedback-modal'),
            ], 'translations');

            $migrationFileName = 'create_anonymous_feedback_table.php';

            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'feedback-modal');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'feedback-modal');

        Livewire::component('feedback-modal', FeedbackModalComponent::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/feedback-modal.php', 'feedback-modal');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
