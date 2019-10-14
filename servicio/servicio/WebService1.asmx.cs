using Entidades;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;

namespace servicio
{
    /// <summary>
    /// Descripción breve de WebService1
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Para permitir que se llame a este servicio web desde un script, usando ASP.NET AJAX, quite la marca de comentario de la línea siguiente. 
    [System.Web.Script.Services.ScriptService]
    public class WebService1 : System.Web.Services.WebService
    {
        #region métodos
        [WebMethod]
        public List<Grupo_Participante> llenarTabla(string cedula)
        {
            Logica logica = new Logica();
            return logica.consultarCursos(cedula);
        }

        [WebMethod]
        public Boolean login(string cedula, string clave)
        {
            Logica logica = new Logica();
            return logica.login(cedula, clave);
        }

        [WebMethod]
        public Boolean validar(string cedula)
        {
            Logica logica = new Logica();
            return logica.validar(cedula);
        }
        [WebMethod]
        public string nombre(string cedula)
        {
            Logica logica = new Logica();
            return logica.nombre(cedula);
        }
        [WebMethod]
        public Boolean registrar(string correo, string clave, string cedula)
        {
            Logica logica = new Logica();
            Login usuario = new Login();
            usuario.clave = clave;
            usuario.correo = correo;
            usuario.cedula = cedula;
            return logica.registrar(usuario);
        }
        #endregion
    }
}