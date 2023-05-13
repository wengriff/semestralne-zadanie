<?php



it('can execute the test command when a flare key is present', function () {
    withFlareKey();

    $testResult = $this->artisan('flare:test');

    is_int($testResult)
        ? expect($testResult)->toBe(0)
        : $testResult->assertExitCode(0);
});

// Helpers
function withFlareKey(): void
{
    test()->withFlareKey = true;

    test()->refreshApplication();
}

function getEnvironmentSetUp($app)
{
    if (test()->withFlareKey) {
        config()->set('flare.key', 'some-key');
    }
}
