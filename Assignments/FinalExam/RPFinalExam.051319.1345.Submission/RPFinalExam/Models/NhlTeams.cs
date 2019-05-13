using System;
using System.Collections.Generic;

namespace RPFinalExam.Models
{
    public partial class NhlTeams
    {
        public NhlTeams()
        {
            NhlPlayer = new HashSet<NhlPlayer>();
        }

        public int NhlTeamPk { get; set; }
        public string NhlTeamName { get; set; }
        public string NhlTeamHomeCity { get; set; }

        public virtual ICollection<NhlPlayer> NhlPlayer { get; set; }
    }
}
