<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;
use Illuminate\Testing\TestView;
use Livewire\Component;
use Livewire\Mechanisms\ComponentRegistry;
use PHPUnit\Framework\Assert;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (($this->app->environment(['local', 'testing']) || $this->app->runningUnitTests()) && ! TestResponse::hasMacro('assertSeeLivewire')) {
            TestResponse::macro('assertSeeLivewire', function ($component) {
                if (is_subclass_of($component, Component::class)) {
                    $component = app(ComponentRegistry::class)->getName($component);
                }

                $escapedComponentName = trim(htmlspecialchars(json_encode(['name' => $component])), '{}');

                Assert::assertStringContainsString(
                    $escapedComponentName,
                    $this->getContent(),
                    'Cannot find Livewire component ['.$component.'] rendered on page.'
                );

                return $this;
            });

            TestResponse::macro('assertDontSeeLivewire', function ($component) {
                if (is_subclass_of($component, Component::class)) {
                    $component = app(ComponentRegistry::class)->getName($component);
                }

                $escapedComponentName = trim(htmlspecialchars(json_encode(['name' => $component])), '{}');

                Assert::assertStringNotContainsString(
                    $escapedComponentName,
                    $this->getContent(),
                    'Found Livewire component ['.$component.'] rendered on page.'
                );

                return $this;
            });

            if (class_exists(TestView::class)) {
                TestView::macro('assertSeeLivewire', function ($component) {
                    if (is_subclass_of($component, Component::class)) {
                        $component = app(ComponentRegistry::class)->getName($component);
                    }

                    $escapedComponentName = trim(htmlspecialchars(json_encode(['name' => $component])), '{}');

                    Assert::assertStringContainsString(
                        $escapedComponentName,
                        $this->rendered,
                        'Cannot find Livewire component ['.$component.'] rendered on page.'
                    );

                    return $this;
                });

                TestView::macro('assertDontSeeLivewire', function ($component) {
                    if (is_subclass_of($component, Component::class)) {
                        $component = app(ComponentRegistry::class)->getName($component);
                    }

                    $escapedComponentName = trim(htmlspecialchars(json_encode(['name' => $component])), '{}');

                    Assert::assertStringNotContainsString(
                        $escapedComponentName,
                        $this->rendered,
                        'Found Livewire component ['.$component.'] rendered on page.'
                    );

                    return $this;
                });
            }
        }
    }
}
