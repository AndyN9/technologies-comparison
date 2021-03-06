<?php

use PHPUnit\Framework\TestCase;
use AndyN9\Contribution401kLibrary\Contribution401k;

class Contribution401kTest extends TestCase {
  protected $contribution401k;

  protected function setUp(): void {
    $this->contribution401k = new Contribution401k();
  }

  public function testAnnualSalaryValidationShouldError(): void {
    $this->expectException('TypeError');
    $this->contribution401k->setAnnualSalary(true);
    $this->contribution401k->setAnnualSalary('foo');
  }

  public function testAnnualSalaryValidationShouldSet(): void {
    $this->contribution401k->setAnnualSalary(60000);
    $this->assertEquals(60000, $this->contribution401k->getAnnualSalary());

    $this->contribution401k->setAnnualSalary(60000.50);
    $this->assertEquals(60000.50, $this->contribution401k->getAnnualSalary());
  }

  public function testPayrollFrequencyValidationShouldError(): void {
    $payrollFrequencyOptionErrorMessage = 'Payroll frequency option needs to be a valid option';

    $this->expectExceptionMessage($payrollFrequencyOptionErrorMessage);
    $this->contribution401k->setPayrollFrequency('foo');
  }

  public function testPayrollFrequencyValidationShouldSet(): void {
    $this->contribution401k->setPayrollFrequency('weekly');
    $this->assertEquals('weekly', $this->contribution401k->getPayrollFrequency()->getType());

    $this->contribution401k->setPayrollFrequency('bi-weekly');
    $this->assertEquals('bi-weekly', $this->contribution401k->getPayrollFrequency()->getType());

    $this->contribution401k->setPayrollFrequency('monthly');
    $this->assertEquals('monthly', $this->contribution401k->getPayrollFrequency()->getType());

    $this->contribution401k->setPayrollFrequency('bi-monthly');
    $this->assertEquals('bi-monthly', $this->contribution401k->getPayrollFrequency()->getType());
  }

  public function testPercentValidationShouldErrorWhenSetToNonNumber(): void {
    $this->expectException('TypeError');
    $this->contribution401k->setPercent(true);
    $this->contribution401k->setPercent('foo');
  }

  public function testPercentValidationShouldErrorWhenSetToOver100(): void {
    $percentMaxRangeError = 'Percent value needs to be under 100';

    $this->expectExceptionMessage($percentMaxRangeError);
    $this->contribution401k->setPercent(101);
  }

  public function testPercentValidationShouldErrorWhenSetToUnder0(): void {
    $percentMinRangeError = 'Percent value needs to be over 0';

    $this->expectExceptionMessage($percentMinRangeError);
    $this->contribution401k->setPercent(-1);
  }

  public function testPercentValidationShouldSet(): void {
    $this->contribution401k->setPercent(50);
    $this->assertEquals(50, $this->contribution401k->getPercent());

    $this->contribution401k->setPercent(0.5);
    $this->assertEquals(0.5, $this->contribution401k->getPercent());
  }

  public function testCalculateShouldErrorWhenCalledWithoutAnnualSalary(): void {
    $annualSalaryRequiredError = 'An annual salary amount is required';

    $this->expectExceptionMessage($annualSalaryRequiredError);
    $this->contribution401k->calculate();
  }

  public function testCalculateShouldErrorWhenCalledWithoutPayrollFrquency(): void {
    $payrollFrequencyRequiredError = 'A payroll frequency is required';

    $this->expectExceptionMessage($payrollFrequencyRequiredError);
    $this->contribution401k->setAnnualSalary(60000);
    $this->contribution401k->calculate();
  }

  public function testCalculateMaxContribution(): void {
    $this->contribution401k->setAnnualSalary(60000);
    $this->contribution401k->setPayrollFrequency('weekly');
    $this->assertEquals(
      [
        'amount' => '375.00',
        'percent' => '32.50',
      ],
      $this->contribution401k->calculate()
    );

    $this->contribution401k->setPayrollFrequency('bi-weekly');
    $this->assertEquals(
      [
        'amount' => '750.00',
        'percent' => '32.50',
      ],
      $this->contribution401k->calculate()
    );

    $this->contribution401k->setPayrollFrequency('monthly');
    $this->assertEquals(
      [
        'amount' => '1625.00',
        'percent' => '32.50',
      ],
      $this->contribution401k->calculate()
    );

    $this->contribution401k->setPayrollFrequency('bi-monthly');
    $this->assertEquals(
      [
        'amount' => '3250.00',
        'percent' => '32.50',
      ],
      $this->contribution401k->calculate()
    );
  }

  public function testCalculatePercentContribution(): void {
    $this->contribution401k->setAnnualSalary(60000);
    $this->contribution401k->setPercent(5);
    $this->contribution401k->setPayrollFrequency('weekly');
    $this->assertEquals(
      [
        'amount' => '57.69',
        'percent' => '5.00',
      ],
      $this->contribution401k->calculate()
    );

    $this->contribution401k->setPayrollFrequency('bi-weekly');
    $this->assertEquals(
      [
        'amount' => '115.38',
        'percent' => '5.00',
      ],
      $this->contribution401k->calculate()
    );

    $this->contribution401k->setPayrollFrequency('monthly');
    $this->assertEquals(
      [
        'amount' => '250.00',
        'percent' => '5.00',
      ],
      $this->contribution401k->calculate()
    );

    $this->contribution401k->setPayrollFrequency('bi-monthly');
    $this->assertEquals(
      [
        'amount' => '500.00',
        'percent' => '5.00',
      ],
      $this->contribution401k->calculate()
    );
  }
}
