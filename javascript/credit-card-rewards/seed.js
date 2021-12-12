import fs from 'fs';
import path from 'path';
import { database, doesDatabaseSourceExists } from './database.js';

const databasePrettyName = 'Credit Card Rewards';

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
