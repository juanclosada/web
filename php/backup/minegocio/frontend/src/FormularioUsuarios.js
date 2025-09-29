// src/FormularioUsuarios.js
import React, { useState } from 'react';

function FormularioUsuarios() {
  const [formData, setFormData] = useState({
    nombre: '',
    correo: '',
    contraseña: ''
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Datos enviados:', formData);
    // Aquí podrías enviar los datos a una API, por ejemplo
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>Formulario de Usuario</h2>

      <label>
        Nombre:
        <input
          type="text"
          name="nombre"
          value={formData.nombre}
          onChange={handleChange}
        />
      </label>
      <br />

      <label>
        Correo:
        <input
          type="email"
          name="correo"
          value={formData.correo}
          onChange={handleChange}
        />
      </label>
      <br />

      <label>
        Contraseña:
        <input
          type="password"
          name="contraseña"
          value={formData.contraseña}
          onChange={handleChange}
        />
      </label>
      <br />

      <button type="submit">Enviar</button>
    </form>
  );
}

export default FormularioUsuarios;
