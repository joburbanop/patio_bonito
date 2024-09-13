import React, { useState } from 'react';
import { register, login } from '../services/loginServices';
import './Register.css';

const Register = () => {
  const [loginData, setLoginData] = useState({ email: '', contraseña: '' });
  const [isLogin, setIsLogin] = useState(true);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setLoginData({ ...loginData, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      if (isLogin) {
        await login(loginData);
        alert('Inicio de sesión exitoso');
      } else {
        await register(loginData);
        alert('Usuario registrado con éxito');
      }
    } catch (err) {
      console.error(err);
      alert('Error en la operación');
    }
  };

  return (
    <div className="auth-container">
      <div className="auth-form">
        <h2>{isLogin ? 'Iniciar Sesión' : 'Registrarse'}</h2>
        <form onSubmit={handleSubmit}>
          <input
            type="email"
            name="email"
            value={loginData.email}
            onChange={handleChange}
            placeholder="Email"
            required
          />
          <input
            type="password"
            name="contraseña"
            value={loginData.contraseña}
            onChange={handleChange}
            placeholder="Contraseña"
            required
          />
          <button type="submit" className="login-button">
            {isLogin ? 'Iniciar Sesión' : 'Registrarse'}
          </button>
        </form>
        <a
          href="#"
          className="link"
          onClick={() => setIsLogin(!isLogin)}
        >
          {isLogin ? '¿No tienes cuenta? Regístrate aquí' : '¿Ya tienes cuenta? Inicia sesión aquí'}
        </a>
      </div>
    </div>
  );
};

export default Register;