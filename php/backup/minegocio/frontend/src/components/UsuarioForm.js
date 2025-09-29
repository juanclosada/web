import React, { useState, useEffect } from 'react';
import axios from 'axios';

const UsuarioForm = ({ fetchUsuarios, selectedUser, setSelectedUser }) => {
  const [usuario, setUsuario] = useState({
    nombre: '',
    correo: '',
    contrasena: '',
    id_rol: ''
  });

  useEffect(() => {
    if (selectedUser) {
      setUsuario(selectedUser);
    }
  }, [selectedUser]);

  const handleChange = e => {
    setUsuario({ ...usuario, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (selectedUser) {
      await axios.put(`http://localhost:3001/api/usuarios/${selectedUser.id_usuario}`, usuario);
    } else {
      await axios.post('http://localhost:3001/api/usuarios', usuario);
    }
    fetchUsuarios();
    setUsuario({ nombre: '', correo: '', contrasena: '', id_rol: '' });
    setSelectedUser(null);
  };

  return (
    <form onSubmit={handleSubmit} className="mb-4">
      <input className="form-control mb-2" name="nombre" placeholder="Nombre" value={usuario.nombre} onChange={handleChange} />
      <input className="form-control mb-2" name="correo" placeholder="Correo" value={usuario.correo} onChange={handleChange} />
      <input className="form-control mb-2" name="contrasena" placeholder="Contraseña" value={usuario.contrasena} onChange={handleChange} />
      <input className="form-control mb-2" name="id_rol" placeholder="Rol" value={usuario.id_rol} onChange={handleChange} />
      <button className="btn btn-primary">{selectedUser ? 'Actualizar' : 'Agregar'}</button>
    </form>
  );
};

export default UsuarioForm;
