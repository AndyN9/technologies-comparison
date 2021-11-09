<?php

namespace AndyN9\Contribution401kLibrary;

use TypeError;

class Contribution401k {
  private $annualSalary;

  public function getAnnualSalary() {

    return $this->annualSalary;
  }

  public function setAnnualSalary($amount) {
    if (!is_numeric($amount)) {

      throw new TypeError('Annual salary amount needs to be a number');
    }

    $this->annualSalary = $amount;
  }
}
