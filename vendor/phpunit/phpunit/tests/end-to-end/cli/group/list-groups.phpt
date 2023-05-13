--TEST--
phpunit --list-groups ../../_files/BankAccountTest.php
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--list-groups';
$_SERVER['argv'][] = __DIR__ . '/../../../_files/BankAccountTest.php';

require_once __DIR__ . '/../../../bootstrap.php';
(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Available test group(s):
 - 1234
 - balanceCannotBecomeNegative
 - balanceIsInitiallyZero
 - specification
