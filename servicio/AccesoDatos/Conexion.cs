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

        public List<Grupo_Participante> consultarCursos(string cedula)
        {
            try
            {
                if (ConectarBD())
                {
                    List<Grupo_Participante> cursos = new List<Grupo_Participante>();
                    SqlCommand comando = new //Hay que ver bien que quiere presentar, el join está listo
                    SqlCommand("Select cg.Dsc_Cogdigo, cc.Nom_Curso, gp.Num_Calificacion_Obtenida, gp.Bool_Retiro_Certificado, gp.Fec_Fecha_Retiro" +
                    " from Com_Persona p, Par_Grupo_Participante gp, Cur_Grupo cg, Cur_Curso cc" +
                    " where p.Dsc_Identificacion=@cedula and p.Con_Persona=gp.Con_Persona and gp.Con_Grupo=cg.Con_Grupo" +
                    "and cg.Con_Grupo=cc.Con_Curso");

                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                    comando.Connection = this.conexion;
                    using (SqlDataReader lector = comando.ExecuteReader())
                    {
                        while (lector.Read())
                        {
                            Grupo_Participante nuevo = new Grupo_Participante();
                            nuevo.codigoGrupo = lector.GetString(0);
                            nuevo.nombreCurso = lector.GetString(1);
                            nuevo.calificacion = lector.GetInt32(2);
                            if(lector.GetBoolean(3)){
                                nuevo.retirado = "Retirado";
                            }
                            else
                            {
                                nuevo.retirado ="No retirado";
                            }
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
        public string login(string cedula, string clave)
        {
            try
            {
                if (ConectarBD())
                {
                    SqlCommand comando = new SqlCommand("Select cp.Nom_Nombre from Login l, Com_Persona cp where l.Dsc_Identificacion = @cedula and l.clave = @clave and l.Dsc_Identificacion = cp.Dsc_Identificacion");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                    comando.Parameters.Add("@clave", SqlDbType.VarChar).Value = clave;
                    comando.Connection = this.conexion;
                    using(SqlDataReader lector = comando.ExecuteReader()) { 
                        if (lector.HasRows){
                            return lector.GetString(0);
                        }
                        else{
                            return null;
                        }
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
                    SqlCommand comando = new SqlCommand("insert into Login(@clave,@cedula,@correo)");
                    comando.Parameters.Add("@clave", SqlDbType.VarChar).Value = usuario.clave;
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = usuario.cedula;
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
