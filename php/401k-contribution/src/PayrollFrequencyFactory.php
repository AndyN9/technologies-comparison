<?php

namespace AndyN9\Contribution401kLibrary;

use Error;

class PayrollFrequencyFactory {
  public function create($option) {
    switch ($option) {
      default:

        throw new Error('Not a valid payroll frequency factory option');
        break;
    }
  }
}
