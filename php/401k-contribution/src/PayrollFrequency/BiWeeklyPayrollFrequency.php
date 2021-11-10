<?php

namespace AndyN9\Contribution401kLibrary\PayrollFrequency;

use AndyN9\Contribution401kLibrary\PayrollFrequency\AbstractPayrollFrequency;

class BiWeeklyPayrollFrequency extends AbstractPayrollFrequency {
  public function __construct() {
    parent::__construct();

    $this->setType('bi-weekly');
    $this->setPayPeriods(26);
  }
}
