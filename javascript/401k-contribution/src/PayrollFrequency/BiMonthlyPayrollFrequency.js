import PayrollFrequency from "./PayrollFrequency.js";

export default class BiMonthlyPayrollFrequency extends PayrollFrequency {
  constructor(){
    super();

    this.setType('bi-monthly');
    this.setPayPeriods(6);
  }
}
