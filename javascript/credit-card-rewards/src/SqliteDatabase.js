import Database from './Database.js';
import { database, doesDatabaseSourceExists } from '../database.js';

export default class SqliteDatabase extends Database {
  #database;

  constructor() {
    if (!doesDatabaseSourceExists) {

      throw new Error('database does\'t exists');
    }

    this.#database = database;
  }

  insert(row) {

  }

  selectAll() {

  }

  selectOne(id) {

  }

  update(id) {

  }

  delete(id) {

  }
}
