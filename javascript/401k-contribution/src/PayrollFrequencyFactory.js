import WeeklyPayrollFrequency from "./PayrollFrequency/WeeklyPayrollFrequency.js";
import BiWeeklyPayrollFrequency from "./PayrollFrequency/BiWeeklyPayrollFrequency.js";
import MonthlyPayrollFrequency from "./PayrollFrequency/MonthlyPayrollFrequency.js";
import BiMonthlyPayrollFrequency from "./PayrollFrequency/BiMonthlyPayrollFrequency.js";

export default class PayrollFrequencyFactory {
  #optionLookup = [
    'weekly',
    'bi-weekly',
    'monthly',
    'bi-monthly',
  ];

  getOptionLookup(){

    return this.#optionLookup;
  }

  create(option) {
    switch (option) {
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
