<?php

it('can execute solutions on a local environment with debugging enabled', function () {
    app()['env'] = 'local';
    config()->set('app.debug', true);
    config()->set('ignition.enable_runnable_solutions', true);

    $this
        ->postJson(route('ignition.executeSolution'), solutionPayload())
        ->assertSuccessful();
});

it('wont execute solutions on a production environment', function () {
    app()['env'] = 'production';
    config()->set('app.debug', true);

    $this
        ->postJson(route('ignition.executeSolution'), solutionPayload())
        ->assertStatus(404);
});

it('will execute solutions on a production environment if the IGNITION_ENABLE_RUNNABLE_SOLUTIONS env var is true and app.debug is true', function () {
    app()['env'] = 'production';
    config()->set('app.debug', true);
    config()->set('ignition.enable_runnable_solutions', true);

    $this
        ->postJson(route('ignition.executeSolution'), solutionPayload())
        ->assertSuccessful();
});

it('wont execute solutions on a production environment if the IGNITION_ENABLE_RUNNABLE_SOLUTIONS env var is true but app.debug is false', function () {
    app()['env'] = 'production';
    config()->set('app.debug', false);
    config()->set('ignition.enable_runnable_solutions', true);

    $this
        ->postJson(route('ignition.executeSolution'), solutionPayload())
        ->assertStatus(404);
});

it('wont execute solutions when debugging is disabled', function () {
    app()['env'] = 'local';
    config()->set('app.debug', false);

    $this
        ->postJson(route('ignition.executeSolution'), solutionPayload())
        ->assertNotFound();
});

it('wont execute solutions for a non local ip', function () {
    app()['env'] = 'local';
    config()->set('app.debug', true);
    $this->withServerVariables(['REMOTE_ADDR' => '138.197.187.74']);

    $this
        ->postJson(route('ignition.executeSolution'), solutionPayload())
        ->assertForbidden();
});


function solutionPayload(): array
{
    return [
        'parameters' => [
            'variableName' => 'test',
            'viewFile' => 'resources/views/welcome.blade.php',
        ],
        'solution' => 'Spatie\\LaravelIgnition\\Solutions\\MakeViewVariableOptionalSolution',
    ];
}
