using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;

namespace RPFinalExam.Models
{
    public partial class NhlPlayer
    {
        public int NhlPlayerPk { get; set; }
        public int NhlTeamFk { get; set; }

        [Required(ErrorMessage = "Please enter the players name")]
        [MaxLength(50)]
        public string NhlPlayerName { get; set; }

        [Required(ErrorMessage = "Please enter the players age")]
        [Range(18, 100, ErrorMessage = "Please enter an age between 18 and 100")]
        public int NhlPlayerAge { get; set; }

        [Required(ErrorMessage = "Please enter the player's position: 'F' | 'D' | 'G'")]
        [MaxLength(1)]
        [RegularExpression("^[F|D|G]$", ErrorMessage = "Please enter one of (F,D,G)")]
        public string NhlPlayPosition { get; set; }

        public virtual NhlTeams NhlTeamFkNavigation { get; set; }
    }
}
