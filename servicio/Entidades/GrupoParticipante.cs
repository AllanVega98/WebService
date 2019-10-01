using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Entidades
{
    public class Grupo_Participante
    {
        public string nombreCurso{set;get;}
        public string codigoGrupo{set;get;}
        public int calificacion { set; get; }
        public string retirado { set; get; }
        public DateTime fechaRetirado { set; get; }
    }
}
