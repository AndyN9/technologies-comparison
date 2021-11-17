import { it, expect, describe } from '@jest/globals';
import supertest from 'supertest';
import app from './app.js';

const request = supertest(app);

describe('app is running on server', () => {
  it('GET /', async () => {
    await request
      .get('/')
      .expect(200)
      .then((response) => {
        expect(response.body.message).toBe('Silence is golden.');
      });
  })
});
