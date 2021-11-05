import PayrollFrequencyFactory from "./PayrollFrequencyFactory.js";

export default class Contribution401k {
  // TODO if max contribution limit ever increases,
  //   create yearly concrete class, extends this,
  //   and override MAX_CONTRIBUTION_LIMIT constant
  #MAX_AMOUNT_LIMIT = 19500;

  #annualSalary;
  #payrollFrequency;
  #percent;

  getAnnualSalary() {

    return this.#annualSalary;
  }

  setAnnualSalary(amount) {
    if (!this.#isNumber(amount)) {

      throw new TypeError('Annual salary amount needs to be a number');
    }

    this.#annualSalary = amount
  }

  getPayrollFrequency() {

    return this.#payrollFrequency;
  }

  setPayrollFrequency(option) {
    const payrollFrequencyFactory = new PayrollFrequencyFactory();
    const isValidFrequencyOption = payrollFrequencyFactory
      .getOptionLookup()
      .includes(option);

    if (!isValidFrequencyOption) {

      throw new Error('Payroll frequency option needs to be a valid option');
    }

    this.#payrollFrequency = payrollFrequencyFactory.create(option);
  }

  getPercent() {

    return this.#percent;
  }

  setPercent(value) {
    if (!this.#isNumber(value)) {

      throw new TypeError('Percent value needs to be a number');
    }

    if (value > 100) {

      throw new Error('Percent value needs to be under 100');
    }

    if (value < 0) {

      throw new Error('Percent value needs to be over 0');
    }

    this.#percent = value
  }

  #isNumber(value) {

    return typeof value === 'number';
  }

  calculate() {
    if(!this.getAnnualSalary()){

      throw new Error('An annual salary amount is required');
    }

    if(!this.getPayrollFrequency()){

      throw new Error('A payroll frequency is required');
    }

    return this.getPercent()
      ? this.#getContribution()
      : this.#getMaxOutContribution();
  }

  #getContribution() {

    return {
      amount: (this.#getPaycheckAmountPerPayPeriod() * (this.getPercent() / 100)).toFixed(2),
      percent: this.getPercent().toFixed(2),
    };
  }

  #getPaycheckAmountPerPayPeriod() {

    return (this.getAnnualSalary() / this.getPayrollFrequency().getPayPeriods()).toFixed(2);
  }

  #getMaxOutContribution() {
    const maxContributionAmountPerPayPeriod = this.#getMaxContributionAmountPerPayPeriod();
    const percent = (
      maxContributionAmountPerPayPeriod
      / this.#getPaycheckAmountPerPayPeriod()
    ) * 100;

    return {
      amount: maxContributionAmountPerPayPeriod,
      percent: percent.toFixed(2),
    };
  }

  #getMaxContributionAmountPerPayPeriod() {

    return (this.#MAX_AMOUNT_LIMIT / this.getPayrollFrequency().getPayPeriods()).toFixed(2);
  }
}
