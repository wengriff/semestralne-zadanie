<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelIgnition\ContextProviders\LaravelLivewireRequestContextProvider;
use Spatie\LaravelIgnition\Tests\TestClasses\FakeLivewireManager;

beforeEach(function () {
    $this->livewireManager = FakeLivewireManager::setUp();
});

it('returns the referer url and method', function () {
    $context = createRequestContext([
        'path' => 'referred',
        'method' => 'GET',
    ]);

    $request = $context->getRequest();

    expect($request['url'])->toBe('http://localhost/referred');
    expect($request['method'])->toBe('GET');
});

it('returns livewire component information', function () {
    $alias = 'fake-component';
    $class = 'fake-class';

    $this->livewireManager->fakeAliases[$alias] = $class;

    $context = createRequestContext([
        'path' => 'http://localhost/referred',
        'method' => 'GET',
        'id' => $id = uniqid(),
        'name' => $alias,
    ]);

    $livewire = $context->toArray()['livewire'];

    expect($livewire['component_id'])->toBe($id);
    expect($livewire['component_alias'])->toBe($alias);
    expect($livewire['component_class'])->toBe($class);
});

it('returns livewire component information when it does not exist', function () {
    $context = createRequestContext([
        'path' => 'http://localhost/referred',
        'method' => 'GET',
        'id' => $id = uniqid(),
        'name' => $name = 'fake-component',
    ]);

    $livewire = $context->toArray()['livewire'];

    expect($livewire['component_id'])->toBe($id);
    expect($livewire['component_alias'])->toBe($name);
    expect($livewire['component_class'])->toBeNull();
});

it('removes ids from update payloads', function () {
    $context = createRequestContext([
        'path' => 'http://localhost/referred',
        'method' => 'GET',
        'id' => $id = uniqid(),
        'name' => $name = 'fake-component',
    ], [
        [
            'type' => 'callMethod',
            'payload' => [
                'id' => 'remove-me',
                'method' => 'chang',
                'params' => ['a'],
            ],
        ],
    ]);

    $livewire = $context->toArray()['livewire'];

    expect($livewire['component_id'])->toBe($id);
    expect($livewire['component_alias'])->toBe($name);
    expect($livewire['component_class'])->toBeNull();
});

it('combines data into one payload', function () {
    $context = createRequestContext([
        'path' => 'http://localhost/referred',
        'method' => 'GET',
        'id' => uniqid(),
        'name' => 'fake-component',
    ], [], [
        'data' => [
            'string' => 'Ruben',
            'array' => ['a', 'b'],
            'modelCollection' => [],
            'model' => [],
            'date' => '2021-11-10T14:20:36+0000',
            'collection' => ['a', 'b'],
            'stringable' => 'Test',
            'wireable' => ['a', 'b'],
        ],
        'dataMeta' => [
            'modelCollections' => [
                'modelCollection' => [
                    'class' => 'App\\\\Models\\\\User',
                    'id' => [1, 2, 3, 4],
                    'relations' => [],
                    'connection' => 'mysql',
                ],
            ],
            'models' => [
                'model' => [
                    'class' => 'App\\\\Models\\\\User',
                    'id' => 1,
                    'relations' => [],
                    'connection' => 'mysql',
                ],
            ],
            'dates' => [
                'date' => 'carbonImmutable',
            ],
            'collections' => [
                'collection',
            ],
            'stringables' => [
                'stringable',
            ],
            'wireables' => [
                'wireable',
            ],
        ],
    ]);

    $livewire = $context->toArray()['livewire'];

    $this->assertEquals([
        "string" => "Ruben",
        "array" => ['a', 'b'],
        "modelCollection" => [
            "class" => "App\\\\Models\\\\User",
            "id" => [1, 2, 3, 4],
            "relations" => [],
            "connection" => "mysql",
        ],
        "model" => [
            "class" => "App\\\\Models\\\\User",
            "id" => 1,
            "relations" => [],
            "connection" => "mysql",
        ],
        "date" => "2021-11-10T14:20:36+0000",
        "collection" => ['a', 'b'],
        "stringable" => "Test",
        "wireable" => ['a', 'b'],
    ], $livewire['data']);
});

// Helpers
function createRequestContext(array $fingerprint, array $updates = [], array $serverMemo = []): LaravelLivewireRequestContextProvider
{
    $providedRequest = null;

    Route::post('livewire', function (Request $request) use (&$providedRequest) {
        $providedRequest = $request;
    })->name('livewire.message');

    test()->postJson('livewire', [
        'fingerprint' => $fingerprint,
        'serverMemo' => $serverMemo,
        'updates' => $updates,
    ]);

    return new LaravelLivewireRequestContextProvider($providedRequest, test()->livewireManager);
}
