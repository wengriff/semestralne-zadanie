--TEST--
Possibility to migrate XML configuration file from PHPUnit 9.2 format is detected
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--configuration';
$_SERVER['argv'][] = __DIR__ . '/_files/possibility-to-migrate-from-92-is-detected/phpunit.xml';

require_once __DIR__ . '/../../bootstrap.php';

(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       PHP %s
Configuration: %sphpunit.xml

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

There was 1 PHPUnit test runner deprecation:

1) Your XML configuration validates against a deprecated schema. Migrate your XML configuration using "--migrate-configuration"!

OK, but there are issues!
Tests: 1, Assertions: 1, Deprecations: 1.
