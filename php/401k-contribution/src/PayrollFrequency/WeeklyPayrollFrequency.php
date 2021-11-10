<?php

namespace AndyN9\Contribution401kLibrary\PayrollFrequency;

use AndyN9\Contribution401kLibrary\PayrollFrequency\AbstractPayrollFrequency;

class WeeklyPayrollFrequency extends AbstractPayrollFrequency {
  public function __construct() {
    parent::__construct();

    $this->setType('weekly');
    $this->setPayPeriods(52);
  }
}
