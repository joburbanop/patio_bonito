import axios from 'axios';

const API_URL = 'http://localhost:3000/api';

export const asignar = async (userData) => {
  return await axios.post(`${API_URL}/asignarRol`, userData);
};
