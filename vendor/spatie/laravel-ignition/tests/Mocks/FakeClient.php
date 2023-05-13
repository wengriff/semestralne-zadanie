<?php

namespace Spatie\LaravelIgnition\Tests\Mocks;

use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert;
use Spatie\FlareClient\Http\Client;
use Spatie\FlareClient\Http\Response;

class FakeClient extends Client
{
    public array $requests = [];

    public function __construct()
    {
        parent::__construct(uniqid(), 'https://fake.com');
    }

    public function makeCurlRequest(
        string $verb,
        string $fullUrl,
        array $headers = [],
        array $arguments = []
    ): Response {
        $this->requests[] = compact('verb', 'fullUrl', 'headers', 'arguments');

        return new Response(['http_code' => 200], 'my response', '');
    }

    public function assertRequestsSent(int $expectedCount)
    {
        Assert::assertCount($expectedCount, $this->requests);
    }

    public function getLastRequest(): array
    {
        return Arr::last($this->requests);
    }
}
