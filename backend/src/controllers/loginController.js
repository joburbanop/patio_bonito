const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const db = require('../config/db');
const dotenv = require('dotenv');
dotenv.config();

//controlador para registrar usuario
exports.registerUser = (req, res) => {
  const { nombre_usuario, email, contraseña } = req.body;
  const encriptacion = bcrypt.hashSync(contraseña, 8);

 
  const insertarusuario = `INSERT INTO Usuarios (nombre_usuario, email, contraseña) VALUES (?, ?, ?)`;
  db.query(insertarusuario, [nombre_usuario, email, encriptacion], (error, result) => {
    //console.log(error)
    if (error) {
      return res.status(500).send({ message: 'Error en el servidor al registrar usuario' });
    }
    
    const userId = result.insertId;  
    console.log("usuraio id", userId)
    
    const rolId = 4;  

    const insersionSQLRol = `INSERT INTO Usuario_rol (id_Usarios, id_Roles) VALUES (?, ?)`;
    db.query(insersionSQLRol, [userId, rolId], (error, result) => {
      if (error) {
        return res.status(500).send({ message: 'Error al asignar rol por defecto' });
      }

      res.status(200).send({ message: 'Usuario registrado exitosamente con rol asignado' });
    });
  });
};

//controlador para verificar usuario
exports.loginUser = (req, res) => {
  const { email, contraseña } = req.body;

  if (!email || !contraseña) {
    return res.status(400).send({ message: 'Email y contraseña son requeridos' });
  }

  const sql = `SELECT * FROM Usuarios WHERE email = ?`;
  //console.log(sql)
  db.query(sql, [email], (error, result) => {
    //console.log(result)
    //console.log(result[0].id_Usarios)
    //console.log(error)
    if (result[0].id_Usarios==1 ){
      console.log("es admin")
    }
    if (error || result.length === 0) return res.status(404).send({ message: 'Usuario no encontrado' });

    const desencriptar = bcrypt.compareSync(contraseña, result[0].contraseña);
    if (!desencriptar) return res.status(401).send({ token: null, message: 'Contraseña incorrecta' });

    const token = jwt.sign({ id: result[0].id_Usuarios }, process.env.SECRET_KEY, { expiresIn: 86400 });
    res.status(200).send({ token });
  });
};