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
        #region variables
        private String baseDatos;
        private String usuario;
        private String clave;
        private SqlConnection conexion;
        #endregion


        public Conexion()
        {
            this.baseDatos = "sicap";
            this.usuario = "Allan";
            this.clave = "Practica!";
        }
        #region métodos
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

        public List<Estudiante_Curso> consultarCursos(string cedula)
        {
            try
            {
                if (ConectarBD())
                {
                    List<Estudiante_Curso> cursos = new List<Estudiante_Curso>();
                    SqlCommand comando = new //Hay que ver bien que quiere presentar, el join está listo
                    SqlCommand("Select cc.Nom_Curso, cg.Con_Curso, gp.Num_Calificacion_Obtenida, gp.Bool_Retiro_Certificado" +
                    " from Com_Persona p, Par_Grupo_Participante gp, Cur_Grupo cg, Cur_Curso cc" +
                    " where p.Dsc_Identificacion=@cedula and p.Con_Persona=gp.Con_Persona and gp.Con_Grupo=cg.Con_Grupo" +
                    "and cg.Con_Grupo=cc.Con_Curso");

                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                    comando.Connection = this.conexion;
                    using (SqlDataReader lector = comando.ExecuteReader())
                    {
                        while (lector.Read())
                        {
                            Estudiante_Curso nuevo = new Estudiante_Curso();
                            nuevo.idCurso = lector.GetInt32(0);
                            nuevo.nombreCurso = lector.GetString(1);
                            nuevo.calificacion = lector.GetInt32(2);
                            nuevo.retirado = lector.GetInt32(3);
                            nuevo.fechaRetirado = lector.GetDateTime(4);
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
        public Boolean login(string cedula, string clave)
        {
            try
            {
                if (ConectarBD())
                {
                    SqlCommand comando = new SqlCommand("Select idEstudiante from loguear where cedula = @cedula and clave = @clave");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
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
        public Boolean validarCedula(string cedula)
        {
            try
            {
                if (ConectarBD())
                {
                    SqlCommand comando = new SqlCommand("Select Nom_Nombre from Com_Persona where Dsc_Identificacion = @cedula");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
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
        public Boolean registrar(Login usuario)
        {
            try
            {
                if (ConectarBD())
                {
                    SqlCommand comando = new SqlCommand("insert into loguear(@cedula,@clave,@correo)");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = usuario.cedula;
                    comando.Parameters.Add("@clave", SqlDbType.VarChar).Value = usuario.clave;
                    comando.Parameters.Add("@correo", SqlDbType.VarChar).Value = usuario.correo;
                    comando.Connection = this.conexion;
                    if (comando.ExecuteNonQuery()>0)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
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
        #endregion metodos
    }
}
