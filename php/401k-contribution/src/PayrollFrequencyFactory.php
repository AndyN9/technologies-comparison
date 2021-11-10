<?php

namespace AndyN9\Contribution401kLibrary;

use AndyN9\Contribution401kLibrary\PayrollFrequency\WeeklyPayrollFrequency;
use AndyN9\Contribution401kLibrary\PayrollFrequency\BiWeeklyPayrollFrequency;
use AndyN9\Contribution401kLibrary\PayrollFrequency\MonthlyPayrollFrequency;
use AndyN9\Contribution401kLibrary\PayrollFrequency\BiMonthlyPayrollFrequency;
use Error;

class PayrollFrequencyFactory {
  public function create($option) {
    switch ($option) {
      case 'weekly':

        return new WeeklyPayrollFrequency();
      case 'bi-weekly':

        return new BiWeeklyPayrollFrequency();
      case 'monthly':

        return new MonthlyPayrollFrequency();
      case 'bi-monthly':

        return new BiMonthlyPayrollFrequency();
      default:

        throw new Error('Not a valid payroll frequency factory option');
        break;
    }
  }
}
