<?php declare(strict_types=1);

namespace PHPUnit\Runner\Extension;

use PHPUnit\Runner\AfterIncompleteTestHook;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\AfterRiskyTestHook;
use PHPUnit\Runner\AfterSkippedTestHook;
use PHPUnit\Runner\AfterSuccessfulTestHook;
use PHPUnit\Runner\AfterTestErrorHook;
use PHPUnit\Runner\AfterTestFailureHook;
use PHPUnit\Runner\AfterTestHook;
use PHPUnit\Runner\AfterTestWarningHook;
use PHPUnit\Runner\BeforeFirstTestHook;
use PHPUnit\Runner\BeforeTestHook;

final class TestHooksHandler implements AfterIncompleteTestHook, AfterLastTestHook, AfterRiskyTestHook, AfterSkippedTestHook,
    AfterSuccessfulTestHook, AfterTestErrorHook, AfterTestFailureHook, AfterTestWarningHook, AfterTestHook, BeforeFirstTestHook,
    BeforeTestHook
{

    private string $reset_all_attributes = "\e[0m";
    private string $bold = "\e[1m";
    private string $red = "\e[91m";
    private string $green = "\e[92m";
    private string $blue = "\e[34m";
    private string $yellow = "\e[93m";
    private string $cyan = "\e[96m";
    private string $date;

    public function executeBeforeFirstTest(): void
    {
        $this->printBar();
        $this->printNewLine();
    }

    private function printBar(): void
    {
        printf("---------------------------------------------------------------------------");
    }

    private function printNewLine(): void
    {
        printf("\n");
    }

    public function executeAfterLastTest(): void
    {
        $this->printNewLine();
        $this->printBar();
        $this->printNewLine();
        $this->printNewLine();
        printf($this->bold . "All tests finished!" . $this->reset_all_attributes);
        $this->printNewLine();
    }

    public function executeBeforeTest(string $test): void
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->date = date('d-m-Y  H:i:s', time());
    }

    public function executeAfterTest(string $test, float $time): void
    {
        $this->printNewLine();
    }

    public function executeAfterSuccessfulTest(string $test, float $time): void
    {
        $this->printTestInformation($test, 'All assertions succeeded.', $time);
        printf("L STATUS: " . $this->green . "succeed " . $this->reset_all_attributes);
    }

    private function printTestInformation(string $test, string $message, float $time): void
    {
        $this->printNewLine();
        printf("-TEST: " . $test);
        $this->printNewLine();
        printf("L STARTED AT: " . $this->date);
        $this->printNewLine();
        printf("L DURATION: " . $time . "s");
        $this->printNewLine();
        printf("L MESSAGE: " . $message);
        $this->printNewLine();
    }

    public function executeAfterIncompleteTest(string $test, string $message, float $time): void
    {
        $this->printTestInformation($test, $message, $time);
        printf("L STATUS: " . $this->cyan . "incomplete " . $this->reset_all_attributes);
    }

    public function executeAfterRiskyTest(string $test, string $message, float $time): void
    {
        $this->printTestInformation($test, $message, $time);
        printf("L STATUS: " . $this->yellow . "risky " . $this->reset_all_attributes);
    }

    public function executeAfterSkippedTest(string $test, string $message, float $time): void
    {
        $this->printTestInformation($test, $message, $time);
        printf("L STATUS: " . $this->blue . "skipped " . $this->reset_all_attributes);
    }

    public function executeAfterTestError(string $test, string $message, float $time): void
    {
        $this->printTestInformation($test, $message, $time);
        printf("L STATUS: " . $this->red . "error " . $this->reset_all_attributes);
    }

    public function executeAfterTestFailure(string $test, string $message, float $time): void
    {
        $this->printTestInformation($test, $message, $time);
        printf("L STATUS: " . $this->red . "failure " . $this->reset_all_attributes);
    }

    public function executeAfterTestWarning(string $test, string $message, float $time): void
    {
        $this->printTestInformation($test, $message, $time);
        printf("L STATUS: " . $this->yellow . "warning " . $this->reset_all_attributes);
        $this->printNewLine();
    }
}