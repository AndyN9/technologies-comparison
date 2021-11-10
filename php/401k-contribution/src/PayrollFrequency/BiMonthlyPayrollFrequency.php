<?php

namespace AndyN9\Contribution401kLibrary\PayrollFrequency;

use AndyN9\Contribution401kLibrary\PayrollFrequency\AbstractPayrollFrequency;

class BiMonthlyPayrollFrequency extends AbstractPayrollFrequency {
  public function __construct() {
    parent::__construct();

    $this->setType('bi-monthly');
    $this->setPayPeriods(6);
  }
}
