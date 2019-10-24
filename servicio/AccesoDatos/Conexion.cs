using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.SqlClient;
using System.Net;
using Entidades;
using System.Globalization;

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
            this.usuario = "web";
            this.clave = "web123";
        }
        #region métodos
        /// <summary>
        /// Solicita el nombre del servidor donde se encuentra alojado
        /// </summary>
        /// <returns>Retorna el nombre del servidor</returns>
        public String obtenerNombreServidor()
        {
            return Dns.GetHostName();
        }

        /// <summary>
        /// Realiza la conexión con la base de datos
        /// </summary>
        /// <returns>Retorna un boolean para verificar si la conexion es exitosa</returns>
        public Boolean conectarBD()
        {                           
            try
            {
                conexion = new SqlConnection("user id='" + usuario + "'; password='" + clave + "'; Data Source='" + obtenerNombreServidor() + "\\SQLEXPRESS01'; Initial Catalog='" + baseDatos + "';");
                conexion.Open();
                return true;
            }
            catch
            {
                return false;
            }
        }

        /// <summary>
        /// Consulta los cursos del estudiante por medio de la cédula
        /// </summary>
        /// <param name="cedula"></param>
        /// <returns>Retorna lista de los cursos del estudiante</returns>
        public List<GrupoParticipante> consultarCursos(string cedula)
        {
            try
            {
                if (conectarBD())
                {
                    List<GrupoParticipante> cursos = new List<GrupoParticipante>();
                    SqlCommand comando = new 
                    SqlCommand("Select cg.Dsc_Codigo, cc.Nom_Curso, gp.Num_Calificacion_Obtenida, gp.Bool_Retiro_Certificado, gp.Fec_Fecha_Retiro from Com_Persona p, Par_Grupo_Participante gp, Cur_Grupo cg, Cur_Curso cc where p.Dsc_Identificacion=@cedula and p.Con_Persona=gp.Con_Persona and gp.Con_Grupo=cg.Con_Grupo and cg.Con_Grupo=cc.Con_Curso");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                    comando.Connection = this.conexion;
                    using (SqlDataReader lector = comando.ExecuteReader())
                    {
                        while (lector.Read())
                        {
                            GrupoParticipante nuevo = new GrupoParticipante();
                            nuevo.codigoGrupo = lector.GetString(0);
                            nuevo.nombreCurso = lector.GetString(1);
                            nuevo.calificacion = lector.GetDecimal(2);
                            if(lector.GetBoolean(3)){
                                nuevo.retirado = "Retirado";
                            }
                            else
                            {
                                nuevo.retirado ="No retirado";
                            }
                            nuevo.fechaRetirado = lector.GetDateTime(4).ToString("dd-MM-yyyy");
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
        /// <summary>
        /// Verifica si el usuario está registrado
        /// </summary>
        /// <param name="cedula"></param>
        /// <param name="clave"></param>
        /// <returns>Retorna un boolean para verificar si el usuario está registrado</returns>
        public Boolean login(string cedula, string clave)
        {
            try
            {
                if (conectarBD())
                {
                    SqlCommand comando = new SqlCommand("Select cp.Nom_Nombre from Login l, Com_Persona cp where l.Dsc_Identificacion = @cedula and l.clave = @clave and l.Dsc_Identificacion = cp.Dsc_Identificacion");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                    
                    //encriptación de la clave
                    byte[] claveEncriptada = System.Text.Encoding.Unicode.GetBytes(clave);
                    comando.Parameters.Add("@clave", SqlDbType.VarChar).Value = Convert.ToBase64String(claveEncriptada);

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
        /// <summary>
        /// Valida que la cédula esté registrada
        /// </summary>
        /// <param name="cedula"></param>
        /// <returns>Retorna un int: 1= Puede registrarse. 2= Ya está registrado. 3= No se encuentra en el sistema. 4= Error.</returns>
        public int validarCedula(string cedula)//1: Puede registrarse 2: Ya tiene un usuario 3: No se encuentra en el sistema y por eso no puede registrarse
        {//4: un error
            try
            {
                if (conectarBD())
                  {
                    bool registrado = false;

                    SqlCommand comando = new SqlCommand("Select Nom_Nombre from Com_Persona where Dsc_Identificacion = @cedula");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                    comando.Connection = this.conexion;
                    using (SqlDataReader lector = comando.ExecuteReader()) { 
                        if (lector.HasRows)
                        {
                            registrado = true;
                        }
                        else
                        {//no existe
                            return 3;
                        }
                    }
                    if (registrado)
                    {
                        SqlCommand comando2 = new SqlCommand("Select Dsc_Identificacion from login where Dsc_Identificacion = @cedula");
                        comando2.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                        comando2.Connection = this.conexion;
                        SqlDataReader lector2 = comando2.ExecuteReader();
                        if (lector2.HasRows)
                        {//Ya está registrado
                            return 2;
                        }
                        else
                        {
                            return 1;
                        }
                    }
                    else
                    {//no está registrado
                        return 3;
                    }
                }
                else
                {
                    return 4;
                }
            }
            catch
            {
                return 4;
            }
        }
        /// <summary>
        /// Busca el nombre del estudiante por medio de la cédula
        /// </summary>
        /// <param name="cedula"></param>
        /// <returns>Retorna un string con el nombre del estudiante</returns>
        public string nombre(string cedula)
        {
            try
            {
                if (conectarBD())
                {
                    SqlCommand comando = new SqlCommand("Select Nom_Nombre from Com_Persona where Dsc_Identificacion = @cedula");
                    comando.Parameters.Add("@cedula", SqlDbType.VarChar).Value = cedula;
                    comando.Connection = this.conexion;
                    using(SqlDataReader lector = comando.ExecuteReader()) { 
                        if (lector.Read()){
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
        /// <summary>
        /// Registra el usuario
        /// </summary>
        /// <param name="usuario"></param>
        /// <returns>Retorna un boolean para verificar si se registró con éxito</returns>
        public Boolean registrar(Login usuario)
        {
            try
            {
                if (conectarBD())
                {
                    SqlCommand comando = new SqlCommand("insert into Login(clave,Dsc_Identificacion,correo)values(@clave,@cedula,@correo)");
                    byte[] claveEncriptada = System.Text.Encoding.Unicode.GetBytes(usuario.clave);
                    comando.Parameters.Add("@clave", SqlDbType.VarChar).Value = Convert.ToBase64String(claveEncriptada);
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
