using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using servicio.ServiceReference1;
using Entidades;
namespace servicio
{
    public partial class WebForm1 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }
        protected void Button1_Click(object sender, EventArgs e)
        {
            WebService1 webService = new WebService1();
            //Label1.Text = "Output of WebService: " + webService.buscar(1);
            if (webService.validar("777", "333")==true)
            {
                Label1.Text = "Linda";
            }
            else {
                Label1.Text = "Nope";
            }
        }
    }
}