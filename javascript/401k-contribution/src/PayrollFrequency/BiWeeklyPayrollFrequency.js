import PayrollFrequency from "./PayrollFrequency.js";

export default class BiWeeklyPayrollFrequency extends PayrollFrequency {
  constructor(){
    super();

    this.setType('bi-weekly');
    this.setPayPeriods(26);
  }
}
