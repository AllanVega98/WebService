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

        [WebMethod]
        public string HelloWorld()
        {
            return "Hello World";
        }
        [WebMethod]
        public int Add(List<int> listInt)
        {
            int result = 0;
            for (int i = 0; i < listInt.Count; i++)
            {
                result = result + listInt[i];
            }
            return result;
        }
        [WebMethod]
        public int Suma(int a, int b)
        {
            return a+b;
        }

        [WebMethod]
        public int Mult(int a)
        {
            return a*2;
        }

        [WebMethod]
        public List<Curso> buscar(int estudiante)
        {
            Logica lol = new Logica();
            return lol.busqueda(estudiante);
        }

        [WebMethod]
        public List<Curso> llenar(string ced)
        {
            Logica logica = new Logica();
            return logica.llenar(ced);
        }

        [WebMethod]
        public Boolean validar(string ced, string clave)
        {
            Logica logica = new Logica();
            return logica.validar(ced, clave);
        }
    }
}