<?php

use Illuminate\Container\Container;
use Spatie\Ignition\Config\IgnitionConfig;

it('does not enable runnable solutions in debug mode by default', function () {
    config()->set('app.debug', true);

    $config = new IgnitionConfig([]);

    expect($config->runnableSolutionsEnabled())->toBeFalse();
});

it('disables runnable solutions in production mode', function () {
    config()->set('app.debug', false);

    $config = new IgnitionConfig([]);

    expect($config->runnableSolutionsEnabled())->toBeFalse();
});

it('prioritizes config value over debug mode', function () {
    config()->set('app.debug', true);

    $config = new IgnitionConfig([
        'enable_runnable_solutions' => false,
    ]);

    expect($config->runnableSolutionsEnabled())->toBeFalse();
});

it('disables share report when app has not finished booting', function () {
    $bootingApp = $this->resolveApplication();
    $this->resolveApplicationBindings($bootingApp);
    $this->resolveApplicationExceptionHandler($bootingApp);
    $this->resolveApplicationCore($bootingApp);
    $this->resolveApplicationConfiguration($bootingApp);
    $this->resolveApplicationHttpKernel($bootingApp);
    $this->resolveApplicationConsoleKernel($bootingApp);

    Container::setInstance($bootingApp);

    $config = new IgnitionConfig([]);

    expect($config->shareButtonEnabled())->toBeFalse();
});
