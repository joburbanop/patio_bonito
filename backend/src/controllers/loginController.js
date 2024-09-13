const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const db = require('../config/db');
const dotenv = require('dotenv');
dotenv.config();

exports.registerUser = (req, res) => {
  const { nombre_usuario, email, contraseña } = req.body;
  const hashedPassword = bcrypt.hashSync(contraseña, 8);
  
  const sql = `INSERT INTO Usarios (nombre_usuario, email, contraseña) VALUES (?, ?, ?)`;
  db.query(sql, [nombre_usuario, email, hashedPassword], (err, result) => {
    if (err) return res.status(500).send({ message: 'Error en el servidor' });
    res.status(200).send({ message: 'Usuario registrado exitosamente' });
  });
};

exports.loginUser = (req, res) => {
  const { email, contraseña } = req.body;
  
  const sql = `SELECT * FROM Usarios WHERE email = ?`;
  db.query(sql, [email], (err, result) => {
    if (err || result.length === 0) return res.status(404).send({ message: 'Usuario no encontrado' });

    const validPassword = bcrypt.compareSync(contraseña, result[0].contraseña);
    if (!validPassword) return res.status(401).send({ token: null, message: 'Contraseña incorrecta' });

    const token = jwt.sign({ id: result[0].id_Usarios }, process.env.SECRET_KEY, { expiresIn: 86400 });
    res.status(200).send({ token });
  });
};