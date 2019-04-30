using System;
using System.Collections.Generic;

namespace BOG.Models
{
    public partial class CommentsT
    {
        public int CommentIdPk { get; set; }
        public int UserIdFk { get; set; }
        public int PropertyIdFk { get; set; }
        public byte Rating { get; set; }
        public DateTime DateSubmitted { get; set; }
        public DateTime? MonthYearVisit { get; set; }
        public string Comments { get; set; }

        public CommentsT()
        {

        }

        public CommentsT(int userId, int propId, byte rating, DateTime myVisit, string comments)
        {
            this.UserIdFk = userId;
            this.PropertyIdFk = propId;
            this.Rating = rating;
            this.MonthYearVisit = myVisit;
            this.Comments = comments;
        }

        public virtual PropertyT PropertyIdFkNavigation { get; set; }
        public virtual UserT UserIdFkNavigation { get; set; }
    }
}
