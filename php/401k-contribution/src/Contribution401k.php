<?php

namespace AndyN9\Contribution401kLibrary;

use AndyN9\Contribution401kLibrary\PayrollFrequencyFactory;
use AndyN9\Contribution401kLibrary\PayrollFrequency\AbstractPayrollFrequency;
use Error;

class Contribution401k {
  const MAX_AMOUNT_LIMIT = 19500;

  private $annualSalary;
  private $payrollFrequency;
  private $percent;

  public function getAnnualSalary(): ?float {

    return $this->annualSalary;
  }

  public function setAnnualSalary(float $amount): void {

    $this->annualSalary = $amount;
  }

  public function getPayrollFrequency(): ?AbstractPayrollFrequency {

    return $this->payrollFrequency;
  }

  public function setPayrollFrequency(string $option): void {
    $payrollFrequencyFactory = new PayrollFrequencyFactory();
    $isValidFrequencyOption = in_array($option, $payrollFrequencyFactory->getOptionLookup());

    if (!$isValidFrequencyOption) {

      throw new Error('Payroll frequency option needs to be a valid option');
    }

    $this->payrollFrequency = $payrollFrequencyFactory->create($option);
  }

  public function getPercent(): ?float {

    return $this->percent;
  }

  public function setPercent(float $value): void {
    if ($value > 100) {

      throw new Error('Percent value needs to be under 100');
    }

    if ($value < 0) {

      throw new Error('Percent value needs to be over 0');
    }

    $this->percent = $value;
  }

  public function calculate(): array {
    if (!$this->getAnnualSalary()) {

      throw new Error('An annual salary amount is required');
    }

    if (!$this->getPayrollFrequency()) {

      throw new Error('A payroll frequency is required');
    }

    return $this->getPercent()
      ? $this->getContribution()
      : $this->getMaxOutContribution();
  }

  private function getContribution(): array {

    return [
      'amount' => number_format($this->getPaycheckAmountPerPayPeriod() * ($this->getPercent() / 100), 2, '.', ''),
      'percent' => number_format($this->getPercent(), 2),
    ];
  }

  private function getPaycheckAmountPerPayPeriod(): float {

    return $this->getAnnualSalary() / $this->getPayrollFrequency()->getPayPeriods();
  }

  private function getMaxOutContribution(): array {
    $maxContributionAmountPerPayPeriod = $this->getMaxContributionAmountPerPayPeriod();
    $percent = ($maxContributionAmountPerPayPeriod
      / $this->getPaycheckAmountPerPayPeriod()) * 100;

    return [
      'amount' => number_format($maxContributionAmountPerPayPeriod, 2, '.', ''),
      'percent' => number_format($percent, 2),
    ];
  }

  private function getMaxContributionAmountPerPayPeriod(): float {

    return $this::MAX_AMOUNT_LIMIT / $this->getPayrollFrequency()->getPayPeriods();
  }
}
