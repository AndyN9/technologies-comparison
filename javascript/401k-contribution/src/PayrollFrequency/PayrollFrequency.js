
export default class PayrollFrequency {
  #type;
  #payPeriods;

  getType() {

    return this.#type;
  }

  setType(value){
    this.#type = value;
  }

  getPayPeriods() {

    return this.#payPeriods;
  }

  setPayPeriods(value){
    this.#payPeriods = value;
  }

}
