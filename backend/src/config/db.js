const mysql = require('mysql2');
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'admin123',
  database: 'Base_datos_patio_bonito'
});

connection.connect((err) => {
  if (err) {
    console.error('error al conectar base de datos ', err);
    return;
  }
  console.log('base de datos conectada');
});

module.exports = connection;