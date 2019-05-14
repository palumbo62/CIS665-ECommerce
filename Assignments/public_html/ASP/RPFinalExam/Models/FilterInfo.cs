using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace RPFinalExam.Models
{
    public class FilterInfo
    {
        public string teamFk { get; set; }

        [Required(ErrorMessage = "Please enter the players name")]
        [MaxLength(50)]
        public string playerName { get; set; }

        [Required(ErrorMessage = "Please enter the players age")]
        [Range(18, 100, ErrorMessage = "Please enter an age between 18 and 100")]
        public int playerAge { get; set; }

        [Required(ErrorMessage = "Please enter the player's position: 'F' | 'D' | 'G'")]
        [MaxLength(1)]
        [RegularExpression("^[F|D|G]$", ErrorMessage = "Please enter one of (F,D,G)")]
        public string playerPos { get; set; }
    }
}
