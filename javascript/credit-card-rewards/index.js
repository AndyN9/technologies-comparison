'use strict';

import app from "./app.js";

const PORT = 8080;

app.listen(
  PORT,
  () => console.log(`Credit Card Rewards REST API started on http://localhost:${PORT}`)
);