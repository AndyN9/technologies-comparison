<?php

namespace AndyN9\Contribution401kLibrary;

use AndyN9\Contribution401kLibrary\PayrollFrequencyFactory;
use AndyN9\Contribution401kLibrary\PayrollFrequency\AbstractPayrollFrequency;
use Error;
use TypeError;

class Contribution401k {
  private $annualSalary;
  private $payrollFrequency;
  private $percent;

  public function getAnnualSalary(): float {

    return $this->annualSalary;
  }

  public function setAnnualSalary(float $amount): void {

    $this->annualSalary = $amount;
  }

  public function getPayrollFrequency(): AbstractPayrollFrequency {

    return $this->payrollFrequency;
  }

  public function setPayrollFrequency(string $option): void {
    $payrollFrequencyFactory = new PayrollFrequencyFactory();
    $isValidFrequencyOption = in_array($option, $payrollFrequencyFactory->getOptionLookup());

    if (!$isValidFrequencyOption) {

      throw new Error('Payroll frequency option needs to be a valid option');
    }

    $this->payrollFrequency = $payrollFrequencyFactory->create($option);
  }

  public function getPercent(): float {

    return $this->percent;
  }

  public function setPercent(float $value): void {
    if ($value > 100) {

      throw new Error('Percent value needs to be under 100');
    }

    if ($value < 0) {

      throw new Error('Percent value needs to be over 0');
    }

    $this->percent = $value;
  }
}
