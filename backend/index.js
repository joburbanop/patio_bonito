const express = require('express');
const cors = require('cors');
const authRoutes = require('./src/routes/login');
const dotenv = require('dotenv');
const app = express();
dotenv.config();

// Middleware
app.use(cors());
app.use(express.json());

// Usar las rutas de autenticación
app.use('/api', authRoutes);

app.get('/api', (req, res) => {
  res.send('Bienvenido a la API del Restaurante Patio Bonito');
});

// Obtener y mostrar el puerto
const PORT = process.env.PORT || 3000;

// Iniciar el servidor
app.listen(PORT, () => {
  const baseUrl = `http://localhost:${PORT}/api`;
  console.log(`Servidor iniciado en el puerto ${PORT}`);
  console.log(`Ruta base para las API: ${baseUrl}`);
});