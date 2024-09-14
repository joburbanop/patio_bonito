// ruta para asinacion de roles 
exports.asignarRol = (req, res) => {
    const { userId, rolId } = req.body;
  
    if (!userId || !rolId) {
      return res.status(400).send({ message: 'Usuario y rol son requeridos' });
    }
  
    const sql = 'UPDATE Usuario_rol SET id_Roles = ? WHERE id_Usarios = ?';
    db.query(sql, [rolId, userId], (err, result) => {
      if (err) return res.status(500).send({ message: 'Error al asignar rol' });
  
      res.status(200).send({ message: 'Rol asignado exitosamente' });
      
    });
  };