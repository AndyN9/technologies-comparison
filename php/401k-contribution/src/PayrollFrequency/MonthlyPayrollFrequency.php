<?php

namespace AndyN9\Contribution401kLibrary\PayrollFrequency;

use AndyN9\Contribution401kLibrary\PayrollFrequency\AbstractPayrollFrequency;

class MonthlyPayrollFrequency extends AbstractPayrollFrequency {
  public function __construct() {
    parent::__construct();

    $this->setType('monthly');
    $this->setPayPeriods(12);
  }
}
