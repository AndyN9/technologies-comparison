<?php

namespace AndyN9\Contribution401kLibrary\PayrollFrequency;

abstract class AbstractPayrollFrequency {
  protected $type;
  protected $payPeriods;

  public function __construct() {
  }

  public function getType() {

    return $this->type;
  }

  public function setType($value) {
    $this->type = $value;
  }

  public function getPayPeriods() {

    return $this->payPeriods;
  }

  public function setPayPeriods($value) {
    $this->payPeriods = $value;
  }
}
