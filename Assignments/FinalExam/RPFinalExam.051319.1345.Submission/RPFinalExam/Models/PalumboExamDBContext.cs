using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;

namespace RPFinalExam.Models
{
    public partial class PalumboExamDBContext : DbContext
    {
        public PalumboExamDBContext()
        {
        }

        public PalumboExamDBContext(DbContextOptions<PalumboExamDBContext> options)
            : base(options)
        {
        }

        public virtual DbSet<NhlPlayer> NhlPlayer { get; set; }
        public virtual DbSet<NhlTeams> NhlTeams { get; set; }
        public virtual DbSet<UserInfo> UserInfo { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            if (!optionsBuilder.IsConfigured)
            {
#warning To protect potentially sensitive information in your connection string, you should move it out of source code. See http://go.microsoft.com/fwlink/?LinkId=723263 for guidance on storing connection strings.
                optionsBuilder.UseSqlServer("Server=buscissql1601\\cisweb;Database=PalumboExamDB;User ID=peebs;Password=830754758;");
            }
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.HasAnnotation("ProductVersion", "2.2.2-servicing-10034");

            modelBuilder.Entity<NhlPlayer>(entity =>
            {
                entity.HasKey(e => e.NhlPlayerPk);

                entity.Property(e => e.NhlPlayerPk).HasColumnName("NhlPlayerPK");

                entity.Property(e => e.NhlPlayPosition)
                    .IsRequired()
                    .HasMaxLength(1)
                    .IsUnicode(false);

                entity.Property(e => e.NhlPlayerAge).HasDefaultValueSql("((18))");

                entity.Property(e => e.NhlPlayerName)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.NhlTeamFk).HasColumnName("NhlTeamFK");

                entity.HasOne(d => d.NhlTeamFkNavigation)
                    .WithMany(p => p.NhlPlayer)
                    .HasForeignKey(d => d.NhlTeamFk)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK_NhlPlayer_NhlTeams");
            });

            modelBuilder.Entity<NhlTeams>(entity =>
            {
                entity.HasKey(e => e.NhlTeamPk);

                entity.Property(e => e.NhlTeamPk).HasColumnName("NhlTeamPK");

                entity.Property(e => e.NhlTeamHomeCity)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.NhlTeamName)
                    .IsRequired()
                    .HasMaxLength(50);
            });

            modelBuilder.Entity<UserInfo>(entity =>
            {
                entity.HasKey(e => e.UserPk);

                entity.Property(e => e.UserPk).HasColumnName("UserPK");

                entity.Property(e => e.UserFirstName)
                    .IsRequired()
                    .HasMaxLength(30);

                entity.Property(e => e.UserLastName)
                    .IsRequired()
                    .HasMaxLength(30);

                entity.Property(e => e.UserLoginName)
                    .IsRequired()
                    .HasMaxLength(20);

                entity.Property(e => e.UserLoginPassword)
                    .IsRequired()
                    .HasMaxLength(20);
            });
        }
    }
}
