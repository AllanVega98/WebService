using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using AccesoDatos;
using Entidades;

namespace servicio
{
    public class Logica
    {
        #region variables
        private Conexion conexion;
        #endregion

        #region métodos
        public Logica()
        {
            conexion = new Conexion();
        }
        public int validar(string cedula) { 
            return conexion.validarCedula(cedula);
        }
        public string nombre(string cedula)
        {
            return conexion.nombre(cedula);
        }
        public Boolean login(string cedula, string clave) { 
            return conexion.login(cedula, clave);
        }
        public List<Grupo_Participante> consultarCursos(string cedula) { 
            return conexion.consultarCursos(cedula);
        }

        public Boolean registrar(Login usuario)
        {
            return conexion.registrar(usuario);
        }

        public Boolean con()
        {
            return conexion.ConectarBD();
        }
        #endregion
    }
}