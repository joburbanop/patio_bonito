const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const db = require('../config/db');
const dotenv = require('dotenv');
dotenv.config();

exports.registerUser = (req, res) => {
  const { nombre_usuario, email, contraseña } = req.body;
  const hashedPassword = bcrypt.hashSync(contraseña, 8);

  const sql = `INSERT INTO Usuarios (nombre_usuario, email, contraseña) VALUES (?, ?, ?)`;
  db.query(sql, [nombre_usuario, email, hashedPassword], (err, result) => {
    if (err) {
      console.error('Error en la consulta:', err);
      return res.status(500).send({ message: 'Error en el servidor', error: err });
    }
    res.status(200).send({ message: 'Usuario registrado exitosamente' });
  });
};

exports.loginUser = (req, res) => {
  const { email, contraseña } = req.body;

  if (!email || !contraseña) {
    return res.status(400).send({ message: 'Email y contraseña son requeridos' });
  }

  const sql = `SELECT * FROM Usuarios WHERE email = ?`;
  db.query(sql, [email], (err, result) => {
    if (err || result.length === 0) return res.status(404).send({ message: 'Usuario no encontrado' });

    const validPassword = bcrypt.compareSync(contraseña, result[0].contraseña);
    if (!validPassword) return res.status(401).send({ token: null, message: 'Contraseña incorrecta' });

    const token = jwt.sign({ id: result[0].id_Usuarios }, process.env.SECRET_KEY, { expiresIn: 86400 });
    res.status(200).send({ token });
  });
};