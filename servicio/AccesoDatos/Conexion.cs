using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;
using System.Net;
using Entidades;

namespace AccesoDatos
{
    public class Conexion
    {
        private String baseDatos;
        private String usuario;
        private String clave;
        private SqlConnection conexion;

        public Conexion()
        {
            this.baseDatos = "Curso";
            this.usuario = "sa";
            this.clave = "123";
        }

        public String ObtenerNombreServidor()
        {
            return Dns.GetHostName();
        }

        public Boolean ConectarBD()
        {
            try
            {
                conexion = new SqlConnection("user id='" + usuario + "'; password='" + clave + "'; Data Source='" + ObtenerNombreServidor() + "\\SQLEXPRESS'; Initial Catalog='" + baseDatos + "';");
                conexion.Open();
                return true;
            }
            catch
            {
                return false;
            }
        }

        public List<Curso> ConsultarCursos(int estudiante)
        {
            try
            {
                if (ConectarBD())
                {
                    List<Curso> cursos = new List<Curso>();
                    SqlCommand comando = new SqlCommand("Select c.idCurso, c.nombre, ec.calificacion from curso c, estudiante_curso ec where ec.idEstudiante = @estudiante and ec.idCurso = c.idCurso");

                    comando.Parameters.Add("@estudiante", SqlDbType.Int).Value = estudiante;
                    comando.Connection = this.conexion;
                    using (SqlDataReader lector = comando.ExecuteReader())
                    {
                        while (lector.Read())
                        {
                            Curso nuevo = new Curso();
                            nuevo.idCurso = lector.GetInt32(0);
                            nuevo.nombreCurso = lector.GetString(1);
                            nuevo.calificacion = lector.GetInt32(2);
                            cursos.Add(nuevo);
                        }
                        return cursos;
                    }
                }
                else
                {
                    return null;
                }
            }
            catch
            {
                return null;
            }
        }
        public List<Curso> llenarTabla(string ced)
        {
            try
            {
                if (ConectarBD())
                {
                    List<Curso> cursos = new List<Curso>();
                    SqlCommand comando = new SqlCommand("Select e.nombre, c.nombre, c.idCurso, ec.calificacion from curso c, estudiante_curso ec, estudiante e where e.cedula = @ced and ec.idEstudiante = e.idEstudiante and ec.idCurso = c.idCurso");
                    comando.Parameters.Add("@ced", SqlDbType.VarChar).Value = ced;
                    comando.Connection = this.conexion;
                    using (SqlDataReader lector = comando.ExecuteReader())
                    {
                        while (lector.Read())
                        {
                            Curso nuevo = new Curso();
                            nuevo.nombreEstudiante = lector.GetString(0);
                            nuevo.nombreCurso = lector.GetString(1);
                            nuevo.idCurso = lector.GetInt32(2);
                            nuevo.calificacion = lector.GetInt32(3);
                            cursos.Add(nuevo);
                        }
                        return cursos;
                    }
                }
                else
                {
                    return null;
                }
            }
            catch
            {
                return null;
            }
        }
    public Boolean validar(string ced, string clave)
        {
            try
            {
                if (ConectarBD())
                {
                    SqlCommand comando = new SqlCommand("Select idEstudiante from estudiante where cedula = @ced and clave = @clave");
                    comando.Parameters.Add("@ced", SqlDbType.VarChar).Value = ced;
                    comando.Parameters.Add("@clave", SqlDbType.VarChar).Value = clave;
                    comando.Connection = this.conexion;
                    using(SqlDataReader lector = comando.ExecuteReader()) { 
                        if (lector.HasRows){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                }
                else
                {
                    return false;
                }
            }
            catch
            {
                return false;
            }
        }

    }
}
