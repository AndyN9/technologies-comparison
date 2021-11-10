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
}
