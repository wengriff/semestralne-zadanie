--TEST--
phpunit --test-suffix .test.php,.my.php ../../_files/
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--test-suffix';
$_SERVER['argv'][] = '.test.php,.my.php';
$_SERVER['argv'][] = __DIR__ . '/../../_files/';

require_once __DIR__ . '/../../bootstrap.php';
(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime: %s

.....                                                               5 / 5 (100%)

Time: %s, Memory: %s

OK (5 tests, 5 assertions)
