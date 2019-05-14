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

        public virtual PropertyT PropertyIdFkNavigation { get; set; }
        public virtual UserT UserIdFkNavigation { get; set; }
    }
}
