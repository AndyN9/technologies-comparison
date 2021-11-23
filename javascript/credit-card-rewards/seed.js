import sqlite3 from 'sqlite3';
import fs from 'fs';
import path from 'path';
const __dirname = path.resolve();

sqlite3.verbose();
const databasePrettyName = 'Credit Card Rewards';
const databaseSource = path.join(__dirname, 'data', 'credit-card-rewards.db');
const doesDatabaseSourceExists = fs.existsSync(databaseSource);

if (!doesDatabaseSourceExists) {
  fs.openSync(databaseSource, 'w');
}

const database = new sqlite3.Database(databaseSource);

const createTableScripts = [
  path.resolve('../../', 'sql', 'credit-card-rewards', 'create_credit_card_table.sql'),
];
const seedTableScripts = [
  path.resolve('../../', 'sql', 'credit-card-rewards', 'seed_credit_card_table.sql'),
];
const allSqlScripts = createTableScripts.concat(seedTableScripts);

console.log(`Seeding ${databasePrettyName} database`);
database.serialize(() => {
  if (doesDatabaseSourceExists) {

    console.log(`${databasePrettyName} database already exists, stopping...`);
    return;
  }

  for (const script of allSqlScripts) {
    const sqlQuery = fs.readFileSync(script).toString();
    console.log(`Running ${script}`);
    database.run(sqlQuery, (error) => {
      if (error) {

        return console.error(error.message);
      }
    });
  }
});

database.close();
