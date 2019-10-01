using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Entidades
{
    public class Estudiante_Curso
    {
        public int idCurso{set;get;}
        public string nombreCurso { set; get; }
        public int calificacion { set; get; }
        public int retirado { set; get; }
        public DateTime fechaRetirado { set; get; }
    }
}
