import PayrollFrequency from "./PayrollFrequency.js";

export default class WeeklyPayrollFrequency extends PayrollFrequency {
  constructor(){
    super();

    this.setType('weekly');
    this.setPayPeriods(52);
  }
}
