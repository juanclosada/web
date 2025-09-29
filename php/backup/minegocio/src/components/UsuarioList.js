import React from 'react';
import axios from 'axios';

const UsuarioList = ({ usuarios, fetchUsuarios, setSelectedUser }) => {
  const eliminarUsuario = async (id) => {
    await axios.delete(`http://localhost:3001/api/usuarios/${id}`);
    fetchUsuarios();
  };

  return (
    <table className="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        {usuarios.map(user => (
          <tr key={user.id_usuario}>
            <td>{user.nombre}</td>
            <td>{user.correo}</td>
            <td>{user.id_rol}</td>
            <td>
              <button className="btn btn-warning btn-sm me-2" onClick={() => setSelectedUser(user)}>Editar</button>
              <button className="btn btn-danger btn-sm" onClick={() => eliminarUsuario(user.id_usuario)}>Eliminar</button>
            </td>
          </tr>
        ))}
      </tbody>
    </table>
  );
};

export default UsuarioList;
