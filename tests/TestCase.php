<?php

namespace pschocke\FeedbackModal\Tests;

use Illuminate\Support\Facades\Schema;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use pschocke\FeedbackModal\FeedbackModalServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/database/factories');

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        config()->set('app.locale', 'de');

        Schema::dropIfExists('dashboard_tiles');
        include_once __DIR__.'/../database/migrations/create_anonymous_feedback_table.php.stub';
        (new \CreateAnonymousFeedbackTable())->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FeedbackModalServiceProvider::class,
        ];
    }
}
