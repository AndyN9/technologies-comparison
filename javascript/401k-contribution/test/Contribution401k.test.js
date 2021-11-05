import { it, expect, describe } from '@jest/globals';
import Contribution401k from '../src/Contribution401k.js';

describe('401k contribution utility', () => {
  let contribution401k = new Contribution401k();

  describe('annual salary validation', () => {
    it('should error when set to non-number', () => {
      const salaryTypeError = new TypeError('Annual salary amount needs to be a number');

      expect(() => {
        contribution401k.setAnnualSalary(true);
      }).toThrow(salaryTypeError);

      expect(() => {
        contribution401k.setAnnualSalary('foo');
      }).toThrow(salaryTypeError);
    });

    it('should set to number', () => {
      contribution401k.setAnnualSalary(60000);
      expect(contribution401k.getAnnualSalary()).toBe(60000);

      contribution401k.setAnnualSalary(60000.50);
      expect(contribution401k.getAnnualSalary()).toBe(60000.50);
    });
  });

  describe('payroll frequency validation', () => {
    it('should error when set to invalid option', () => {
      const payrollFrequencyOptionError = new Error('Payroll frequency option needs to be a valid option');
      expect(() => {
        contribution401k.setPayrollFrequency('foo');
      }).toThrow(payrollFrequencyOptionError);
    });

    it('should set to a valid option', () => {
      contribution401k.setPayrollFrequency('weekly');
      expect(contribution401k.getPayrollFrequency().getType()).toBe('weekly');

      contribution401k.setPayrollFrequency('bi-weekly');
      expect(contribution401k.getPayrollFrequency().getType()).toBe('bi-weekly');

      contribution401k.setPayrollFrequency('monthly');
      expect(contribution401k.getPayrollFrequency().getType()).toBe('monthly');

      contribution401k.setPayrollFrequency('bi-monthly');
      expect(contribution401k.getPayrollFrequency().getType()).toBe('bi-monthly');
    });
  });

  describe('percent validation', () => {
    it('should error when set to a non-number', () => {
      const percentTypeError = new TypeError('Percent value needs to be a number');

      expect(() => {
        contribution401k.setPercent(true);
      }).toThrow(percentTypeError);

      expect(() => {
        contribution401k.setPercent('foo');
      }).toThrow(percentTypeError);
    });

    it('should error when set to a not valid percent range (0-100)', () => {
      const percentMaxRangeError = new Error('Percent value needs to be under 100');
      const percentMinRangeError = new Error('Percent value needs to be over 0');

      expect(() => {
        contribution401k.setPercent(101);
      }).toThrow(percentMaxRangeError);

      expect(() => {
        contribution401k.setPercent(-1);
      }).toThrow(percentMinRangeError);
    });

    it('should set to a valid percent range (0-100)', () => {
      contribution401k.setPercent(50);
      expect(contribution401k.getPercent()).toBe(50);

      contribution401k.setPercent(0.5);
      expect(contribution401k.getPercent()).toBe(0.5);
    });
  });

  describe('calculate', () => {
    it('should error without required inputs', () => {
      const annualSalaryRequiredError = new Error('An annual salary amount is required');

      expect(() => {
        contribution401k.calculate()
      }).toThrow(annualSalaryRequiredError);

      const payrollFrequencyRequiredError = new Error('A payroll frequency is required');

      contribution401k.setAnnualSalary(60000);
      expect(() => {
        contribution401k.calculate()
      }).toThrow(payrollFrequencyRequiredError);
    });

    it('max contribution', () => {
      contribution401k.setAnnualSalary(60000);
      contribution401k.setPayrollFrequency('weekly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '375.00',
          'percent': '32.50',
        });

      contribution401k.setPayrollFrequency('bi-weekly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '750.00',
          'percent': '32.50',
        });

      contribution401k.setPayrollFrequency('monthly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '1625.00',
          'percent': '32.50',
        });

      contribution401k.setPayrollFrequency('bi-monthly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '3250.00',
          'percent': '32.50',
        });
    });

    it('percent contribution', () => {
      contribution401k.setAnnualSalary(60000);
      contribution401k.setPercent(5);
      contribution401k.setPayrollFrequency('weekly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '57.69',
          'percent': '5.00',
        });

      contribution401k.setPayrollFrequency('bi-weekly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '115.38',
          'percent': '5.00',
        });

      contribution401k.setPayrollFrequency('monthly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '250.00',
          'percent': '5.00',
        });

      contribution401k.setPayrollFrequency('bi-monthly');
      expect(contribution401k.calculate())
        .toEqual({
          'amount': '500.00',
          'percent': '5.00',
        });
    });
  });

  afterEach(() => {
    contribution401k = new Contribution401k();
  });
});
