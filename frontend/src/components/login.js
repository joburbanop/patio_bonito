// Importaciones deben ir al principio
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';  // Para redirigir después del login
import { register, login } from '../services/loginServices';
import "./style.css";

const AuthForm = () => {
  const [formData, setFormData] = useState({ email: '', contraseña: '', nombre_usuario: '' });
  const [isRegister, setIsRegister] = useState(false); // Estado para alternar entre login y registro
  const navigate = useNavigate(); // useNavigate debe estar dentro del componente funcional

  // Manejar cambios en los campos del formulario
  const handleChange = (e) => setFormData({ ...formData, [e.target.name]: e.target.value });

  // Manejar el envío del formulario
  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      if (isRegister) {
        // Si es registro, llama a la función de registro
        await register(formData);
        alert('Usuario registrado con éxito');
      } else {
        // Si es login, llama a la función de login
        console.log("usuario a enviar ", formData.email, formData.contraseña );
        await login({ email: formData.email, contraseña: formData.contraseña });
        alert('Inicio de sesión exitoso');
        navigate('/dashboard');  // Redirigir a la página de dashboard
      }
    } catch (err) {
      console.error(err);
      alert('Error en la operación');
    }
  };

  return (
    <div className="auth-form">
      <h2>{isRegister ? 'Registrar' : 'Iniciar Sesión'}</h2>
      <form onSubmit={handleSubmit}>
        {/* Campo adicional solo si es registro */}
        {isRegister && (
          <input
            type="text"
            name="nombre_usuario"
            onChange={handleChange}
            placeholder="Nombre de usuario"
            value={formData.nombre_usuario}
            required
          />
        )}
        <input
          type="email"
          name="email"
          onChange={handleChange}
          placeholder="Email"
          value={formData.email}
          required
        />
        <input
          type="password"
          name="contraseña"
          onChange={handleChange}
          placeholder="Contraseña"
          value={formData.contraseña}
          required
        />
        <button type="submit">{isRegister ? 'Registrar' : 'Iniciar Sesión'}</button>
      </form>
      <button onClick={() => setIsRegister(!isRegister)}>
        {isRegister ? '¿Ya tienes cuenta? Inicia sesión' : '¿No tienes cuenta? Regístrate'}
      </button>
    </div>
  );
};

export default AuthForm;