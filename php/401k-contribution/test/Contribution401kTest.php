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
}
