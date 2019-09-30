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
        public List<Curso> busqueda(int estudiante) { 
            Conexion conexion = new Conexion();
            return conexion.ConsultarCursos(estudiante);
        }
        public Boolean validar(string ced, string clave) { 
            Conexion conexion = new Conexion();
            return conexion.validar(ced, clave);
        }
        public List<Curso> llenar(string ced) { 
            Conexion conexion = new Conexion();
            return conexion.llenarTabla(ced);
        }
    }
}