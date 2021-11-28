
export default class CreditCard {
  #id;
  #name;
  #issuer;
  #network;

  static fromState(state) {

    return new CreditCard(
      state['id'],
      state['name'],
      state['issuer'],
      state['network'],
    )
  }

  constructor(
    id,
    name,
    issuer,
    network,
  ) {
    this.#id = id;
    this.#name = name;
    this.#issuer = issuer;
    this.#network = network;
  }

  getId() {

    return this.#id;
  }

  getName() {

    return this.#name;
  }

  getIssuer() {

    return this.#issuer;
  }

  getNetwork() {

    return this.#network;
  }
}
