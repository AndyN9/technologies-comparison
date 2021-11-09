<?php

namespace AndyN9\Contribution401kLibrary;

use Error;
use TypeError;

class Contribution401k {
  private $annualSalary;
  private $payrollFrequency;
  private $percent;

  public function getAnnualSalary() {

    return $this->annualSalary;
  }

  public function setAnnualSalary($amount) {
    if (!is_numeric($amount)) {

      throw new TypeError('Annual salary amount needs to be a number');
    }

    $this->annualSalary = $amount;
  }

  public function getPayrollFrequency() {

    return $this->payrollFrequency;
  }

  public function setPayrollFrequency($option) {
    $optionLookup = [
      'weekly',
      'bi-weekly',
      'monthly',
      'bi-monthly',
    ];

    $isValidFrequencyOption = in_array($option, $optionLookup);
    if (!$isValidFrequencyOption) {

      throw new Error('Payroll frequency option needs to be a valid option');
    }

    $this->payrollFrequency = $option;
  }

  public function getPercent() {

    return $this->percent;
  }

  public function setPercent($value) {
    if (!is_numeric($value)) {

      throw new TypeError('Percent value needs to be a number');
    }

    if ($value > 100) {

      throw new Error('Percent value needs to be under 100');
    }

    if ($value < 0) {

      throw new Error('Percent value needs to be over 0');
    }

    $this->percent = $value;
  }
}
