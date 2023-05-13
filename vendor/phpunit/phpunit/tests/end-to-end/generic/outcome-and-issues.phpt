--TEST--
phpunit --display-incomplete --display-skipped --display-deprecations --display-errors --display-notices --display-warnings ../_files/OutcomesAndIssuesTest
--FILE--
<?php declare(strict_types=1);
$_SERVER['argv'][] = '--do-not-cache-result';
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--display-incomplete';
$_SERVER['argv'][] = '--display-skipped';
$_SERVER['argv'][] = '--display-deprecations';
$_SERVER['argv'][] = '--display-errors';
$_SERVER['argv'][] = '--display-notices';
$_SERVER['argv'][] = '--display-warnings';
$_SERVER['argv'][] = __DIR__ . '/../_files/OutcomesAndIssuesTest.php';

require_once __DIR__ . '/../../bootstrap.php';
(new PHPUnit\TextUI\Application)->run($_SERVER['argv']);
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime: %s

.RDNWFFFEEEDNWDNW                                                 17 / 17 (100%)

Time: %s, Memory: %s

There were 3 errors:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithDeprecation
Exception: exception message

%sOutcomesAndIssuesTest.php:%d

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithNotice
Exception: exception message

%sOutcomesAndIssuesTest.php:%d

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithWarning
Exception: exception message

%sOutcomesAndIssuesTest.php:%d

--

There were 3 failures:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testFailWithDeprecation
Failed asserting that false is true.

%sOutcomesAndIssuesTest.php:%d

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testFailWithNotice
Failed asserting that false is true.

%sOutcomesAndIssuesTest.php:%d

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testFailWithWarning
Failed asserting that false is true.

%sOutcomesAndIssuesTest.php:%d

--

There were 4 risky tests:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSuccessWithRisky
This test did not perform any assertions

%sOutcomesAndIssuesTest.php:%d

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithDeprecation
This test did not perform any assertions

%sOutcomesAndIssuesTest.php:%d

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithNotice
This test did not perform any assertions

%sOutcomesAndIssuesTest.php:%d

4) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithWarning
This test did not perform any assertions

%sOutcomesAndIssuesTest.php:%d

--

There were 3 incomplete tests:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testIncompleteWithDeprecation
incomplete message

%sOutcomesAndIssuesTest.php:%d

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testIncompleteWithNotice
incomplete message

%sOutcomesAndIssuesTest.php:%d

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testIncompleteWithWarning
incomplete message

%sOutcomesAndIssuesTest.php:%d

--

There were 3 skipped tests:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSkippedWithDeprecation
skipped message

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSkippedWithNotice
skipped message

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSkippedWithWarning
skipped message

--

5 tests triggered 5 warnings:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSuccessWithWarning
warning message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testFailWithWarning
warning message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithWarning
warning message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

4) PHPUnit\TestFixture\OutcomesAndIssuesTest::testIncompleteWithWarning
warning message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

5) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSkippedWithWarning
warning message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

--

5 tests triggered 5 notices:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSuccessWithNotice
notice message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testFailWithNotice
notice message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithNotice
notice message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

4) PHPUnit\TestFixture\OutcomesAndIssuesTest::testIncompleteWithNotice
notice message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

5) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSkippedWithNotice
notice message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

--

5 tests triggered 5 deprecations:

1) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSuccessWithDeprecation
deprecation message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

2) PHPUnit\TestFixture\OutcomesAndIssuesTest::testFailWithDeprecation
deprecation message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

3) PHPUnit\TestFixture\OutcomesAndIssuesTest::testErrorWithDeprecation
deprecation message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

4) PHPUnit\TestFixture\OutcomesAndIssuesTest::testIncompleteWithDeprecation
deprecation message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

5) PHPUnit\TestFixture\OutcomesAndIssuesTest::testSkippedWithDeprecation
deprecation message
%sOutcomesAndIssuesTest.php:%d

%sOutcomesAndIssuesTest.php:%d

ERRORS!
Tests: 17, Assertions: 7, Errors: 3, Failures: 3, Warnings: 5, Deprecations: 5, Notices: 5, Skipped: 3, Incomplete: 3, Risky: 4.
