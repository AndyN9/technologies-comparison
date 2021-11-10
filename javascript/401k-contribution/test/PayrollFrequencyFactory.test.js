import { it, expect, describe } from '@jest/globals';
import PayrollFrequencyFactory from '../src/PayrollFrequencyFactory.js';

describe('payroll frequency factory', () => {
  const payrollFrequencyFactory = new PayrollFrequencyFactory();

  it('should error when creating an in-valid factory option', () => {
    const invalidPayrollFrequencyError = new Error('Not a valid payroll frequency factory option');
    expect(()=>{
      const invalidPayrollFrequency = payrollFrequencyFactory.create('foo');
    }).toThrow(invalidPayrollFrequencyError);

    expect(()=>{
      const invalidPayrollFrequency = payrollFrequencyFactory.create();
    }).toThrow(invalidPayrollFrequencyError);
  });

  describe('weekly payroll frequency', () => {
    const weeklyPayrollFrequency = payrollFrequencyFactory.create('weekly');
    it('should create', () => {
      expect(weeklyPayrollFrequency.constructor.name).toBe('WeeklyPayrollFrequency');
    });

    it('should have 52 pay periods', () => {
      expect(weeklyPayrollFrequency.getPayPeriods()).toBe(52);
    });
  });

  describe('bi-weekly payroll frequency', () => {
    const biWeeklyPayrollFrequency = payrollFrequencyFactory.create('bi-weekly');
    it('should create', () => {
      expect(biWeeklyPayrollFrequency.constructor.name).toBe('BiWeeklyPayrollFrequency');
    });

    it('should have 26 pay periods', () => {
      expect(biWeeklyPayrollFrequency.getPayPeriods()).toBe(26);
    });
  });

  describe('monthly payroll frequency', () => {
    const monthlyPayrollFrequency = payrollFrequencyFactory.create('monthly');
    it('should create', () => {
      expect(monthlyPayrollFrequency.constructor.name).toBe('MonthlyPayrollFrequency');
    });

    it('should have 12 pay periods', () => {
      expect(monthlyPayrollFrequency.getPayPeriods()).toBe(12);
    });
  });

  describe('bi-monthly payroll frequency', () => {
    const biMonthlyPayrollFrequency = payrollFrequencyFactory.create('bi-monthly');
    it('should create', () => {
      expect(biMonthlyPayrollFrequency.constructor.name).toBe('BiMonthlyPayrollFrequency');
    });

    it('should have 6 pay periods', () => {
      expect(biMonthlyPayrollFrequency.getPayPeriods()).toBe(6);
    });
  });
});
