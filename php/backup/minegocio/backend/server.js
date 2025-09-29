const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const app = express();
const puerto = 3001;

// Middlewares
app.use(cors());
app.use(bodyParser.json());

// Rutas
const usuariosRouter = require('./routes/usuarios');
app.use('/api/usuarios', usuariosRouter);

// Iniciar servidor
app.listen(puerto, () => {
  console.log(`Servidor corriendo en http://localhost:${puerto}`);
});
