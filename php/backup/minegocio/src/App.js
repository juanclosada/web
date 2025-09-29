import React, { useEffect, useState } from 'react';
import axios from 'axios';
import UsuarioForm from './components/UsuarioForm';
import UsuarioList from './components/UsuarioList';

function App() {
  const [usuarios, setUsuarios] = useState([]);
  const [selectedUser, setSelectedUser] = useState(null);

  const fetchUsuarios = async () => {
    const res = await axios.get('http://localhost:3001/api/usuarios');
    setUsuarios(res.data);
  };

  useEffect(() => {
    fetchUsuarios();
  }, []);

  return (
    <div className="container mt-4">
      <h1>Gestión de Usuarios</h1>
      <UsuarioForm fetchUsuarios={fetchUsuarios} selectedUser={selectedUser} setSelectedUser={setSelectedUser} />
      <UsuarioList usuarios={usuarios} fetchUsuarios={fetchUsuarios} setSelectedUser={setSelectedUser} />
    </div>
  );
}

export default App;

