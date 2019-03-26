//Demo 1 - MVC Basics; LV

using System.ComponentModel.DataAnnotations;

namespace Demo1.Models
{

    // validation can be defined here and applied anywhere in the application (e.g., in SongForm)
    // the validation rules are expressed as C# attributes

    public class ListenerRequest
    {
        [Required(ErrorMessage = "Please enter song title")]
        public string SongTitle { get; set; }

        [Required(ErrorMessage = "Please enter atrist's name")]
        public string ArtistName { get; set; }

        [Required(ErrorMessage = "Please enter your name")]
        public string ListenerName { get; set; }

        [Required(ErrorMessage = "Please enter your email address")]
        [RegularExpression(".+\\@.+\\..+", ErrorMessage = "Please enter a valid email address")]
        public string Email { get; set; }
        
        [Required(ErrorMessage = "Please specify how you listen to us")]
        public string HowListen { get; set; }
    }
}
