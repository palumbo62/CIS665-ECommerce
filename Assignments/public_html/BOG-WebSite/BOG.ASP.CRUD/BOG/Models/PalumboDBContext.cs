using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;

namespace BOG.Models
{
    public partial class PalumboDBContext : DbContext
    {
        public PalumboDBContext()
        {
        }

        public PalumboDBContext(DbContextOptions<PalumboDBContext> options)
            : base(options)
        {
        }

        public virtual DbSet<CommentsT> CommentsT { get; set; }
        public virtual DbSet<PropertyT> PropertyT { get; set; }
        public virtual DbSet<PropertyTypeT> PropertyTypeT { get; set; }
        public virtual DbSet<ReservationT> ReservationT { get; set; }
        public virtual DbSet<RolesT> RolesT { get; set; }
        public virtual DbSet<UserT> UserT { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            if (!optionsBuilder.IsConfigured)
            {
#warning To protect potentially sensitive information in your connection string, you should move it out of source code. See http://go.microsoft.com/fwlink/?LinkId=723263 for guidance on storing connection strings.
                optionsBuilder.UseSqlServer("Server=buscissql1601\\cisweb;Database=PalumboDB;User ID=across;Password=sites;");
            }
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.HasAnnotation("ProductVersion", "2.2.2-servicing-10034");

            modelBuilder.Entity<CommentsT>(entity =>
            {
                entity.HasKey(e => e.CommentIdPk);

                entity.Property(e => e.CommentIdPk).HasColumnName("CommentIdPK");

                entity.Property(e => e.Comments).HasMaxLength(500);

                entity.Property(e => e.DateSubmitted)
                    .HasColumnType("date")
                    .HasDefaultValueSql("(getdate())");

                entity.Property(e => e.MonthYearVisit).HasColumnType("date");

                entity.Property(e => e.PropertyIdFk).HasColumnName("PropertyIdFK");

                entity.Property(e => e.UserIdFk).HasColumnName("UserIdFK");

                entity.HasOne(d => d.PropertyIdFkNavigation)
                    .WithMany(p => p.CommentsT)
                    .HasForeignKey(d => d.PropertyIdFk)
                    .HasConstraintName("FK_CommentsT_PropertyT");

                entity.HasOne(d => d.UserIdFkNavigation)
                    .WithMany(p => p.CommentsT)
                    .HasForeignKey(d => d.UserIdFk)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK_CommentsT_UserT");
            });

            modelBuilder.Entity<PropertyT>(entity =>
            {
                entity.HasKey(e => e.PropertyIdPk);

                entity.Property(e => e.PropertyIdPk).HasColumnName("PropertyIdPK");

                entity.Property(e => e.Address)
                    .IsRequired()
                    .HasMaxLength(30);

                entity.Property(e => e.City)
                    .IsRequired()
                    .HasMaxLength(30);

                entity.Property(e => e.DailyPrice).HasColumnType("smallmoney");

                entity.Property(e => e.Description).HasMaxLength(500);

                entity.Property(e => e.GuestCnt).HasDefaultValueSql("((0))");

                entity.Property(e => e.ImageName).HasMaxLength(50);

                entity.Property(e => e.PropertyTitle)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.PropertyTypeIdFk).HasColumnName("PropertyTypeIdFK");

                entity.Property(e => e.SqFt).HasDefaultValueSql("((0))");

                entity.Property(e => e.State)
                    .IsRequired()
                    .HasMaxLength(2);

                entity.HasOne(d => d.PropertyTypeIdFkNavigation)
                    .WithMany(p => p.PropertyT)
                    .HasForeignKey(d => d.PropertyTypeIdFk)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK_PropertyT_PropertyTypeT");
            });

            modelBuilder.Entity<PropertyTypeT>(entity =>
            {
                entity.HasKey(e => e.PropertyTypeIdPk);

                entity.Property(e => e.PropertyTypeIdPk).HasColumnName("PropertyTypeIdPK");

                entity.Property(e => e.PropertyTypeName).HasMaxLength(10);
            });

            modelBuilder.Entity<ReservationT>(entity =>
            {
                entity.HasKey(e => e.ReservationIdPk)
                    .HasName("PK_ReservationID");

                entity.Property(e => e.ReservationIdPk).HasColumnName("ReservationIdPK");

                entity.Property(e => e.CheckIn)
                    .HasColumnType("date")
                    .HasDefaultValueSql("(getdate())");

                entity.Property(e => e.CheckOut)
                    .HasColumnType("date")
                    .HasDefaultValueSql("(getdate()+(1))");

                entity.Property(e => e.PropertyIdFk).HasColumnName("PropertyIdFK");

                entity.Property(e => e.TotalPayment).HasColumnType("money");

                entity.Property(e => e.UserIdFk).HasColumnName("UserIdFK");

                entity.HasOne(d => d.PropertyIdFkNavigation)
                    .WithMany(p => p.ReservationT)
                    .HasForeignKey(d => d.PropertyIdFk)
                    .HasConstraintName("FK_ReservationT_PropertyT");

                entity.HasOne(d => d.UserIdFkNavigation)
                    .WithMany(p => p.ReservationT)
                    .HasForeignKey(d => d.UserIdFk)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK_ReservationT_UserT");
            });

            modelBuilder.Entity<RolesT>(entity =>
            {
                entity.HasKey(e => e.RoleIdPk);

                entity.Property(e => e.RoleIdPk).HasColumnName("RoleIdPK");

                entity.Property(e => e.RoleName)
                    .IsRequired()
                    .HasMaxLength(10);
            });

            modelBuilder.Entity<UserT>(entity =>
            {
                entity.HasKey(e => e.UserIdPk)
                    .HasName("PK_UserID");

                entity.HasIndex(e => e.Email)
                    .HasName("UniqueEmailIdx")
                    .IsUnique();

                entity.Property(e => e.UserIdPk).HasColumnName("UserIdPK");

                entity.Property(e => e.Address)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Cccvc)
                    .HasColumnName("CCCvc")
                    .HasDefaultValueSql("((0))");

                entity.Property(e => e.CcexpDate)
                    .HasColumnName("CCExpDate")
                    .HasColumnType("date")
                    .HasDefaultValueSql("('')");

                entity.Property(e => e.Ccnumber)
                    .HasColumnName("CCNumber")
                    .HasDefaultValueSql("((0))");

                entity.Property(e => e.City)
                    .IsRequired()
                    .HasMaxLength(30);

                entity.Property(e => e.Email)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.FirstName)
                    .IsRequired()
                    .HasMaxLength(30);

                entity.Property(e => e.LastName)
                    .IsRequired()
                    .HasMaxLength(30);

                entity.Property(e => e.Password)
                    .IsRequired()
                    .HasMaxLength(20);

                entity.Property(e => e.RoleIdFk).HasColumnName("RoleIdFK");

                entity.Property(e => e.State)
                    .IsRequired()
                    .HasMaxLength(2)
                    .HasDefaultValueSql("(N'UPPER')");
            });
        }
    }
}
