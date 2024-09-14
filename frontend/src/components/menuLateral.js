// MenuLateral.js
import React from 'react';
import './style.css';

const MenuLateral = () => {
  return (
    <div className="menu-lateral">
      <ul>
        <li><a href="/admin/asignar-rol">Asignar Roles</a></li>
        <li><a href="/admin/inventario">Ver Inventario</a></li>
        <li><a href="/logout">Cerrar Sesión</a></li>
      </ul>
    </div>
  );
};

export default MenuLateral;