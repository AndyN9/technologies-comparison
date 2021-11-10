<?php

use PHPUnit\Framework\TestCase;
use AndyN9\Contribution401kLibrary\PayrollFrequencyFactory;

class PayrollFrequencyFactoryTest extends TestCase {
  protected $payrollFrequencyFactory;

  protected function setUp(): void {
    $this->payrollFrequencyFactory = new PayrollFrequencyFactory();
  }

  public function testCreatingInvalidPayrollFrequency() {
    $this->expectExceptionMessage('Not a valid payroll frequency factory option');
    $invalidPayrollFrequency = $this->payrollFrequencyFactory->create('foo');
  }

  public function testWeeklyPayrollFrequency() {
    $weeklyPayrollFrequency = $this->payrollFrequencyFactory->create('weekly');

    $this->assertStringContainsString('WeeklyPayrollFrequency', get_class($weeklyPayrollFrequency));
    $this->assertEquals(52,  $weeklyPayrollFrequency->getPayPeriods());
  }

  public function testBiWeeklyPayrollFrequency() {
    $biWeeklyPayrollFrequency = $this->payrollFrequencyFactory->create('bi-weekly');

    $this->assertStringContainsString('BiWeeklyPayrollFrequency', get_class($biWeeklyPayrollFrequency));
    $this->assertEquals(26,  $biWeeklyPayrollFrequency->getPayPeriods());
  }

  public function testMonthlyPayrollFrequency() {
    $monthlyPayrollFrequency = $this->payrollFrequencyFactory->create('monthly');

    $this->assertStringContainsString('MonthlyPayrollFrequency', get_class($monthlyPayrollFrequency));
    $this->assertEquals(12,  $monthlyPayrollFrequency->getPayPeriods());
  }

  public function testBiMonthlyPayrollFrequency() {
    $biMonthlyPayrollFrequency = $this->payrollFrequencyFactory->create('bi-monthly');

    $this->assertStringContainsString('BiMonthlyPayrollFrequency', get_class($biMonthlyPayrollFrequency));
    $this->assertEquals(6,  $biMonthlyPayrollFrequency->getPayPeriods());
  }
}
