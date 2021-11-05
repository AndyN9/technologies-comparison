import PayrollFrequency from "./PayrollFrequency.js";

export default class MonthlyPayrollFrequency extends PayrollFrequency {
  constructor(){
    super();

    this.setType('monthly');
    this.setPayPeriods(12);
  }
}
