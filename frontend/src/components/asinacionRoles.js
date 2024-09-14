// asignacion roles fronted
import { useState } from 'react';
import axios from 'axios';

const AsignarRol = () => {
  const [userId, setUserId] = useState('');
  const [rolId, setRolId] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/api/admin/asignar-rol', { userId, rolId });
      alert(response.data.message);
    } catch (error) {
      alert(error.response.data.message);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <input type="text" value={userId} onChange={(e) => setUserId(e.target.value)} placeholder="ID de usuario" />
      <input type="text" value={rolId} onChange={(e) => setRolId(e.target.value)} placeholder="ID de rol" />
      <button type="submit">Asignar Rol</button>
    </form>
  );
};

export default AsignarRol;