import axios from 'axios';

const API_URL = 'http://localhost:3000/api';

export const register = async (userData) => {
  return await axios.post(`${API_URL}/register`, userData);
};

export const login = async (userData) => {
  console.log("Esta en loginServices", API_URL+"/login");
  return await axios.post(`${API_URL}/login`, userData);
};