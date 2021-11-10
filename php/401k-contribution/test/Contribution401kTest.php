<?php

use PHPUnit\Framework\TestCase;
use AndyN9\Contribution401kLibrary\Contribution401k;

class Contribution401kTest extends TestCase {
  protected $contribution401k;

  protected function setUp(): void {
    $this->contribution401k = new Contribution401k();
  }

  public function testAnnualSalaryValidationShouldError() {
    $this->expectExceptionMessage('Annual salary amount needs to be a number');
    $this->contribution401k->setAnnualSalary(true);
    $this->contribution401k->setAnnualSalary('foo');
  }

  public function testAnnualSalaryValidationShouldSet() {
    $this->contribution401k->setAnnualSalary(60000);
    $this->assertEquals($this->contribution401k->getAnnualSalary(), 60000);

    $this->contribution401k->setAnnualSalary(60000.50);
    $this->assertEquals($this->contribution401k->getAnnualSalary(), 60000.50);
  }

  public function testPayrollFrequencyValidationShouldError() {
    $this->expectExceptionMessage('Payroll frequency option needs to be a valid option');
    $this->contribution401k->setPayrollFrequency('foo');
  }

  public function testPayrollFrequencyValidationShouldSet() {
    $this->contribution401k->setPayrollFrequency('weekly');
    $this->assertEquals($this->contribution401k->getPayrollFrequency()->getType(), 'weekly');

    $this->contribution401k->setPayrollFrequency('bi-weekly');
    $this->assertEquals($this->contribution401k->getPayrollFrequency()->getType(), 'bi-weekly');

    $this->contribution401k->setPayrollFrequency('monthly');
    $this->assertEquals($this->contribution401k->getPayrollFrequency()->getType(), 'monthly');

    $this->contribution401k->setPayrollFrequency('bi-monthly');
    $this->assertEquals($this->contribution401k->getPayrollFrequency()->getType(), 'bi-monthly');
  }

  public function testPercentValidationShouldErrorWhenSetToNonNumber() {
    $this->expectExceptionMessage('Percent value needs to be a number');
    $this->contribution401k->setPercent(true);
    $this->contribution401k->setPercent('foo');
  }

  public function testPercentValidationShouldErrorWhenSetToOver100() {
    $this->expectExceptionMessage('Percent value needs to be under 100');
    $this->contribution401k->setPercent(101);
  }

  public function testPercentValidationShouldErrorWhenSetToUnder0() {
    $this->expectExceptionMessage('Percent value needs to be over 0');
    $this->contribution401k->setPercent(-1);
  }

  public function testPercentValidationShouldSet() {
    $this->contribution401k->setPercent(50);
    $this->assertEquals(50, $this->contribution401k->getPercent());

    $this->contribution401k->setPercent(0.5);
    $this->assertEquals(0.5, $this->contribution401k->getPercent());
  }
}
