import sqlite3 from 'sqlite3';
import fs from 'fs';
import path from 'path';
const __dirname = path.resolve();

sqlite3.verbose();
const databaseSource = path.join(__dirname, 'data', 'credit-card-rewards.db');
const doesDatabaseSourceExists = fs.existsSync(databaseSource);

if (!doesDatabaseSourceExists) {
  fs.openSync(databaseSource, 'w');
}

const database = new sqlite3.Database(databaseSource);

export {
  doesDatabaseSourceExists,
  database,
};
