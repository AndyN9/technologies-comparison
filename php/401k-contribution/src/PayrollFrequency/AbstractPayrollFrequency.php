<?php

namespace AndyN9\Contribution401kLibrary\PayrollFrequency;

abstract class AbstractPayrollFrequency {
  protected $type;
  protected $payPeriods;

  public function __construct() {
  }

  public function getType(): string {

    return $this->type;
  }

  public function setType(string $value) {
    $this->type = $value;
  }

  public function getPayPeriods(): int {

    return $this->payPeriods;
  }

  public function setPayPeriods(int $value) {
    $this->payPeriods = $value;
  }
}
