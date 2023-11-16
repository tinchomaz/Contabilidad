import { Router } from 'express';

const router = Router();

router.get('/test', (requ, resp) => resp.send('HOLA MUNDO'));

export default router;
