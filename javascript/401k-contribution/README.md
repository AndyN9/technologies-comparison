# 401k Contribution
Calculate 401k contribution amount per paycheck using annual salary, payroll frequency, and contribution percent (optional).

## Usage
```javascript
import Contribution401k from 'Contribution401k.js';

const contribution401k = new Contribution401k();
contribution401k.setAnnualSalary(60000);
contribution401k.setPayrollFrequency('bi-weekly');

// returns { 'amount': '750.00', 'percent': '32.50', }
contribution401k.calculate();

contribution401k.setPercent(5);

// returns { 'amount': '115.38', 'percent': '5.00' }
contribution401k.calculate();
```